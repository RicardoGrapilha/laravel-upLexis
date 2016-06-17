<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="João Ricardo Grapilha Lopes">
    <meta name="funcao" content="Desenvolvedor de Sistemas">

    <title>{{ config('appdata.SYSTEM_NAME') }}</title>
    <link rel="icon" href="{{ asset('laravel.ico') }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!--font-awesome-->
    <link rel="stylesheet" href="{{ asset('font-awesome-4.6.3/css/font-awesome.min.css') }}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            @if(isset(auth()->user()->id)) 
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @endif
            <a style="color:#0187ca" class="navbar-brand" href="{{ url() }}">{{ config('appdata.SYSTEM_NAME') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                    @if(isset(auth()->user()->id)) 
                        <li id="consulta">
                            <a href="{{ route('sintegra') }}">Consulta Cadastro</a>
                        </li>
                        <li id="listar">
                            <a href="{{ route('sintegra.list') }}">Histórico de Consultas</a>
                        </li>
                        <li>
                            <a href="{{ route('user.logout') }}"><i class="glyphicon glyphicon-off"></i> Sair</a>
                        </li>
                    @endif
                </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="container" style="padding-top: 70px;">
        @yield('content')
    </div>

    <hr>
    <footer>
        <center>&copy; 2016 {{ config('appdata.SYSTEM_NAME') }}.</center>
    </footer>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>
<script type="text/javascript">
    $(function(){
        @if(isset($menu_active))
            $('#{!! $menu_active !!}').addClass('active');
        @endif
    });
</script>
@yield('javascript')
</body>
</html>
