<?php

namespace App\Services;

use App\Repositories\ProfessionalRepository;
use Illuminate\Database\Eloquent\Collection;

class ProfessionalService
{
    public function __construct(
        private ProfessionalRepository $professional_repository
    ) {}

    public function getProfessionalsByIdToOrderSummary(int $professionals_id): Collection
    {
        return $this->professional_repository->getProfessionalsByIdToOrderSummary($professionals_id);
    }
}