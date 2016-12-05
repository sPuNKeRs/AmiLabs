<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientResearh;

class PrintController extends Controller
{
    // Печатный вид исследования
    public function printResearch($patient_research_id)
    {
        $patient_research = PatientResearh::findOrFail($patient_research_id);
        //dd($patient_research->results);
        return view('print.research', compact('patient_research'));
    }
}
