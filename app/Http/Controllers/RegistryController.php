<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
		return Datatables::of(User::query())->make(true);
    }

    // Страница регистрации нового пациента
    public function create()
    {
        return view('registry.patients.create');
    }

    // Сохранение пациента
    public function save()
    {
        return response('Save patient!!!');
    }
}
