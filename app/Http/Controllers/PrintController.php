<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    // Печатный вид исследования
    public function printResearch($patient_research_id)
    {
        //dd($patient_research_id);
        return view('print.research');
    }
}
