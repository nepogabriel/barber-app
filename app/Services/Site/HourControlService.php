<?php

namespace App\Services\Site;

use App\Interfaces\SessionInterface;
use App\Repositories\Site\HourControlRepository;
use DateTime;

class HourControlService
{
    private HourControlRepository $hourControlRepository;
    private array $ids_hour_control_selected = [];

    public function __construct(
        private SessionInterface $session
    )
    {
        $this->hourControlRepository = new HourControlRepository();
    }

    public function validateHourControl(array $hours_id, array $ids_hour_control_selected): bool
    {
        $alert_user = false;

        $hours_control = $this->hourControlRepository->getHourControl($hours_id);

        if (!empty($hours_control))
            $alert_user = $this->checkIfHourIsAvaliable($hours_control, $ids_hour_control_selected);


        return $alert_user;
    }

    public function hourControl(array $hours_id): void
    {
        $this->ids_hour_control_selected = $this->session->get('order.ids_hour_control') ?: [];

        if (!empty($this->ids_hour_control_selected)) {
            $this->updateHourControl($hours_id);
        } else {
            $this->createHourControl($hours_id);
            $ids_hour_control = $this->getIdsHourControl($hours_id);
            
            if (!empty($ids_hour_control)) {
                $this->session->put('order.ids_hour_control', $ids_hour_control);
            }
        }
    }

    public function createHourControl(array $hours_id)
    {
        $hours_id_query = [];
        $now = now();

        foreach ($hours_id as $service_id => $hour_id) {
            $hours_id_query[] = [
                'hour_id' => $hour_id,
                'service_id' => $service_id,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        return $this->hourControlRepository->createHourControl($hours_id_query);
    }

    private function updateHourControl(array $new_hours_id)
    {
        $results = $this->hourControlRepository->getHourControlByIdHourControl($this->ids_hour_control_selected);
        
        $ids_hour_control_to_delete = [];
        $services = [];

        foreach ($results as $result) {
            $services[] = $result->service_id;

            if (isset($new_hours_id[$result->service_id]) && $new_hours_id[$result->service_id] != $result->hour_id) {
                $hours_id = [
                    'hour_id' => $new_hours_id[$result->service_id]
                ];

                $this->hourControlRepository->updateHourControl($result->id, $hours_id);
            } else if (!isset($new_hours_id[$result->service_id])) {
                $ids_hour_control_to_delete[$result->hour_id] = $result->id;
            }
        }

        $this->delete($ids_hour_control_to_delete);

        $this->checkNewServicesAddedAfter($new_hours_id, $services);

        $new_session = array_diff($this->ids_hour_control_selected, $ids_hour_control_to_delete);

        if (!empty($new_session))
            $this->session->put('order.ids_hour_control', $new_session);
    }

    public function destroyHourControl(int $hour_id): void
    {
        $this->hourControlRepository->destroyHourControl($hour_id);
    }

    public function delete(array $ids_hour_control_to_delete): void
    {
        $this->hourControlRepository->delete($ids_hour_control_to_delete);
    }

    private function getIdsHourControl(array $hour_id): array
    {
        $ids_hour_control = [];

        $hours_control = $this->hourControlRepository->getHourControl($hour_id);

        foreach ($hours_control as $hour_control) {
            $ids_hour_control[$hour_control->hour_id] = $hour_control->id;
        }

        return $ids_hour_control;
    }

    private function checkIfHourIsAvaliable($hours_control, $ids_hour_control_selected): bool
    {
        $alert_user = false;
        $current_date = new DateTime();

        foreach ($hours_control as $hour_control) {
            $expired_date = $this->addTenMinutes($hour_control->updated_at);

            if (
                (empty($ids_hour_control_selected) || (isset($ids_hour_control_selected[$hour_control->hour_id]) && $hour_control->id !== $ids_hour_control_selected[$hour_control->hour_id])) 
                && $current_date <= $expired_date) {
                $alert_user = true;
            } else if ($current_date > $expired_date) {
                $this->destroyHourControl($hour_control->hour_id);
            }
        }

        return $alert_user;
    }

    private function addTenMinutes($updated_at)
    {
        $date_updated_at = new DateTime($updated_at);
        $date_with_ten_minutes = clone $date_updated_at;
        $date_with_ten_minutes->modify('+10 minutes');

        return $date_with_ten_minutes;
    }

    private function checkNewServicesAddedAfter(array $new_hours_id, array $services): void
    {
        $hours_id = [];

        foreach ($new_hours_id as $service_id => $hour_id) {
            if (empty($services) || in_array($service_id, $services))
                continue;

            $hours_id[] = $hour_id;

            $this->hourControlRepository->updateOrCreateHourControl($service_id, $hour_id);
        }

        $result = $this->hourControlRepository->getHourControl($hours_id);

        if ($result->isNotEmpty())
            $this->ids_hour_control_selected[$result->first()?->hour_id] = $result->first()?->id;
    }
}