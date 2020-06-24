<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class PlanController extends Controller 
{
    private $repository;

    public function __construct(Plan $plan) 
    {
        $this->repository = $plan;

     //   $this->middleware(['can:plans']);
    }

    public function index()
    {
        // Gate::allows('plans');
        // $this->authorize('plans');
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', ['plans' => $plans]);
    }
    //
    public function create()
    {
        return view('admin.pages.plans.create');
    }
    //
    //
    public function store(StoreUpdatePlan $request)
    {       
        $plan = $this->repository->create($request->all());

        return redirect()->route('plans.index')->with('msg','Operações Realizadas com Sucesso!');
    }
    //
    public function show($url)
    {       
        $plan = $this->repository->where('url', $url)->first();
       
        if (!$plan) {
            return redirect()->back()->withInput();
        } else {
            return view('admin.pages.plans.show',[
                 'plan' => $plan 
            ]);
        }        

    }
    //
    public function delete($url)
    {      
        $plan = $this->repository->with('details')->where('url', $url)->first();
        //
        if (!$plan) {
            return redirect()->back()->with('','');
        }        
        //
        if ($plan->details->count() > 0) {
            return redirect()->back()->with('error', 'Existem Detalhes vinculados a esse Plano, portanto não pode Deletar');
        } 
       
            $plan->delete();
            return redirect()->route('plans.index')->with('message','Plano deletado com Sucesso!');
    }
    //
    //
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);
    }
    //
    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();
       
        if (!$plan) {
            return redirect()->back()->withErrors('')->withInput();
        } else {
            return view('admin.pages.plans.edit',[
                 'plan' => $plan 
            ]);
        }   
    }
    //
    public function update(StoreUpdatePlan $request, $url)
    {
       
        $plan = $this->repository->where('url', $url)->first();
       
        if (!$plan) {
            return redirect()->back()->withErrors('')->withInput();
        } else {

            $plan->update($request->except('_token', '_method'));  
            return redirect()->route('plans.index')->with('msg','Operações Realizadas com Sucesso!');;
        }   
    }
//
}
