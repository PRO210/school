<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\StoreUpdateDetailPlan;
use App\Http\Controllers\Controller;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;



class DetailPlanController extends Controller
{
    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;

       // $this->middleware(['can:plans']);
    }

    public function index($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }
        // $details = $plan->details();
        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details,
        ]);
    }
    //
    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', [
            'plan' => $plan,
        ]);
    }
    //    
    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index',$plan->url)->with('msg','Operações Realizadas com Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        // dd($idDetail);
        if (!($plan || $detail)) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', [
            'plan'   => $plan,
            'detail' => $detail
        ]);
    }
    //
    //
    public function edit($urlPlan,$idDetail)
    {        
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        // dd($idDetail);
        if (!($plan || $detail)) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', [
            'plan'   => $plan,
            'detail' => $detail
        ]);
    }
    //
    //    
    public function update(StoreUpdateDetailPlan $request, $url, $idDetail)
    {     
       
        $plan = $this->plan->where('url', $url)->first();
        $detail = $this->repository->find($idDetail);

        if (!($plan || $detail)) {
            return redirect()->back();
        } 

        $detail->update($request->all());
        
        return redirect()->route('details.plan.index',$plan->url)->with('msg','Operações Realizadas com Sucesso');;

    }
    //
    //
    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!($plan || $detail)) {
            return redirect()->back();
        } 

        $detail->delete();
        
        return redirect()->route('details.plan.index',$plan->url)->with('msg','Registro deletado com Sucesso!');
    }
}
