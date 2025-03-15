<?php

namespace App\Services\Site;

use App\Http\Requests\site\HourFormRequest;
use App\Repositories\Site\HourControlRepository;
use DateTime;

class HourControlService
{
    private HourControlRepository $hourControlRepository;

    public function __construct()
    {
        $this->hourControlRepository = new HourControlRepository();
    }

    public function validateHourControl(HourFormRequest $request): bool
    {
        $alert_user = false;

        $hours_control = $this->hourControlRepository->getHourControl($request->hour_id);
        //$ids_hour_control = $this->getIdsHourControl($request->hour_id);

        if (!empty($hours_control)) {
            $ids_hour_control_selected = $request->session()->get('order.ids_hour_control') ?: [];

            //dd($ids_hour_control_selected);

            $alert_user = $this->checkIfHourIsAvaliable($hours_control, $ids_hour_control_selected);

            // if ((!isset($ids_hour_control) || $hourControl[0]->id !== $id_hour_control) && $data_atual <= $data_minutos) {
            //     $alert_user = true;
            // } else if ($data_atual > $data_minutos) {
            //     $this->destroyHourControl($hourControl[0]->hour_id);
            // }
        }

        return $alert_user;
    }

    public function hourControl(HourFormRequest $request): void
    {
        $ids_hour_control = $request->session()->get('order.ids_hour_control') ?: [];
        
        if (!empty($ids_hour_control)) {
            $hour_control = $this->hourControlRepository->updateHourControl($request); // passar um array no parâmetro em vez do $request
        } else {
            $hour_control = $this->createHourControl($request->hour_id);
            $ids_hour_control = $this->getIdsHourControl($request->hour_id);
            
            if (!empty($ids_hour_control)) {
                $request->session()->put('order.ids_hour_control', $ids_hour_control);
            }
        }
    }

    public function createHourControl(array $hours_id)
    {
        $hours_id_query = [];
        $now = now();

        foreach ($hours_id as $hour_id) {
            $hours_id_query[] = [
                'hour_id' => $hour_id,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        return $this->hourControlRepository->createHourControl($hours_id_query);
    }

    public function destroyHourControl(int $hour_id): void
    {
        $this->hourControlRepository->destroyHourControl($hour_id);
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

    private function checkIfHourIsAvaliable($hours_control, $ids_hour_control_selected)
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
}