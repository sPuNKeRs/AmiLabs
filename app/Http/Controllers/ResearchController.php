<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class ResearchController extends Controller
{
    // Показать страницу с исследованиями пациента
    public function list($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        return view('registry.research.list', compact('patient'));
    }
}
