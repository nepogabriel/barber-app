<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $service = Service::query()
            ->select('id', 'name', 'price')
            ->where('id', '=', $services_id)
            ->first();

        if ($service === null)
            throw new ModelNotFoundException('Serviço não encontrado. ID: {$services_id}');

        return $service;
    }
}