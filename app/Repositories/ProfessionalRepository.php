<?php

namespace App\Repositories;

use App\Models\Professional;

class ProfessionalRepository
{
    public function getProfessionalsByIdToOrderSummary(int $professionals_id): Professional
    {
        return Professional::query()
            ->select('id', 'name')
            ->where('id', '=', $professionals_id)
            ->first();
    }
}