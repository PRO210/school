@extends('adminlte::page')

@section('title', "Editar o detalhe do plano {$detail->name}")

@section('content_header')
<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url) }}" class="active">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [ $plan->url, $detail->id ]) }}" class="active">Editar</a></li>
    </ol>
</div>

    <h1>Editar detalhe do plano {{ $detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->url, $detail->id ]) }}" method="post">
                @method('PUT')
                @csrf
                @include('admin.pages.plans.details.form')
            </form>
        </div>
    </div>
@endsection