<?php

namespace App\Repositories\Site;

use App\Http\Requests\site\HourFormRequest;
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

    public function updateHourControl(HourFormRequest $request)
    {
        return DB::table('hour_controls')
              ->where('id', $request->session()->get('order.ids_hour_control'))
              ->update(['hour_id' => $request->hour_id]);
    }

    public function destroyHourControl(int $hour_id): void
    {
        HourControl::where('hour_id', $hour_id)->delete();
    }
}