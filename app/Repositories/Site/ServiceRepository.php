<?php

namespace App\Repositories\Site;

use App\Models\Service;

class ServiceRepository
{
    public function getNameOfServicesById($services_id)
    {
        return Service::query()
                ->select('id', 'name')
                ->whereIn('id', $services_id)
                ->get();
    }

    public function getServicesByIdToOrderSummary(int $services_id): Service
    {
        return Service::query()
            ->select('id', 'name', 'price')
            ->where('id', '=', $services_id)
            ->first();
    }
}