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
}