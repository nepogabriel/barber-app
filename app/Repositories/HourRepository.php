<?php

namespace App\Repositories;

use App\Models\Hour;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function getHourByIdToOrderSummary(int $hours_id): Hour
    {
        $hour =  Hour::query()
            ->select('id', 'date', 'time')
            ->where('id', '=', $hours_id)
            ->first();

        if ($hour === null)
            throw new ModelNotFoundException('Horário não encontrado. ID: {$hours_id}');

        return $hour;
    }

    public function checkHours(array $hours_id): bool
    {
        return Hour::whereIn('id', $hours_id)
            ->update(['checked' => 1]);
    }
}