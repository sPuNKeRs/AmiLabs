<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientResearhRequest;
use App\Patient;
use App\Research;

class ResearchController extends Controller
{
    // Показать страницу с исследованиями пациента
    public function list($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $research_list = Research::all();

        $modal_choose_research = [
            'modal_id' => 'modal_choose_research',
            'modal_title'=> 'ВЫБЕРИТИ ВИД ИССЛЕДОВАНИЯ',
            'modal_body' => view('registry.research.forms.chooseresearch', compact('research_list', 'patient_id')),
            'modal_action' => '<button id="btn-save" type="submit" class="btn btn-link waves-effect">ДОБАВИТЬ</button>'
        ];

        return view('registry.research.list', compact('patient', 'modal_choose_research'));
    }

    // Исследование пациента
    public function addPatientResearch(PatientResearhRequest $request)
    {
        $patient = Patient::findOrFail($request->patient_id);
        $research = Research::findOrFail($request->research_id);

        return view('registry.research.blank.default', compact('patient', 'research'));
    }
}
