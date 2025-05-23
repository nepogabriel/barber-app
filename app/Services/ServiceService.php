<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\ServiceRepository;

class ServiceService
{
    public function __construct(
        private ServiceRepository $service_repository
    ) {}

    public function getNameOfServices($services_id)
    {
        return $this->service_repository->getNameOfServicesById($services_id);
    }

    public function getServicesByIdToOrderSummary(int $services_id): Service
    {
        return $this->service_repository->getServicesByIdToOrderSummary($services_id);
    }
}