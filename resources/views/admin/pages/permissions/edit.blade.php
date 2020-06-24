@extends('adminlte::page')

@section('title', "Editar a Permissão {$permission->name}")

@section('content_header')
<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="active"> <a href="{{ route('admin') }}" >Dashboard</a></li>
        <li class="active"><a href="{{ route('permissions.index') }}" >Permissões</a></li>
    </ol>
</div>
    <h1>Editar a Permissão {{ $permission->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                
                @method('PUT')

                @include('admin.pages.permissions.form')

            </form>
        </div>
    </div>
@endsection
