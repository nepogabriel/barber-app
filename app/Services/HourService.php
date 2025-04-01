<?php

namespace App\Services;

use App\Repositories\Site\HourRepository;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class HourService
{
    public function __construct(
        private HourRepository $hour_repository
    ) {}

    public function formatDate($date)
    {
        $dataObjeto = new DateTime($date);
        return $dataObjeto->format("d/m/Y");
    }

    public function formatTime($time)
    {
        $horaObjeto = new DateTime($time);
        return $horaObjeto->format("H:i");
    }

    public function getHours($professional_id, $date)
    {
        $hours = $this->hour_repository->getHours($professional_id, $date);
        return $hours;
    }

    public function getHourByIdToOrderSummary(array $hours_id): Collection
    {
        return $this->hour_repository->getHourByIdToOrderSummary($hours_id);
    }
}