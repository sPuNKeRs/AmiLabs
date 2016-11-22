<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientCardRequest;
use App\Patient;
use Yajra\Datatables\Datatables;

class RegistryController extends Controller
{
    // Начальная страница регистратуры
    public function index(Request $request)
    {
      return view('registry.index');
    }

    // Получить список пациентов
    public function getData()
    {
		return Datatables::of(Patient::query())->make(true);
    }

    // Страница регистрации нового пациента
    public function create()
    {
        // Получить последний номер карты        
        $next_id = Patient::getNextId();

        return view('registry.patients.create', compact('next_id'));
    }

    // Сохранение пациента
    public function save(PatientCardRequest $request)
    {
        $input = $request->all();
        Patient::create($input);

        return view('registry.index');
    }
}
