<?php

namespace App\Repositories\Site;

use App\Models\HourControl;
use Illuminate\Support\Facades\DB;



class HourControlRepository
{
    public function createHourControl(array $hours_id)
    {
        return HourControl::insert($hours_id);
    }

    public function getHourControl(array $hour_id)
    {
        return HourControl::query()
            ->select('id', 'hour_id', 'updated_at')
            ->whereIn('hour_id', $hour_id)
            ->get();
    }

    public function getHourControlByIdHourControl(array $ids_hour_control)
    {
        return HourControl::query()
            ->select('id', 'hour_id', 'service_id')
            ->whereIn('id', $ids_hour_control)
            ->get();
    }

    public function updateHourControl(int $id_hour_control, array $hours_id)
    {
        return HourControl::where(
            'id', 
            $id_hour_control
            )->update($hours_id);
    }

    public function destroyHourControl(int $hour_id): void
    {
        HourControl::where('hour_id', $hour_id)->delete();
    }
}