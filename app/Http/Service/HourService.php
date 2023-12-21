<?php

namespace App\Http\Service;

use DateTime;

class HourService
{
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
}