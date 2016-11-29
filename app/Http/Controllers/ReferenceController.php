<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResearchRequest;
use App\Http\Requests\AnalysisRequest;

use App\Analysis;


use App\Research;

class ReferenceController extends Controller
{
    // Начальная страница Справочники
    public function index(Request $request)
    {
        $researchs = Research::all();

        $modal_create = [
            'modal_id' => 'modal_create',
            'modal_title'=> 'ДОБАВИТЬ ВИД ИССЛЕДОВАНИЯ',
            'modal_body' => view('admin.reference.forms.addtypes'),
            'modal_action' => '<button id="btn-save" type="button" class="btn btn-link waves-effect">ДОБАВИТЬ</button>'
        ];

          $modal_edit = [
            'modal_id' => 'modal_edit',
            'modal_title'=> 'РЕДАКТИРОВАТЬ ВИД ИССЛЕДОВАНИЯ',
            'modal_body' => view('admin.reference.forms.addtypes'),
            'modal_action' => '<button id="btn-update" type="button" class="btn btn-link waves-effect">СОХРАНИТЬ</button>'
        ];

        return view('admin.reference.index', compact('researchs', 'modal_create', 'modal_edit'));
    }

    // Добавление вида исследования
    public function addResearch(ResearchRequest $request)
    {
        $type = Research::create($request->all());

        return response($type);
    }

    // Получить данные вида исследования по ID
    public function getResearchById($type_id)
    {
        $type = Research::findOrFail($type_id);

        return response($type);
    }

    // Обновить данные вида исселодования по ID
    public function updateResearchById(ResearchRequest $request)
    {
        $input = $request->all();
        $type = Research::findOrFail($input['type_id']);

        if($type->update($input))
        {
            return response($type);
        }

        //TODO: Добавить обработку ошибок
    }

    // Удалить вид исследования по ID
    public function deleteResearchById(Request $request)
    {
        $type = Research::findOrFail($request->type_id);

        if($type->delete())
        {
            return response(['staus'=>true]);
        }
        else
        {
            return response(['staus'=>false]);
        }
    }

    // Страница со списком анализов исследования
    public function analyzesList($research_id)
    {
        $research = Research::findOrFail($research_id);

        $analyzes = $research->analyses;

        $modal_create = [
            'modal_id' => 'modal_create',
            'modal_title'=> 'ДОБАВИТЬ АНАЛИЗ',
            'modal_body' => view('admin.reference.forms.addanalysis', ['research_id' => $research->id]),
            'modal_action' => '<button id="btn-save" type="button" class="btn btn-link waves-effect">ДОБАВИТЬ</button>'
        ];

        $modal_edit = [
            'modal_id' => 'modal_edit',
            'modal_title'=> 'РЕДАКТИРОВАТЬ АНАЛИЗ',
            'modal_body' => view('admin.reference.forms.addanalysis', ['research_id' => $research->id]),
            'modal_action' => '<button id="btn-update" type="button" class="btn btn-link waves-effect">СОХРАНИТЬ</button>'
        ];

        return view('admin.reference.analyzes.list', compact('research', 'modal_create', 'modal_edit', 'analyzes'));
    }

    // Добавление анализа к исследованию
    public function analysisAdd(AnalysisRequest $request)
    {
        $research = Research::findOrFail($request->research_id);

        $analysis = Analysis::create($request->all());

        $iteration = Analysis::where('research_id','=',$request->research_id)->count();

        $list_row = view('admin.reference.analyzes.list-row', compact('analysis', 'iteration'));

        return response($list_row);
    }

    // Удаление анализа
    public function analysisDelete(Request $request)
    {
        $analysis_id = $request->analysis_id;
        $analysis = Analysis::findOrFail($analysis_id);

        if($analysis->delete())
        {
            return response(['staus'=>true]);
        }
        else
        {
            return response(['staus'=>false]);
        }
    }

    // Получить анализ по ID
    public function getAnalysisByID(Request $request)
    {
        $analysis = Analysis::findOrFail($request->analysis_id);

        return response($analysis);
    }

    // Обновить данные анализа по ID
    public function updateAnalysisByID(AnalysisRequest $request)
    {
        $input = $request->all();
        $analysis = Analysis::findOrFail($request->analysis_id);
        $iteration = $input['iteration'];
        $analysis->update($input);

        $list_row = view('admin.reference.analyzes.list-row', compact('analysis', 'iteration'));

        return response($list_row);
    }
}
