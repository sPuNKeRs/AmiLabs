<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\PatientResearhRequest;
use App\Patient;
use App\Research;
use App\PatientResearh;
use App\ResearchResult;

class ResearchController extends Controller
{
    // Показать страницу с исследованиями пациента
    public function researchs_list($patient_id)
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
        $patient_researh = PatientResearh::create($input);

        // Сохраняем результаты анализов
        foreach($request->get('analyzes') as $key => $result)
        {
            //if(trim($result) == '') continue;

            $analysis_result = new ResearchResult([
                'analysis_id' => $key,
                'result'=> $result,
                'pay' => null
            ]);
            $patient_researh->results()->save($analysis_result);
        }

        return redirect()->route('registry.patients.research.list', $request->patient_id);
    }

    // Открыть на редактирование исследование
    public function editPatientResearch($research_id)
    {
        $patient_research = PatientResearh::findOrFail($research_id);
        $patient = $patient_research->patient;

        return view('registry.research.blank.edit', compact('patient', 'patient_research'));
    }

    // Сохранить отредактированное исследование
    public function updatePatientResearch(PatientResearhRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? $input['status'] : '';

        PatientResearh::find($request->patient_research_id)->update($input);

        $analyzes = $request->get('analyzes');
        foreach($analyzes as $key => $analysis)
        {
            ResearchResult::find($key)->update(['result' => $analysis]);
        }

        return redirect()->route('registry.patients.research.list', $request->patient_id);
    }

    // Удалить исследование
    public function deletePatientResearch(Request $request)
    {
        //TODO: Удалить исследование и входящие в него анализы
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
             ->addColumn('action', function ($p_research) {
                return '<div class="action-btn-center">
                            <a href="'.route('registry.patients.research.edit', $p_research->id).'" data-toggle="tooltip" data-placement="bottom" data-original-title="Список анализов" class="btn action-btn btn-warning waves-effect">
                                    <i class="material-icons">assignment</i>
                            </a>
                        </div>';
            })->make(true);
    }
}
