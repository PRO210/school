<?php

//Moldel e controler dos LOGS
Route::get('/alunos/logs', 'Logs\LogController@showalunos');

//Moldel e controler dos Alunos
Route::resource('/alunos', 'Alunos\AlunoController');
Route::post('/alunos/update/bloco', 'Alunos\AlunoController@updatebloco');
Route::post('/alunos/update/agora', 'Alunos\AlunoController@updateagora');
Route::get('/{id}/aluno/mostrar/{id_turma}', 'Alunos\AlunoController@show')->name('visualizar');
Route::get('/{id}/aluno/turma', 'Alunos\AlunoController@showturma')->name('edição/turma');
Route::get('/{id}/aluno/{id_turma}', 'Alunos\AlunoController@editar')->name('edição');
Route::get('/{id}/historico/{id_turma}', 'Alunos\AlunoController@historico')->name('histórico');



Route::post('/alunos/update/turma', 'Alunos\AlunoController@update_turma');


//Route::get('/export', 'ExportController@export')->name('invoices');




Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/roles', 'HomeController@rolesPermissions')->name('home/roles');
