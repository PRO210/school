<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top" style=" padding-bootom:36px;  ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/home') }}">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">              
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Alunos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route ('alunos.index')}}">Listar Todos os Alunos</a></li>           
                        <li><a href="{{route ('alunos.create')}}">Cadastrar Novato</a></li>           
                        <li><a href="{{url ('alunos/solicitações/transferência')}}">Transferências Solicitadas</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Disciplinas<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route ('disciplinas.index')}}">Listar Disciplinas</a></li>  
                        <li><a href="{{route ('disciplinas.create')}}">Cadastrar Disciplina</a></li> 

                    </ul>
                </li>
            </ul>


            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <!--                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>-->
                <!--                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>-->
                @else
                <li class="dropdown">                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}&nbsp;<span class="caret"></span></a>
                    <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
                    <ul class="dropdown-menu">
                        <li><a class="" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <li><a href="{{route ('logs.index')}}">Ações Passadas</a></li>  

                    </ul>
                </li>
                @endguest
                


            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div style="height:24px"></div>

