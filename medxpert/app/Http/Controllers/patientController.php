<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientMedicalHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class patientController extends Controller
{
    public function update(Request $request, Patient $patient)
    {
        // Validate and update the patient's medical history
        $historyData = $request->validate([
            'chronic_diseases' => 'nullable|string',
            'medications' => 'nullable|string',
            'allergies' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $patientHistory = PatientMedicalHistory::firstOrNew(['user_id' => $patient->id]);
        $patientHistory->fill($historyData);
        $patientHistory->save();

        return back();
    }
}
