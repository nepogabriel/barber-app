<?php

namespace App\Repositories\Site;

use App\Models\Hour;
use Illuminate\Database\Eloquent\Collection;

class HourRepository
{
    public function getHours($professional_id, $date)
    {
        return Hour::query()
            ->select('id', 'time')
            ->orderBy('time')
            ->whereRaw('date >= curdate()')
            ->where('professional_id', '=', $professional_id)
            ->where('date', '=', $date)
            ->where('checked', '=', '0')
            ->get();
    }

    public function getHourByIdToOrderSummary(array $hours_id): Collection
    {
        return Hour::query()
            ->select('id', 'date', 'time')
            ->whereIn('id', $hours_id)
            ->get();
    }
}