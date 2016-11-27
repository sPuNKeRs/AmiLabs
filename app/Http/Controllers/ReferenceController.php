<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnalyzisTypeRequest;

use App\AnalysisType;

class ReferenceController extends Controller
{
    // Начальная страница Справочники
    public function index(Request $request)
    {
        $analysisTypes = AnalysisType::all();

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

        return view('admin.reference.index', compact('analysisTypes', 'modal_create', 'modal_edit'));
    }

    // Добавление вида исследования
    public function addAnalyzisType(AnalyzisTypeRequest $request)
    {
        $type = AnalysisType::create($request->all());

        return response($type);
    }

    // Получить данные вида исследования по ID
    public function getAnalyzisTypeById($type_id)
    {
        $type = AnalysisType::findOrFail($type_id);

        return response($type);
    }

    // Обновить данные вида исселодования по ID
    public function updateAnalyzisTypeById(AnalyzisTypeRequest $request)
    {
        $input = $request->all();
        $type = AnalysisType::findOrFail($input['type_id']);

        if($type->update($input))
        {
            return response($type);
        }

        //TODO: Добавить обработку ошибок
    }

    // Удалить вид исследования по ID
    public function deleteAnalyzisTypeById(Request $request)
    {
        $type = AnalysisType::findOrFail($request->type_id);

        if($type->delete())
        {
            return response(['staus'=>true]);
        }
        else
        {
            return response(['staus'=>false]);
        }
    }
}
