<?php

//Moldel e controler dos LOGS
Route::resource('/logs', 'Logs\LogController');
Route::get('/alunos/logs', 'Logs\LogController@showalunos');
Route::get('/disciplinas/logs', 'Logs\LogController@showdisciplinas');

//Moldel e controler dos Alunos
Route::resource('/alunos', 'Alunos\AlunoController');
Route::get('/alunos/cursando/{id}', 'Alunos\AlunoController@cursando')->name('cursando');
Route::get('/alunos/cursando/create', 'Alunos\AlunoController@create');
Route::post('/alunos/update/bloco', 'Alunos\AlunoController@updatebloco');
Route::post('/alunos/update/agora', 'Alunos\AlunoController@updateagora');
Route::get('/aluno/deletar/{id}/{botao}', 'Alunos\AlunoController@destroy')->name('aluno/deletar');
Route::get('/{id}/aluno/mostrar/{id_turma}', 'Alunos\AlunoController@show')->name('visualizar');
Route::get('/{id}/aluno/turma', 'Alunos\AlunoController@showturma')->name('edição/turma');
Route::get('/{id}/aluno/{id_turma}', 'Alunos\AlunoController@editar')->name('edição/aluno');
Route::get('/{id}/transferência/{id_turma}', 'Alunos\AlunoController@historico')->name('transferência');
Route::post('/alunos/update/turma', 'Alunos\AlunoController@update_turma');
Route::get('/alunos/montar/relatório', 'Alunos\AlunoController@relatorio');
Route::post('/alunos/gerar/relatório', 'Alunos\AlunoController@relatorio_gerar');
//
//Aluno/históricos
Route::resource('/historicos', 'AlunosHistoricos\HistoricoController');
Route::get('/{id}/historico/{id_turma?}', 'AlunosHistoricos\HistoricoController@create')->name('histórico');
Route::get('/historico/transferência-{id}', 'Alunos\SolicitacaoController@show')->name('histórico_transferência');
Route::post('/aluno/históricos', 'AlunosHistoricos\HistoricoController@store');
Route::get('/historico/{id}/{ano}', 'AlunosHistoricos\HistoricoController@edit')->name('histórico/edição');
Route::get('/historico/excluir-{id}-{aluno_id}', 'AlunosHistoricos\HistoricoController@destroy')->name('historico_excluir');


//
//Aluno Solicitações
Route::post('/aluno/solicitação/transferência', 'Alunos\SolicitacaoController@store');
Route::resource('/alunos/solicitações/transferência', 'Alunos\SolicitacaoController');
Route::get('/alunos/solicitações/transferência/show/{id}', 'Alunos\SolicitacaoController@show');
Route::post('/alunos/solicitações/transferência/editar', 'Alunos\SolicitacaoController@editar');
Route::post('/alunos/solicitações/transferência/update', 'Alunos\SolicitacaoController@update');
Route::get('/alunos/solicitações/transferência/update/exportpdf/{id}/{turma}', 'ExportPdfController@exportpdf')->name('rosto_tranferencia_pdf');
Route::get('alunos/solicitações/transferência/deletar/{id}/', 'Alunos\SolicitacaoController@destroy')->name('pedido/deletar');
Route::get('alunos/solicitações/transferência/declaração/{aluno_id}/{id_turma}', 'Alunos\SolicitacaoController@declaracao')->name('declaração/transferência');
Route::post('alunos/solicitações/transferência/declaração/impressao', 'Alunos\SolicitacaoController@declaracao_impressao');

Route::get('alunos/solicitações/transferência/arquivo/{aluno_id}/{id_turma}', 'Arquivos\ArquivoController@edit')->name('arquivo');

//
//Disciplinas
Route::resource('/disciplinas', 'Disciplinas\DisciplinaController');
Route::post('/disciplinas/update/bloco', 'Disciplinas\DisciplinaController@updatebloco');
Route::post('/disciplinas/update/bloco/server', 'Disciplinas\DisciplinaController@updateblocoserver');
Route::get('/edição/disciplina/{id}', 'Disciplinas\DisciplinaController@edit')->name('edição/disciplina');
Route::get('/{id}/disciplinas', 'Disciplinas\DisciplinaController@destroy')->name('deletar');
//
//Cursos
Route::resource('/cursos', 'Cursos\CursoController');
Route::get('/Cursos/Edição/{id}', 'Cursos\CursoController@edit')->name('cursos/editar');
Route::get('/Cursos/Deletar/{id}', 'Cursos\CursoController@destroy')->name('cursos/deletar');
//
//Turmas
Route::resource('/turmas', 'Turmas\TurmaController');
Route::get('/Turmas/Edição/{id}', 'Turmas\TurmaController@edit')->name('turmas/edit');
Route::get('/Turmas/Deletar/{id}', 'Turmas\TurmaController@destroy')->name('turmas/destory');
Route::post('/turmas/update/bloco', 'Turmas\TurmaController@update_bloco');
//
//
Route::resource('/arquivos', 'Arquivos\ArquivoController');
Route::get('/arquivado', 'Arquivos\ArquivoController@arquivado')->name('arquivado');
Route::post('/arquivado/aluno', 'Arquivos\ArquivoController@arquivado_create');
Route::get('/deletar/{id}', 'Arquivos\ArquivoController@destroy')->name('arquivos/deletar');



//
//Route::get('/export', 'ExportController@export')->name('invoices');


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('/home/roles', 'HomeController@rolesPermissions')->name('home/roles');

