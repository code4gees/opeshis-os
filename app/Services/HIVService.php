<?php

namespace App\Services;

use App\Models\HivCase;
use App\Models\HivArtRecord;
use App\Models\HivVlRecord;
use App\Models\SysSetting;


class HIVService
{
    /**
     * Update ART Regimen (closes old, starts new)
     */
    public static function changeRegimen($enrollmentId, $newRegimenData)
    {
        return DB::transaction(function () use ($enrollmentId, $newRegimenData) {
            // Close active regimen
            HivArtRecord::where('enrollment_id', $enrollmentId)
                ->whereNull('end_date')
                ->update([
                    'end_date' => now(),
                    'reason_for_change' => $newRegimenData['reason']
                ]);

            // Start new
            $record = HivArtRecord::create([
                'enrollment_id' => $enrollmentId,
                'regimen_line' => $newRegimenData['line'],
                'regimen_code' => $newRegimenData['code'],
                'start_date' => now(),
                'prescribed_by' => auth()->id(),
            ]);

            return $record->id;
        });
    }

    /**
     * Check for Treatment Failure based on VL results
     */
    public static function checkTreatmentFailure($enrollmentId, $newVL)
    {
        if ($newVL < 1000) return false;

        // Get previous VL
        $prevVL = HivVlRecord::where('enrollment_id', $enrollmentId)
            ->where('test_type', 'VIRAL_LOAD')
            ->orderBy('test_date', 'desc')
            ->skip(1)
            ->first();

        if ($prevVL && $prevVL->viral_load_copies >= 1000) {
            return true;
        }

        return false;
    }

    /**
     * Generate UNAIDS 95-95-95 Indicators
     */
    public static function get959595Metrics()
    {
        $estimated = (int) SysSetting::where('key', 'hiv_estimated_plhiv')->value('value') ?: 1000;
        
        $enrolled = HivCase::where('status', 'active')->count();
        $onART = HivArtRecord::whereNull('end_date')->count();
        
        $suppressed = HivVlRecord::where('test_type', 'VIRAL_LOAD')
            ->where('viral_load_copies', '<', 1000)
            ->whereRaw('test_date = (SELECT MAX(test_date) FROM hiv_cd4_vl_results v2 WHERE v2.enrollment_id = hiv_cd4_vl_results.enrollment_id AND v2.test_type = "VIRAL_LOAD")')
            ->count();

        return [
            'first_95' => $estimated > 0 ? ($enrolled / $estimated) * 100 : 0,
            'second_95' => $enrolled > 0 ? ($onART / $enrolled) * 100 : 0,
            'third_95' => $onART > 0 ? ($suppressed / $onART) * 100 : 0,
            'counts' => [
                'estimated' => $estimated,
                'enrolled' => $enrolled,
                'on_art' => $onART,
                'suppressed' => $suppressed
            ]
        ];
    }
}
