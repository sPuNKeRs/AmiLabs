<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\PatientResearhRequest;
use App\Patient;
use App\Research;
use App\PatientResearh;

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

    // Сохранение исследования пациента
    public function savePatientResearch(Request $request)
    {
        $input = $request->all();
        $patientResearh = PatientResearh::create($input);

        return redirect()->route('registry.patients.research.list', $request->patient_id);
    }

    // Открыть на редактирование исследование
    public function editPatientResearch($research_id)
    {
        $research = PatientResearh::findOrFail($research_id);
        $patient = $research->patient;

        dd($patient);
    }

    // Удалить исследование
    public function deletePatientResearch(Request $request)
    {
        dd($request->all());
    }

    // Получить список исследований пациента (Datatable)
    public function getPatientResearch(Request $request)
    {
        $patient = Patient::findOrFail($request->patient_id);

        //TODO: Допилить фильтры по таблицам со связями
        return Datatables::of($patient->researches)
            ->setRowId('research_{{$id}}')
            ->setRowData(['research_id' => '{{$id}}'])
            ->editColumn('research_id', function ($p_research) {
                return $p_research->research->name;
            })
             ->editColumn('status', function ($p_research) {
                return $p_research->status == 'on' ? 'Готов' : 'Не готов';
            })
            // ->editColumn('birth_date', function ($patients) {
            //     return $patients->birth_date ? with(new Carbon($patients->birth_date))->format('d.m.Y') : '';
            // })
            // ->filterColumn('card_date', function ($query, $keyword) {
            //     $query->whereRaw("DATE_FORMAT(card_date,'%d.%m.%Y') like ?", ["%$keyword%"]);
            // })
            // ->filterColumn('birth_date', function ($query, $keyword) {
            //     $query->whereRaw("DATE_FORMAT(birth_date,'%d.%m.%Y') like ?", ["%$keyword%"]);
            // })
             ->addColumn('action', function ($p_research) {
                return '<div class="action-btn-center">
                            <a href="'.route('registry.patients.research.edit', $p_research->id).'" data-toggle="tooltip" data-placement="bottom" data-original-title="Список анализов" class="btn action-btn btn-warning waves-effect">
                                    <i class="material-icons">assignment</i>
                            </a>
                        </div>';
            })
            ->make(true);
    }
}
