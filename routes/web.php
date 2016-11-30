<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['auth','roles','menu']], function () {
    Route::get('/', function () {
        return redirect('registry');
    });
});

// -----------------------------------------------------------
// --------------------- РЕГИСТРАТУРА ------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth','roles','menu']], function () {
  // Страница регистратуры
  Route::get('/registry', [
    'as' => 'registry',
    'uses' => 'RegistryController@index'
  ]);

  // Загрузить список пациентов
  Route::get('/registry/data', [
    'as' => 'registry.data',
    'uses' => 'RegistryController@getData'
  ]);

  // Страница регистрации нового пациента
  Route::get('/registry/patients/create', [
    'as' => 'registry.patients.create',
    'uses' => 'RegistryController@create'
  ]);

  // Сохранить пациента
  Route::post('/registry/patients/create', [
    'as' => 'registry.patients.save',
    'uses' => 'RegistryController@save'
  ]);

  // Страница редактирования пациента
  Route::get('/registry/patients/edit/{patient_id?}', [
    'as' => 'registry.patients.edit',
    'uses' => 'RegistryController@edit'
  ]);


});

// -----------------------------------------------------------
// ----------------------- АНАЛИЗЫ ---------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth','roles','menu']], function () {
  // Страница с анализами пациента
  Route::get('/registry/patients/research/{patient_id?}',[
    'as' => 'registry.patients.research.list',
    'uses' => 'ResearchController@list'
  ]);

  // Страница исследования пациента
  Route::post('/registry/patients/research/add',[
    'as' => 'registry.patients.research.add',
    'uses' => 'ResearchController@addPatientResearch'
  ]);

  // Сохранение исследования пациента
  Route::post('/registry/patients/research/save',[
    'as' => 'registry.patients.research.save',
    'uses' => 'ResearchController@savePatientResearch'
  ]);

  // Получить данные исследований пациента
  Route::post('/registry/patients/research/get',[
    'as' => 'registry.patients.research.get',
    'uses' => 'ResearchController@getPatientResearch'
  ]);

});

// -----------------------------------------------------------
// ----------------------- ОТЧЕТЫ ----------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth','roles','menu']], function () {
	// Страница отчетов
	Route::get('/reports', [
		'as' => 'reports',
		'uses' => 'ReportsController@index'
	]);
});

// -----------------------------------------------------------
// ---------------------- НАСТРОЙКИ --------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth','roles','menu']], function () {
	// Страница общих настроек
	Route::get('/settings', [
		'as' => 'settings',
		'uses' => 'SettingsController@index',
    'roles' => ['admin']
	]);

    // Сохранение настроек
    Route::post('/settings', [
        'as' => 'settings',
        'uses' => 'SettingsController@edit',
        'roles' => ['admin']
    ]);
});

// -----------------------------------------------------------
// ----------------------- ПРОФИЛЬ ---------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth','roles','menu']], function () {
	// Страница Профиль
	Route::get('/profile/{userid?}', [
		'as' => 'profile',
		'uses' => 'ProfileController@index'
	]);

    // Сохранение профиля
    Route::post('/profile/edit', [
        'as' => 'profile',
        'uses' => 'ProfileController@edit'
    ]);
});

// -----------------------------------------------------------
// -------------------- ПОЛЬЗОВАТЕЛИ -------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth', 'roles', 'menu']], function () {
    // Страница Пользователи
    Route::get('/users', [
        'as' => 'users',
        'uses' => 'UsersController@index',
        'roles' => ['admin']
    ]);

    // Страница создания пользователя
    Route::get('/users/create', [
        'as' => 'users.create',
        'uses' => 'UsersController@userCreate',
        'roles' => ['admin']
    ]);

    // Сохранение пользователя
    Route::post('/users/create', [
        'as' => 'users.create',
        'uses' => 'UsersController@create',
        'roles' => ['admin']
    ]);

    // Страница редактирование пользователя
    Route::get('/users/edit/{userid}', [
        'as' => 'users.edit',
        'uses' => 'UsersController@userEdit',
        'roles' => ['admin']
    ]);

    // Редактирование пользователя
    Route::post('/users/edit', [
        'as' => 'users.edit',
        'uses' => 'UsersController@edit',
        'roles' => ['admin']
    ]);

    // Удаление пользователя
    Route::get('/users/delete/{userid}', [
        'as' => 'users.delete',
        'uses' => 'UsersController@delete',
        'roles' => ['admin']
    ]);
});

// -----------------------------------------------------------
// -------------------- СПРАВОЧНИКИ --------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth','roles','menu']], function () {
    // Страница Справочники
    Route::get('/reference', [
        'as' => 'reference',
        'uses' => 'ReferenceController@index',
        'roles' => ['admin']
    ]);

    // Добавить вид исследования
    Route::post('/reference/research/add', [
      'as' => 'reference.research.add',
      'uses' => 'ReferenceController@addResearch'
    ]);

    // Получить данные вида исследования по ID
    Route::get('/reference/research/edit/{type_id?}', [
      'as' => 'reference.research.edit',
      'uses' => 'ReferenceController@getResearchById'
    ]);

    // Обновить данные вида исследования
    Route::post('/reference/research/update', [
      'as' => 'reference.research.update',
      'uses' => 'ReferenceController@updateResearchById'
    ]);

    // Удалить вид исследования
    Route::post('/reference/research/delete', [
      'as' => 'reference.research.delete',
      'uses' => 'ReferenceController@deleteResearchById'
    ]);

    // Список анализов исследования
    Route::get('/reference/research/analyzes/{research_id?}',[
      'as' => 'reference.research.analyzes',
      'uses' => 'ReferenceController@analyzesList'
    ]);

    // Добавить анализ к исследованию
    Route::post('/reference/research/analysis/add',[
      'as' => 'reference.research.analysis.add',
      'uses' => 'ReferenceController@analysisAdd'
    ]);

    // Удаление анализа
    Route::post('/reference/research/analysis/delete',[
      'as' => 'reference.research.analysis.delete',
      'uses' => 'ReferenceController@analysisDelete'
    ]);

    // Получить анализ по ID
    Route::post('/reference/research/analysis/get',[
      'as' => 'reference.research.analysis.get',
      'uses' => 'ReferenceController@getAnalysisByID'
    ]);

    // Обновить данные анализа по ID
    Route::post('/reference/research/analysis/update',[
      'as' => 'reference.research.analysis.update',
      'uses' => 'ReferenceController@updateAnalysisByID'
    ]);
});

