<?php

namespace App\Repositories\Site;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository
{
    public function getNameOfServicesById($services_id)
    {
        return Service::query()
                ->select('id', 'name')
                ->whereIn('id', $services_id)
                ->get();
    }

    public function getServicesByIdToOrderSummary(array $services_id): Collection
    {
        return Service::query()
            ->select('id', 'name', 'price')
            ->whereIn('id', $services_id)
            ->get();
    }
}