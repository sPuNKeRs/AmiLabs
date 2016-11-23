<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $patients = Patient::all();

        return Datatables::of($patients)
            ->setRowId('patient_{{$id}}')
            ->setRowData(['patient_id' => '{{$id}}'])
            ->editColumn('card_date', function ($patients) {
                return $patients->card_date ? with(new Carbon($patients->card_date))->format('d.m.Y') : '';
            })
            ->editColumn('birth_date', function ($patients) {
                return $patients->birth_date ? with(new Carbon($patients->birth_date))->format('d.m.Y') : '';;
            })
            ->filterColumn('card_date', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(card_date,'%d.%m.%Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('birth_date', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(birth_date,'%d.%m.%Y') like ?", ["%$keyword%"]);
            })
            ->make(true);
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
