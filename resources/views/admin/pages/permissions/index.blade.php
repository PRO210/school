<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@include('msg')

@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
     
<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="active"> <a href="{{ route('admin') }}" >Dashboard</a></li>
        <li class="active"><a href="{{ route('permissions.index') }}" >Permissões</a></li>
    </ol>
</div>
<h1>Permissões <a href="{{ route('permissions.create') }}" class="btn btn-success">ADD</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('permissions.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-success">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>
                                {{ $permission->name }}
                            </td>
                            <td style="width:10px;">
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning">VER</a>
                                <a href="{{ route('profiles.permissions', $permission->id) }}" class="btn btn-info"><i class="fa fa-address-book"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif
        </div>
    </div>
@stop
