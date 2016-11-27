<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class AnalyzesController extends Controller
{
    // Показать страницу с анализами пациента
    public function list($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        return view('registry.analyzis.list', compact('patient'));
    }
}
