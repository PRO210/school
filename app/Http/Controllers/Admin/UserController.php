<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\User;


class UserController extends Controller {

    protected $repository;

    public function __construct(User $user) {

        $this->repository = $user;
//      $this->middleware(['can:users']);
    }

    public function index() {

        $users = $this->repository->latest()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    public function create() {
        return view('admin.pages.users.create');
    }

    public function store(StoreUpdateUser $request) {

        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']); // encrypt password

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    public function show($id) {
     
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back()->with('msg_3','Ops! Alogo deu errado ');
        }     

        return view('admin.pages.users.show', compact('user'));
    }

    public function edit($id) {
//        dd($user = $this->repository->tenantUser()->find($id));
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }

//
//    
    public function update(StoreUpdateUser $request, $id) {

        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $data = $request->only(['name', 'email']);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('message', 'Alterações Salvas com Sucesso');
    }


    public function destroy($id) {

        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('users.index');
    }
    //
    //
    public function search(Request $request) {

        $filters = $request->only('filter');

        $users = $this->repository
                ->where(function($query) use ($request) {
                    if ($request->filter) {
                        $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                        $query->orWhere('email', $request->filter);
                    }
                })
                ->latest()
                ->tenantUser()
                ->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }

}

