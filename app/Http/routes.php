<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/** Login/Logout **/
Route::get('/', 'Auth\AuthController@getLogin');
Route::post('/', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

/*------------------*/
Route::get('/redirect', 'PagesController@redirect');

/** Usuarios **/
Route::get('users', 'UsersController@index');
Route::get('users/register', 'Auth\AuthController@getRegister');
Route::post('users/register', 'Auth\AuthController@postRegister');
Route::get('users/{id?}/edit', 'UsersController@edit');
Route::post('users/{id?}/edit', 'UsersController@update');

/** Roles **/
Route::get('roles', 'RolesController@index');
Route::get('roles/create', 'RolesController@create');
Route::post('roles/create', 'RolesController@store');

/** ROOT**/
Route::group(array('prefix' => 'root', 'namespace' => 'Root', 'middleware' => 'guardian:1'), function () {
	Route::get('/', 'RootController@home');
	Route::get('/usuarios', 'RootController@users');
	Route::get('/usuarios/registrar', 'RootController@createUsers');
	Route::post('/usuarios/registrar', 'RootController@storeUsers');
	Route::get('/usuarios/{id?}/eliminar', 'RootController@destroyUsers');
	Route::get('/usuarios/{id?}/editar', 'RootController@editUsers');
	Route::post('/usuarios/{id?}/editar', 'RootController@updateUsers');

	Route::get('/lineamientos', 'RootController@lineamientos');
	Route::get('/lineamientos/registrar', 'LineamientoController@createLineamientos');
	Route::post('/lineamientos/registrar', 'LineamientoController@storeLineamientos');
	Route::get('/lineamientos/{id?}/editar', 'LineamientoController@editLineamientos');
	Route::post('/lineamientos/{id?}/editar', 'LineamientoController@updateLineamientos');
	
	Route::get('/objetivos', 'ObjetivoController@objetivos');
	Route::get('/objetivos/registrar', 'ObjetivoController@createObjetivo');
	Route::post('/objetivos/registrar', 'ObjetivoController@storeObjetivo');
	Route::get('/objetivos/{id?}/editar', 'ObjetivoController@editObjetivo');
	Route::post('/objetivos/{id?}/editar', 'ObjetivoController@updateObjetivo');
	Route::get('/objetivos/{id?}/eliminar', 'ObjetivoController@destroyObjetivo');

	Route::get('/componentes', 'ComponenteController@componentes');
	Route::get('/componentes/registrar', 'ComponenteController@createComponente');
	Route::post('/componentes/registrar', 'ComponenteController@storeComponente');
	Route::get('/componentes/{id?}/editar', 'ComponenteController@editComponente');	
	Route::post('/componentes/{id?}/editar', 'ComponenteController@updateComponente');
	Route::get('/componentes/{id?}/eliminar', 'ComponenteController@destroyComponente');

	Route::get('/iniciativas', 'IniciativaController@iniciativas');
	Route::get('/iniciativas/registrar', 'IniciativaController@createIniciativa');
	Route::post('/iniciativas/registrar', 'IniciativaController@storeIniciativa');
	Route::get('/iniciativas/{id?}/eliminar', 'IniciativaController@destroyIniciativa');

	Route::get('/indicadores', 'IndicadorController@indicadores');
	Route::get('/indicadores/registrar', 'IndicadorController@createIndicador');
	Route::post('/indicadores/registrar', 'IndicadorController@storeIndicador');
	Route::get('/indicadores/{id?}/eliminar', 'IndicadorController@destroyIndicador');

	Route::get('/verificaciones', 'VerificacionController@verificaciones');
	Route::get('/verificaciones/registrar', 'VerificacionController@createVerificacion');
	Route::post('/verificaciones/registrar', 'VerificacionController@storeVerificacion');
	Route::get('/verificaciones/{id?}/eliminar', 'VerificacionController@destroyVerificacion');

	Route::get('/actividades', 'ActividadController@actividades');
	Route::get('/actividades/registrar', 'ActividadController@createActividad');
	Route::post('/actividades/registrar', 'ActividadController@storeActividad');
	Route::get('/actividades/{id?}/eliminar', 'ActividadController@destroyActividad');

});

Route::group(array('prefix' => 'manager', 'namespace' => 'Manager', 'middleware' => 'guardian:2'), function () {
	Route::get('/', 'ManagerController@home');
	Route::get('/lineamientos', 'ManagerController@lineamientos');
	Route::get('/componentes', 'ManagerController@componentes'); 
	Route::get('/componentes/{id?}/iniciativas', 'ManagerController@iniciativas');
	Route::get('/componentes/{id?}/iniciativas-lineamientos', 'ManagerController@iniciativasLineamientos');
	Route::get('/componentes/iniciativa/{id?}', 'ManagerController@acceptIniciativa');
	Route::get('/iniciativas/{id?}/modificar', 'ManagerController@editIniciativa');
	Route::post('/iniciativas/{id?}/modificar', 'ManagerController@updateIniciativa');
	Route::get('/iniciativas/{id?}/medios-de-verificacion', 'ManagerController@showMedios');
	Route::get('/iniciativas/{id?}/remover', 'ManagerController@deleteIniciativa');
	Route::get('/iniciativas/{id?}/solicitud', 'ManagerController@makeRequest');
	Route::get('/lineamientos/{id?}/mostrar', 'ManagerController@showLineamiento');
	Route::post('/medios-de-verificacion/{id?}/upload', 'ManagerController@uploadFile');
	Route::get('/download/{id?}', 'ManagerController@downloadFile');
	Route::get('/delete/{id?}', 'ManagerController@deleteFile');
	Route::post('/iniciativas/{id?}/medios-de-verificacion', 'ManagerController@addMedios');
	Route::get('/iniciativas/{id?}/indicador', 'ManagerController@addIndicador');
	Route::post('/iniciativas/{id?}/indicador', 'ManagerController@storeIndicador');
	Route::get('/iniciativas/{id?}/actividad', 'ManagerController@addActividad');
	Route::post('/iniciativas/{id?}/actividad', 'ManagerController@storeActividad');
	Route::get('/historial', 'ManagerController@showHistorial');
	Route::get('/cuenta', 'ManagerController@showConfiguracion');
	Route::post('/cuenta', 'ManagerController@changePassword');
});

Route::group(array('prefix' => 'administrador', 'namespace' => 'Administrador', 'middleware' => 'guardian:3'), function(){
	Route::get('/', 'AdministradorController@home');
	Route::get('/lineamientos', 'AdministradorController@lineamientos');
	Route::get('/lineamientos/{id?}/mostrar', 'AdministradorController@showLineamiento');
	Route::get('/accept/{id?}', 'AdministradorController@acceptFile');
	Route::get('/reject/{id?}', 'AdministradorController@rejectFile');
	Route::get('/acceptIniciativa/{id?}', 'AdministradorController@acceptRequest');
	Route::get('/rejectIniciativa/{id?}', 'AdministradorController@rejectRequest');
	Route::get('/historial', 'AdministradorController@showHistorial');
	Route::get('/componentes/{id?}/iniciativas', 'AdministradorController@iniciativas');
});




