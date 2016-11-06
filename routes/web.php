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

Route::group(['middleware' => ['auth', 'menu']], function () {
    Route::get('/', function () {
        return redirect('registry');
    });
});

// -----------------------------------------------------------
// --------------------- РЕГИСТРАТУРА ------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth', 'menu']], function () {
  // Страница регистратуры
  Route::get('/registry', [
    'as' => 'registry', 
    'uses' => 'RegistryController@index'
  ]);
});

// -----------------------------------------------------------
// ----------------------- ОТЧЕТЫ ----------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth', 'menu']], function () {
	// Страница отчетов
	Route::get('/reports', [
		'as' => 'reports',
		'uses' => 'ReportsController@index'
	]);
});

// -----------------------------------------------------------
// ---------------------- НАСТРОЙКИ --------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth', 'menu']], function () {
	// Страница отчетов
	Route::get('/settings', [
		'as' => 'settings',
		'uses' => 'SettingsController@index'
	]);
});

// -----------------------------------------------------------
// ----------------------- ПРОФИЛЬ ---------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth', 'menu']], function () {
	// Страница Профиль
	Route::get('/profile/{userid?}', [
		'as' => 'profile',
		'uses' => 'ProfileController@index'
	]);
});

// -----------------------------------------------------------
// -------------------- ПОЛЬЗОВАТЕЛИ -------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth', 'menu']], function () {
    // Страница Пользователи
    Route::get('/users', [
        'as' => 'users',
        'uses' => 'UsersController@index'
    ]);

    // Страница создания пользователя
    Route::get('/users/create', [
        'as' => 'users.create', 
        'uses' => 'UsersController@userCreate'
    ]);

    // Сохранение пользователя
    Route::post('/users/create', [
        'as' => 'users.create', 
        'uses' => 'UsersController@create'
    ]);
});

// -----------------------------------------------------------
// -------------------- СПРАВОЧНИКИ --------------------------
// -----------------------------------------------------------
Route::group(['middleware' => ['auth', 'menu']], function () {
    // Страница Справочники
    Route::get('/reference', [
        'as' => 'reference',
        'uses' => 'ReferenceController@index'
    ]);
});

