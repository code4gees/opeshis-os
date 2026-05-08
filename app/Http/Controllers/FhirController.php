<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FhirController extends Controller
{
    /**
     * Broadcast HL7 FHIR R4 CapabilityStatement
     */
    public function metadata()
    {
        $capabilityStatement = [
            'resourceType' => 'CapabilityStatement',
            'status' => 'active',
            'date' => now()->toIso8601String(),
            'publisher' => 'Opeshis OS - Universal Health Infrastructure',
            'kind' => 'instance',
            'software' => [
                'name' => 'Opeshis OS Kernel',
                'version' => '3.0.0-Laravel-Standard'
            ],
            'fhirVersion' => '4.0.1',
            'format' => ['json'],
            'rest' => [
                [
                    'mode' => 'server',
                    'resource' => [
                        [
                            'type' => 'Patient',
                            'interaction' => [['code' => 'read'], ['code' => 'search-type']],
                            'searchParam' => [['name' => 'identifier', 'type' => 'token']]
                        ],
                        [
                            'type' => 'Observation',
                            'interaction' => [['code' => 'read']],
                        ]
                    ]
                ]
            ]
        ];

        return Response::json($capabilityStatement, 200, [
            'Content-Type' => 'application/fhir+json'
        ]);
    }
}
