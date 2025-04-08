<?php

namespace App\Repositories;

use App\Models\Professional;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfessionalRepository
{
    public function getProfessionalsByIdToOrderSummary(int $professionals_id): Professional
    {
        $professional = Professional::query()
            ->select('id', 'name')
            ->where('id', '=', $professionals_id)
            ->first();

        if ($professional === null)
            throw new ModelNotFoundException('Profissional não encontrado. ID: {$professionals_id}');

        return $professional;
    }
}