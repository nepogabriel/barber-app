<?php

namespace App\Services;

use App\Models\Hour;
use App\Repositories\Site\HourRepository;
use DateTime;

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

    public function getHourByIdToOrderSummary(int $hours_id): Hour
    {
        return $this->hour_repository->getHourByIdToOrderSummary($hours_id);
    }

    public function checkHours(array $hours_id): bool
    {
        return $this->hour_repository->checkHours($hours_id);
    }
}