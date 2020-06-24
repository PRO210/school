@extends('adminlte::page')

@section('title', "Editar o plano {$plan->name}")

@section('content_header')
    <h1>Editar o plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('plans.update',$plan->url)}}" method="post" class="form" >
                @csrf
                @method('PUT')
                
                @include('admin.pages.plans.form')                

            </form>
        </div>
    </div>
@endsection