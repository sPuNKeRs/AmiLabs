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

        $modal = [
            'modal_title'=> 'ДОБАВИТЬ ВИД ИССЛЕДОВАНИЯ',
            'modal_body' => view('admin.reference.forms.addtypes'),
            'modal_action' => '<button id="btn-save" type="button" class="btn btn-link waves-effect">ДОБАВИТЬ</button>'
        ];

        return view('admin.reference.index', compact('analysisTypes', 'modal'));
    }

    // Добавление вида исследования
    public function addAnalyzisType(AnalyzisTypeRequest $request)
    {
        $type = AnalysisType::create($request->all());

        return response($type);
    }
}
