<?php

namespace App\Http\Service;

use App\Repositories\Site\HourRepository;
use DateTime;

class HourService
{
    private HourRepository $hourRepository;

    public function __construct()
    {
        $this->hourRepository = new HourRepository;
    }

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
        $hours = $this->hourRepository->getHours($professional_id, $date);

        foreach ($hours as $hour) {
            $hour->time = $this->formatTime($hour->time);
        }

        return $hours;
    }
}