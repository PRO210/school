<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;


class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;

        // $this->middleware(['can:profiles']);
    }

    public function permissions(Request $request, $idProfile)
    {       
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }        
       
        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.profiles', compact('profile', 'permissions'));
    }
    //
    //   
    public function profilePermissionsAvailable(Request $request, $idProfile)
    {        
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

         $filters = $request->except('_token');

         $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }
    //
    //
    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back()->with('error','Falha na Consulta dos Dados');
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id)->with('message','Operações Relizadas com Sucesso!');
    }
    //
    //
    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);      

        if (!$profile) {
            return redirect()->back()->with('error','Falha na Consulta dos Dados');
        }
        if(!$request->permissions || count($request->permissions) == 0 ){
            return redirect()->back()->with('info','Escolha pelo menos uma permissão para o seu perfil');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id)->with('message','Operações Relizadas com Sucesso!');
    }








}
