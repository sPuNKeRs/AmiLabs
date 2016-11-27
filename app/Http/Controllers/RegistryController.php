<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\PatientCardRequest;
use App\Patient;
use Yajra\Datatables\Datatables;
use Auth;

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
            ->addColumn('action', function ($patients) {
                return '<div class="action-btn-center">
                            <a href="'.route('registry.patients.analyzis.list', $patients->id).'" data-toggle="tooltip" data-placement="bottom" data-original-title="Список анализов" class="btn action-btn btn-warning waves-effect">
                                    <i class="material-icons">assignment</i>
                            </a>
                        </div>';
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
        $input['author_id'] = Auth::user()->id;

        if(isset($input['patient_id']) && $input['patient_id'] > 0)
        {
            $patient = Patient::findOrFail($input['patient_id']);

            $patient->update($input);

            return view('registry.index');
        }

        Patient::create($input);

        return view('registry.index');
    }

    // Страница редактирования данных пациента
    public function edit($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        return view('registry.patients.edit', compact('patient'));
    }
}
