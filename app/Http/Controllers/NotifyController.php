<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\PatientResearh;
use PDF;

class NotifyController extends Controller
{
    public function sendNotify(Request $request)
    {
        $patient_research = PatientResearh::findOrFail($request->patient_research_id);
        $pdf = PDF::loadView('pdf.research', compact('patient_research'));
        $pdf->save(public_path().'/notify-pdf/research_'.$patient_research->id.'.pdf');

        return response('ok');
    }
}
