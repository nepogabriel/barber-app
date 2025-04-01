<?php

namespace App\Services\Site;

use App\Repositories\Site\ServiceRepository;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    public function __construct(
        private ServiceRepository $service_repository
    ) {}

    public function getNameOfServices($services_id)
    {
        return $this->service_repository->getNameOfServicesById($services_id);
    }

    public function getServicesByIdToOrderSummary(array $services_id): Collection
    {
        return $this->service_repository->getServicesByIdToOrderSummary($services_id);
    }
}