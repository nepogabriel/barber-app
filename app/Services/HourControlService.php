<?php

namespace App\Services;

use App\Interfaces\SessionInterface;
use App\Services\Site\ServiceService;
use App\Repositories\Site\HourControlRepository;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class HourControlService
{
    private HourControlRepository $hourControlRepository;
    private array $ids_hour_control_selected = [];

    public function __construct(
        private SessionInterface $session,
        private ServiceService $service_service
    )
    {
        $this->hourControlRepository = new HourControlRepository();
    }

    public function validateHourControl(array $hours_id, array $ids_hour_control_selected): array
    {
        $alert_user = false;
        $message = '';
        
        if($alert_user = $this->checkSameHour($hours_id)) {
            $message = 'Ops! Não permitido o mesmo horário para serviços diferentes.';

            return [
                'alert_user' => $alert_user,
                'message' => $message,
            ];
        }

        $hours_control = $this->hourControlRepository->getHourControl($hours_id);

        if (!empty($hours_control)) {
            $check_hour = $this->checkIfHourIsAvaliable($hours_control, $ids_hour_control_selected);

            $services_name = '';

            if (isset($check_hour['hours_id']) && !empty($check_hour['hours_id'])) {
                $services_name = $this->includeServiceNameInAlert($hours_id, $check_hour['hours_id']);
            }

            $alert_user = $check_hour['alert_user'];
            $message = $check_hour['alert_user'] ? (string) 'Desculpe! Outro usuário escolheu o mesmo horário. ' . $services_name : '';
        }

        return [
            'alert_user' => $alert_user,
            'message' => $message,
        ];
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

    private function checkIfHourIsAvaliable(Collection $hours_control, array $ids_hour_control_selected): array
    {
        $alert_user = false;
        $hours_id = [];
        $delete_hour_controls_id = [];
        $current_date = new DateTime();

        foreach ($hours_control as $hour_control) {
            $expired_date = $this->addTenMinutes($hour_control->updated_at);

            if (
                (empty($ids_hour_control_selected) || (isset($ids_hour_control_selected[$hour_control->hour_id]) && $hour_control->id !== $ids_hour_control_selected[$hour_control->hour_id])) 
                && $current_date <= $expired_date) {

                $alert_user = true;
                $hours_id[] = (int) $hour_control->hour_id;

            } else if ($current_date > $expired_date) {
                $delete_hour_controls_id[] = $hour_control->id;
            }
        }

        if (!empty($delete_hour_controls_id))
            $this->hourControlRepository->delete($delete_hour_controls_id);

        return [
            'alert_user' => $alert_user,
            'hours_id' => $hours_id,
        ];
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

    private function checkSameHour(array $hours_id): bool
    {
        $alert_user = false;

        if (count($hours_id) > 1 && count(array_unique($hours_id)) <= 1) {
            $alert_user = true;
        }

        return $alert_user;
    }

    private function includeServiceNameInAlert(array $hours_id, array $alert_hours_id): string
    {
        $services_id = [];

        foreach ($hours_id as $service_id => $hour_id) {
            if (!in_array($hour_id, $alert_hours_id))
                continue;

            $services_id[] = $service_id;
        }

        $services = $this->service_service->getNameOfServices($services_id);

        $message = 'Serviço: ';
        $names = '';
        $quantidade = 1;

        foreach ($services as $service) {
            if ($quantidade > 1) {
                $message = 'Serviços: ';
                $names .= ' e ';
            }

            $names .= (string) $service->name;

            $quantidade++;
        }

        return (string) $message . $names;
    }
}