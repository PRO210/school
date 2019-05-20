<?php
//Moldel e controler dos LOGS
Route::get('/alunos/logs', 'Logs\LogController@showalunos');

//Moldel e controler dos Alunos
Route::resource('/alunos', 'Alunos\AlunoController');
Route::post('/alunos/update/bloco', 'Alunos\AlunoController@updatebloco');
Route::post('/alunos/update/agora', 'Alunos\AlunoController@updateagora');
Route::get('/alunos/mostrar/unico', 'Alunos\AlunoController@show');

//Route::get('/export', 'ExportController@export')->name('invoices');




Route::get('/', function () {
    return view('welcome');
});

