<?php

namespace App\Repositories\Site;

use App\Models\Hour;

class HourRepository
{
    public function getHours($professional_id, $date)
    {
        return Hour::query()
            ->select('id', 'time')
            ->orderBy('time')
            ->whereRaw('date >= curdate()')
            //  ->whereRaw('time >= curtime()')
            ->where('professional_id', '=', $professional_id)
            ->where('date', '=', $date)
            ->where('checked', '=', '0')
            ->get();
    }
}