<?php

namespace App\Services\Site;

use App\Repositories\Site\ServiceRepository;

class ServiceService
{
    private ServiceRepository $serviceRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository();
    }

    public function getNameOfServices($services_id)
    {
        return $this->serviceRepository->getNameOfServicesById($services_id);
    }
}