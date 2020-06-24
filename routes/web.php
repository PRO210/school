<?php

//Moldel e controler dos LOGS

use Illuminate\Routing\RouteGroup;

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
//
Route::prefix('admin')
        ->middleware('auth')
        ->namespace('Admin')
        ->group(function() {

             //
        //Planos        //Planos        //Planos
        Route::put('/plans/{url}/', 'PlanController@update')->name('plans.update');
        Route::any('/plans/{url}/edit', 'PlanController@edit')->name('plans.edit');        
        Route::any('/search', 'PlanController@search')->name('plans.search');
        Route::get('/plans', 'PlanController@index'  )->name('plans.index');
        Route::post('/plans', 'PlanController@store'  )->name('plans.store');
        Route::get('/plans/create/', 'PlanController@create' )->name('plans.create');
        Route::get('/plans/{url}','PlanController@show'     )->name('plans.show');
        Route::delete('/plans/{url}','PlanController@delete')->name('plans.delete');
        //
        //Routes Details Plan       //Routes Details Plan       //Routes Details Plan
        Route::delete('/plans/{url}/details/{idDetail}','DetailPlanController@destroy')->name('details.plan.destroy');
        Route::put('/plans/{url}/details/{idDetail}','DetailPlanController@update')->name('details.plan.update');
        Route::get('/plans/{url}/details/{idPlan}/edit','DetailPlanController@edit')->name('details.plan.edit');
        Route::get('/plans/{url}/details','DetailPlanController@index')->name('details.plan.index');
        Route::post('/plans/{url}/details/', 'DetailPlanController@store')->name('details.plan.store');
        Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
        Route::get('/plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
        //
        // Router Profiles      // Router Profiles      // Router Profiles
        Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
        Route::resource('profiles', 'ACL\ProfileController');
        //    
        // Router Permission      // Router Permissions      // Router Permission
        Route::any('/permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
        Route::resource('/permissions', 'ACL\PermissionController');
        /**
         * Permission x Profile
         */
        Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permission.detach');
        Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
        Route::any('profile/{idProfile}/permissions/create', 'ACL\PermissionProfileController@profilePermissionsAvailable')->name('profiles.permissions.available');
        Route::get('profile/{idProfile}/permissions/', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
        /**
         * Plan x Profile
         */
        Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');
        Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
        Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');
        /**
         * Routes Roles
         */
        Route::any('roles/search', 'ACL\RoleController@search')->name('roles.search');
        Route::resource('roles', 'ACL\RoleController');
        //
        /**
         * Permission x Role
         */
        Route::get('roles/{id}/permission/{idPermission}/detach', 'ACL\PermissionRoleController@detachPermissionRole')->name('roles.permission.detach');
        Route::post('roles/{id}/permissions', 'ACL\PermissionRoleController@attachPermissionsRole')->name('roles.permissions.attach');
        Route::any('roles/{id}/permissions/create', 'ACL\PermissionRoleController@permissionsAvailable')->name('roles.permissions.available');
        Route::get('roles/{id}/permissions', 'ACL\PermissionRoleController@permissions')->name('roles.permissions');
        Route::get('permissions/{id}/role', 'ACL\PermissionRoleController@roles')->name('permissions.roles');

        // Router Users      // Router Users      // Router Users
        Route::any('users/search', 'UserController@search')->name('users.search');
        Route::resource('users', 'UserController');
        //
        /**
     * Role x User
     */
        Route::get('users/{id}/role/{idRole}/detach', 'ACL\RoleUserController@detachRoleUser')->name('users.role.detach');
        Route::post('users/{id}/roles', 'ACL\RoleUserController@attachRolesUser')->name('users.roles.attach');
        Route::any('users/{id}/roles/create', 'ACL\RoleUserController@rolesAvailable')->name('users.roles.available');
        Route::get('users/{id}/roles', 'ACL\RoleUserController@roles')->name('users.roles');
        Route::get('roles/{id}/users', 'ACL\RoleUserController@users')->name('roles.users');

        //
        /**
        * Routes Tenants
        */
        Route::any('tenants/search', 'TenantController@search')->name('tenants.search');
        Route::resource('tenants', 'TenantController');

});


//
//Route::get('/export', 'ExportController@export')->name('invoices');
// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * Site
 */
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');
//
//

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('/home/roles', 'HomeController@rolesPermissions')->name('home/roles');


