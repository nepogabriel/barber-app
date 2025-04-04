<?php

namespace App\Repositories\Site;

use App\Models\HourControl;
use Illuminate\Database\Eloquent\Collection;

class HourControlRepository
{
    public function createHourControl(array $hours_id)
    {
        return HourControl::insert($hours_id);
    }

    public function getHourControl(array $hour_id): Collection
    {
        return HourControl::query()
            ->select('id', 'hour_id', 'updated_at')
            ->whereIn('hour_id', $hour_id)
            ->get();
    }

    public function getHourControlByIdHourControl(array $ids_hour_control): Collection
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

    public function updateOrCreateHourControl(int $service_id, int $hour_id): void
    {
        HourControl::updateOrCreate(
            ['hour_id' => $hour_id],
            ['hour_id' => $hour_id, 'service_id' => $service_id]
        );
    }

    public function deleteByHourId(array $hours_id): void
    {
        HourControl::whereIn('hour_id', $hours_id)->delete();
    }

    public function deleteByHourControlId($ids)
    {
        HourControl::whereIn('id', $ids)->delete();
    }
}