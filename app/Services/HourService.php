<?php

namespace App\Services;

use App\Repositories\Site\HourRepository;
use DateTime;

class HourService
{
    private HourRepository $hourRepository;

    public function __construct()
    {
        $this->hourRepository = new HourRepository;
    }

    // public function formatDate($date)
    // {
    //     $dataObjeto = new DateTime($date);
    //     return $dataObjeto->format("d/m/Y");
    // }

    // public function formatTime($time)
    // {
    //     $horaObjeto = new DateTime($time);
    //     return $horaObjeto->format("H:i");
    // }

    public function getHours($professional_id, $date)
    {
        $hours = $this->hour_repository->getHours($professional_id, $date);
        return $hours;
    }
}