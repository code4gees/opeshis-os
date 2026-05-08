<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\IcuSofaScore;
use Illuminate\Support\Facades\Auth;

class CalculateSofaScoreAction
{
    /**
     * Authorize Institutional SOFA Index Calculation Protocol
     */
    public function execute(array $data): IcuSofaScore
    {
        $totalScore = (int)$data['respiratory'] + (int)$data['coagulation'] + (int)$data['liver'] + 
                      (int)$data['cardiovascular'] + (int)$data['cns'] + (int)$data['renal'];

        return IcuSofaScore::create([
            'admission_id' => $data['admission_id'],
            'respiratory' => $data['respiratory'],
            'coagulation' => $data['coagulation'],
            'liver' => $data['liver'],
            'cardiovascular' => $data['cardiovascular'],
            'cns' => $data['cns'],
            'renal' => $data['renal'],
            'total_score' => $totalScore,
            'recorded_by' => Auth::id(),
        ]);
    }
}
