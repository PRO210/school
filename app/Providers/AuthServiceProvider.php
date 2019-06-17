<?php

namespace App\Providers;

use App\User;
use App\Models\Alunos\Aluno;
use App\Policies\AlunoPolicy;
use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        \App\Models\Alunos\Aluno::class => \App\Policies\AlunoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate) {

        $this->registerPolicies($gate);

//        $gate->define('editar', function (User $user) {
//            if ($user->tipo == "admin" || $user->tipo == "secretaria" ) {
//                return $user;
//            
//            }
//        });

        $permissions = Permission::with('roles')->get();        
        foreach ($permissions as $permission) {

            $gate->define($permission->name, function (User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
        //Verifica se o usuario é Admin e não faz o loop como també dá controle total
        $gate->before(function (User $user){            
           if($user->hasAnyRoles('ADMIN'))
               return true;    
        });
    }

}
