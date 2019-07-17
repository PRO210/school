<html lang="pt-br">
    <head>
        <meta charset="UTF-8">      
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or 'Scholl 2019'}}</title> 
        <style>
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
            .glyphicon-print{font-size: 16px !important;}
            .dropdown-menu > li > a {padding-bottom: 4px;}
            .checkbox{display: inline-block !important;} 
            @media (max-width: 720px) {#nome{white-space: normal};
            </style>   
    </head>
    <body>
        @include('bootstrap4')
        @include('Menu.menu')
        <script>
            $(document).ready(function () {
                $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
            });
        </script>           
        @include('msg')
        <div class="container"> 
            <h3 style="text-align:center; margin-top: 36px ">Todos os Cursos </h3>
            {!!Form::open(['url' => '','name' => 'form1'])!!}                       
            <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                <thead>
                    <tr>  
                        <th> 
                            <div class='dropdown'>
                                <span><input type='checkbox'  class = 'selecionar'/></span>
                                &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                    <li><a><button type='submit' value='basica' name = 'botao' class='btn btn-link' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Básica</a></li>
                                    <li><a><button type='submit' value='geral' name = 'botao' class='btn btn-link '  onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Geral</a></li>
                                </ul>
                            </div>
                        </th>                     
                        <th>NOME</th>                        
                    </tr>
                </thead>
                <tbody>                                   
                    @foreach($cursos as $curso)                    
                    <tr>     
                        <td></td>       
                        <td>
                            <div class="dropdown">
                                &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'  ></span>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                    @can('EDITAR_ALUNOS')
                                    <li><a href="{{route('cursos/editar',['id' => Crypt::encrypt($curso->id)])}}" target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Adicionar ou Remover Disciplinas</a></li>
                                    <li><a href="{{route('cursos/deletar',['id' => Crypt::encrypt($curso->id)])}}" target='_self' title='Deletar'><span class='glyphicon glyphicon-remove text-danger' aria-hidden='true' onclick="return deletar()">&nbsp;Deletar Curso</span></a></li>

                                    @endcan
                                </ul>                              
                                &nbsp;&nbsp;
                                <span><input type='checkbox' name='curso_selecionado[]' class = 'checkbox' id="{{$curso->id}}" value='{{$curso->id}}'>
                                    <label class="form-check-label" style="margin-bottom: 0px !important;" for="{{$curso->id}}">{{$curso->NOME}}</label>
                                </span>
                            </div>                           
                        </td>   
                    </tr>
                    @endforeach                     
                </tbody>
                <tfoot>
                    <tr>      
                        <th></th>                
                        <th>NOME</th>                        
                    </tr>
                </tfoot>        
            </table> 
            {!! Form:: close()!!}
        </div>
        @include('Cursos.tabela_cursos')
    </body>
</html>
