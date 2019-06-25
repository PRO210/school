<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head lang="pr-br">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('Alunos.alunos_css');

    </head>
    <body>
        @include('Menu.menu');

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
    </body>
</html>