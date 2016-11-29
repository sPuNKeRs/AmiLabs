<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResearchTypeRequest;
use App\Http\Requests\AnalysisRequest;


use App\ResearchType;

class ReferenceController extends Controller
{
    // Начальная страница Справочники
    public function index(Request $request)
    {
        $researchTypes = ResearchType::all();

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

        return view('admin.reference.index', compact('researchTypes', 'modal_create', 'modal_edit'));
    }

    // Добавление вида исследования
    public function addResearchType(ResearchTypeRequest $request)
    {
        $type = ResearchType::create($request->all());

        return response($type);
    }

    // Получить данные вида исследования по ID
    public function getResearchTypeById($type_id)
    {
        $type = ResearchType::findOrFail($type_id);

        return response($type);
    }

    // Обновить данные вида исселодования по ID
    public function updateResearchTypeById(ResearchTypeRequest $request)
    {
        $input = $request->all();
        $type = ResearchType::findOrFail($input['type_id']);

        if($type->update($input))
        {
            return response($type);
        }

        //TODO: Добавить обработку ошибок
    }

    // Удалить вид исследования по ID
    public function deleteResearchTypeById(Request $request)
    {
        $type = ResearchType::findOrFail($request->type_id);

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
        $research = ResearchType::findOrFail($research_id);

        $modal_create = [
            'modal_id' => 'modal_create',
            'modal_title'=> 'ДОБАВИТЬ АНАЛИЗ',
            'modal_body' => view('admin.reference.forms.addanalysis', ['research_id' => $research->id]),
            'modal_action' => '<button id="btn-save" type="button" class="btn btn-link waves-effect">ДОБАВИТЬ</button>'
        ];

        return view('admin.reference.analyzes.list', compact('research', 'modal_create'));
    }

    // Добавление анализа к исследованию
    public function analysisAdd(AnalysisRequest $request)
    {
        $research = ResearchType::findOrFail($request->research_id);

        $analisis = Analysis::create($request->all());

        //return response($research);
        return response($analisis);
    }
}
