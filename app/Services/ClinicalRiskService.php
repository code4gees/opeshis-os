<?php

namespace App\Services;

class ClinicalRiskService
{
    /**
     * NICU Specific Alerts
     */
    public static function checkNICUAlerts($vitals, $admission)
    {
        $alerts = [];
        $temp = $vitals['temperature'] ?? null;
        $hr = $vitals['heart_rate'] ?? null;
        $rr = $vitals['respiratory_rate'] ?? null;
        $spo2 = $vitals['spo2'] ?? null;
        $bg = $vitals['blood_glucose'] ?? null;

        if ($temp !== null) {
            if ($temp < 36.0) $alerts[] = 'CRITICAL: Hypothermia detected. Start immediate warming protocol.';
            elseif ($temp > 37.5) $alerts[] = 'WARNING: Hyperthermia. Assess for neonatal sepsis.';
        }

        if ($hr !== null && ($hr < 100 || $hr > 180)) {
            $alerts[] = 'CRITICAL: Abnormal neonatal heart rate (' . $hr . ' bpm).';
        }

        if ($rr !== null && ($rr < 30 || $rr > 60)) {
            $alerts[] = 'WARNING: Respiratory distress (RR: ' . $rr . '). Check for RDS.';
        }

        if ($spo2 !== null && $spo2 < 92) {
            $alerts[] = 'CRITICAL: Neonatal Hypoxia (SpO2: ' . $spo2 . '%).';
        }

        if ($bg !== null && $bg < 2.6) {
            $alerts[] = 'CRITICAL: Neonatal Hypoglycaemia. Dextrose bolus may be required.';
        }

        return $alerts;
    }

    /**
     * ANC (Antenatal) Specific Alerts
     */
    public static function checkANCAlerts($vitals, $patient)
    {
        $alerts = [];
        $sbp = $vitals['bp_systolic'] ?? null;
        $dbp = $vitals['bp_diastolic'] ?? null;
        $hb = $vitals['hb_level'] ?? null;
        $fh = $vitals['fundal_height'] ?? null;
        $ga = $vitals['gestational_age'] ?? null;

        if ($sbp >= 140 || $dbp >= 90) {
            $alerts[] = 'CRITICAL: Hypertension in pregnancy. Assess for Preeclampsia (Proteinuria/Oedema).';
        }

        if ($hb !== null && $hb < 11.0) {
            $alerts[] = 'WARNING: Anaemia in pregnancy (Hb: ' . $hb . ').';
        }

        if ($fh !== null && $ga !== null && $ga > 20) {
            if (abs($fh - $ga) > 3) {
                $alerts[] = 'WARNING: Fundal height mismatch (±' . abs($fh - $ga) . 'cm). Review growth via USS.';
            }
        }

        return $alerts;
    }
}
