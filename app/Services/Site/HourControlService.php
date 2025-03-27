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

    public function validateHourControl(array $hours_id, array $ids_hour_control_selected): bool
    {
        $alert_user = false;

        $hours_control = $this->hourControlRepository->getHourControl($hours_id);

        if (!empty($hours_control))
            $alert_user = $this->checkIfHourIsAvaliable($hours_control, $ids_hour_control_selected);


        return $alert_user;
    }

    public function hourControl(HourFormRequest $request): void
    {
        $ids_hour_control_selected = $request->session()->get('order.ids_hour_control') ?: [];
        
        if (!empty($ids_hour_control_selected)) {
            $this->updateHourControl($request->hour_id, $ids_hour_control_selected);
        } else {
            $this->createHourControl($request->hour_id);
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

    private function updateHourControl(array $new_hours_id, array $ids_hour_control_selected)
    {
        $results = $this->hourControlRepository->getHourControlByIdHourControl($ids_hour_control_selected);

        // caso retorne vazio deveria lançar uma exceção aqui OU apenas deixar o fluxo seguir?

        foreach ($results as $result) {
            if (isset($new_hours_id[$result['service_id']]) && $new_hours_id[$result['service_id']] != $result['hour_id']) {
                $hours_id = [
                    'hour_id' => $new_hours_id[$result['service_id']]
                ];

                $this->hourControlRepository->updateHourControl($result['id'], $hours_id);
            }

            // Talvez seria ideal atualizar a sessão com os novos ID Hour Control e ID Hour, porque o número de horários/servços podem diminuir.
            // Talvez deletar os serviços que o usuário 'descatou' durante o fluxo.
        }
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