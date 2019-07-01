<?php

//Moldel e controler dos LOGS
Route::resource('/logs', 'Logs\LogController');
Route::get('/alunos/logs', 'Logs\LogController@showalunos');
Route::get('/disciplinas/logs', 'Logs\LogController@showdisciplinas');

//Moldel e controler dos Alunos
Route::resource('/alunos', 'Alunos\AlunoController');
Route::post('/alunos/update/bloco', 'Alunos\AlunoController@updatebloco');
Route::post('/alunos/update/agora', 'Alunos\AlunoController@updateagora');
Route::get('/{id}/aluno/mostrar/{id_turma}', 'Alunos\AlunoController@show')->name('visualizar');
Route::get('/{id}/aluno/turma', 'Alunos\AlunoController@showturma')->name('edição/turma');
Route::get('/{id}/aluno/{id_turma}', 'Alunos\AlunoController@editar')->name('edição/aluno');
Route::get('/{id}/historico/{id_turma}', 'Alunos\AlunoController@historico')->name('histórico');
Route::post('/alunos/update/turma', 'Alunos\AlunoController@update_turma');
//
//Aluno Solicitações
Route::post('/aluno/solicitação/transferência', 'Alunos\SolicitacaoController@store');
Route::resource('/alunos/solicitações/transferência', 'Alunos\SolicitacaoController');
Route::get('/alunos/solicitações/transferência/show/{id}', 'Alunos\SolicitacaoController@show');
Route::post('/alunos/solicitações/transferência/editar', 'Alunos\SolicitacaoController@editar');
Route::post('/alunos/solicitações/transferência/update', 'Alunos\SolicitacaoController@update');
//
//Disciplinas
Route::resource('/disciplinas', 'Disciplinas\DisciplinaController');
Route::post('/disciplinas/update/bloco', 'Disciplinas\DisciplinaController@updatebloco');
Route::post('/disciplinas/update/bloco/server', 'Disciplinas\DisciplinaController@updateblocoserver');
Route::get('/{id}/Disciplinas', 'Disciplinas\DisciplinaController@edit')->name('edição');
Route::get('/{id}/disciplinas', 'Disciplinas\DisciplinaController@destroy')->name('deletar');



//Route::get('/export', 'ExportController@export')->name('invoices');






Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/roles', 'HomeController@rolesPermissions')->name('home/roles');
