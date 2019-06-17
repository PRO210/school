@extends('layouts.app')

@section('content')
@include('Alunos.alunos_css');

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                  
                    You are {{$usuario}} logged in!
                  
                                      
                    <br>
                    <a href="{{route ('alunos.index')}}">Listar os Alunos</a><br>
                    <a href="{{route ('alunos.create')}}">Cadastrar Aluno</a>
                    {{$usuario}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
