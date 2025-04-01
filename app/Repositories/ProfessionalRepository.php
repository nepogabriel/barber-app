<?php

namespace App\Repositories;

use App\Models\Professional;
use Illuminate\Database\Eloquent\Collection;

class ProfessionalRepository
{
    public function getProfessionalsByIdToOrderSummary(int $professionals_id): Collection
    {
        return Professional::query()
            ->select('id', 'name')
            ->where('id', '=', $professionals_id)
            ->get();
    }
}