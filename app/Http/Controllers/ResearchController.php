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
            'modal_title'=> 'ВЫБЕРИТЕ ВИД ИССЛЕДОВАНИЯ',
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

        $modal_choose_alert = [
            'modal_id' => 'modal_choose_alert',
            'modal_title'=> 'ВЫБЕРИТЕ ВИД УВЕДОМЛЕНИЯ ',
            'modal_body' => view('notify.forms.choosealert', compact('patient_research', 'patient')),
            'modal_action' => '<div class="md-preloader pl-size-xs" style="vertical-align: middle; display: none;">
                            <svg viewBox="0 0 75 75">
                                <circle cx="37.5" cy="37.5" r="33.5" class="pl-green" stroke-width="5"></circle>
                            </svg>
                        </div><button id="btn-alert" type="submit" class="btn btn-link waves-effect">ОТПРАВИТЬ</button>'
        ];

        return view('registry.research.blank.default', compact('patient', 'research', 'modal_choose_alert'));
    }

    // Сохранение исследования пациента
    public function savePatientResearch(Request $request)
    {
        $input = $request->all();
        dd($input);
        $patient_research = PatientResearh::create($input);


        $pays = $request->get('pay');

        // Сохраняем результаты анализов
        foreach($request->get('analyzes') as $key => $result)
        {
            $pay = (isset($pays[$key])) ? $pays[$key] : null;

            $analysis_result = new ResearchResult([
                'analysis_id' => $key,
                'result'=> $result,
                'pay' => $pay
            ]);
            $patient_research->results()->save($analysis_result);
        }


        if($request->ajax())
        {
            return response(['status'=>true, 'patient_research_id' => $patient_research->id ]);
        }

        return redirect()->route('registry.patients.research.list', $request->patient_id);
    }

    // Открыть на редактирование исследование
    public function editPatientResearch($research_id)
    {
        $patient_research = PatientResearh::findOrFail($research_id);
        $patient = $patient_research->patient;
        $modal_choose_alert = [
            'modal_id' => 'modal_choose_alert',
            'modal_title'=> 'ВЫБЕРИТЕ ВИД УВЕДОМЛЕНИЯ ',
            'modal_body' => view('notify.forms.choosealert', compact('patient_research', 'patient')),
            'modal_action' => '<div class="md-preloader pl-size-xs" style="vertical-align: middle; display: none;">
                            <svg viewBox="0 0 75 75">
                                <circle cx="37.5" cy="37.5" r="33.5" class="pl-green" stroke-width="5"></circle>
                            </svg>
                        </div><button id="btn-alert" type="submit" class="btn btn-link waves-effect">ОТПРАВИТЬ</button>'
        ];

        return view('registry.research.blank.edit', compact('patient', 'patient_research', 'modal_choose_alert'));
    }

    // Сохранить отредактированное исследование
    public function updatePatientResearch(PatientResearhRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? $input['status'] : '';

        //dd($input);

        // Создаем новое исследование
        if($input['patient_research_id'] == '')
        {
            $patient_research = PatientResearh::create($input);
            $pays = $request->get('pay');

            $analyzes_results_id = array();
            //$pays_results_id = array();

            // Сохраняем результаты анализов
            foreach($request->get('analyzes') as $key => $result)
            {
                $pay = (isset($pays[$key])) ? $pays[$key] : null;

                $analysis_result = new ResearchResult([
                    'analysis_id' => $key,
                    'result'=> $result,
                    'pay' => $pay
                ]);

                $patient_research->results()->save($analysis_result);
                array_push($analyzes_results_id, $analysis_result->id);
            }

            $input['patient_research_id'] = $patient_research->id;
        }
        else
        {
            PatientResearh::findOrFail($request->patient_research_id)->update($input);

            $pays = $request->get('pay');
            $analyzes = $request->get('analyzes');

            foreach($analyzes as $key => $analysis)
            {
                $pay = (isset($pays[$key])) ? $pays[$key] : null;
                ResearchResult::find($key)->update(['result' => $analysis, 'pay'=>$pay ]);
            }
        }

        if($request->ajax())
        {
            return response(['status' => true, 
                             'patient_id' => $request->patient_id, 
                             'patient_research_id' => $input['patient_research_id'],
                             'analyzes_results_id' => isset($analyzes_results_id) ? $analyzes_results_id : null ]);
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
                if($p_research->issue_date){
                    $issue_date = '('.$p_research->issue_date.')';
                }else{
                    $issue_date = '';
                }
                return $p_research->status == 'on' ? 'Выдан '.$issue_date : 'Не выдан';
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
