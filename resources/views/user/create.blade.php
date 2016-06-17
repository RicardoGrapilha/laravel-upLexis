@extends('layout')
@section('content')
    <div class="col-md-offset-4 col-md-4">
        <div class="panel panel-primary" style="margin-top: 10%;">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Registrar Usuário</h4>
                </div>
            </div>
            <div class="panel-body">
                <form action="{{ route('user.create') }}" method="post" id="form-login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('alerts.request')
                    @include('alerts.success')
                    <div class="form-group">
                        <label for="usuario">Usuário</label>
                        <input type="text" placeholder="Usuário" value="{{ old('usuario') }}" id="usuario" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" placeholder="Senha" id="senha" name="senha" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="senha">Confirmar Senha</label>
                        <input type="password" placeholder="Confirmar Senha" id="confirma_senha" name="confirma_senha" class="form-control">
                    </div>
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
                    usuario: {
                        required: true,
                        rangelength: [5, 15]
                    },
                    senha: {
                        required: true,
                        minlength: 6
                    },
                    confirma_senha: {
                        required: true,
                        equalTo: "#senha",
                    },
                },
                messages: {
                    usuario: {
                        required : "Informe um Usuário válido.",
                        rangelength: "Informe um valor entre {0} e {1} caracteres."
                    },
                    senha: {
                        required: "Informe uma Senha válida.",
                        minlength: "A senha deve conter no minimo 6 caracteres"
                    },
                    confirma_senha: {
                        required: "Confirme a Senha",
                        equalTo: "Confirmação inválida",
                    }
                }
            });
        });
    </script>
@stop