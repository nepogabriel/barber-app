<?php

namespace App\Services;

use App\Models\Professional;
use App\Repositories\ProfessionalRepository;

class ProfessionalService
{
    public function __construct(
        private ProfessionalRepository $professional_repository
    ) {}

    public function getProfessionalsByIdToOrderSummary(int $professionals_id): Professional
    {
        return $this->professional_repository->getProfessionalsByIdToOrderSummary($professionals_id);
    }
}