@extends('layout')
@section('content')
    <div class="col-md-offset-4 col-md-4">
        <div class="panel panel-primary" style="margin-top: 10%;">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Painel Administrativo</h4>
                </div>
            </div>
            <div class="panel-body">
                <form action="{{ route('user.login') }}" method="post" id="form-login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('alerts.request')
                    <div class="form-group">
                        <label for="usuario">Usuário</label>
                        <input type="text" placeholder="Usuário" value="{{ old('usuario') }}" id="usuario" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" placeholder="Senha" id="senha" name="senha" class="form-control">
                    </div>
                    <a href="{{ url('user/create') }}">Cadastrar-me</a>
                    <button class="btn btn-success pull-right" type="submit">Entrar</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script src="{{ asset('js/validate.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#form-login").validate({
                rules: {
                    usuario: true,
                    senha: true
                },
                messages: {
                    usuario: "Informe um Usuário válido.",
                    senha: "Informe uma Senha válida.",
                }
            });
        });
    </script>
@stop