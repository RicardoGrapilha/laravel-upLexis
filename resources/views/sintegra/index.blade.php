@extends('layout')
@section('content')
    <div class="col-md-offset-3 col-md-6">
        @if($json)
            <div class="panel panel-primary" style="margin-top: 5%;">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Consulta Pública ao Cadastro Estado do Espírito Santo</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-bordered">
                        <tr>
                            <td colspan="4">
                                <strong>IDENTIFICAÇÃO - PESSOA JURÍDICA</strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">&nbsp;CNPJ:</td>
                            <td width="30%">&nbsp;{{ $json['cnpj'] }}</td>
                            <td width="25%" align="center">Inscrição Estadual:</td>
                            <td>&nbsp;{{ $json['inscricao_estadual'] }}</td>
                        </tr>
                        <tr>
                            <td width="20%">Razão Social:</td>
                            <td colspan="3">&nbsp;{{ $json['razao_social'] }}</td>
                        </tr>
                    </table>

                    <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-bordered">
                        <tr>
                            <td colspan="4">
                                <strong>ENDEREÇO</strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">&nbsp;Logradouro:</td>
                            <td colspan="3">&nbsp;{{ $json['logradouro'] }}</td>
                        </tr>
                        <tr>
                            <td width="20%">&nbsp;Número:</td>
                            <td width="15%">&nbsp;{{ $json['numero'] }}</td>
                            <td width="20%">&nbsp;Complemento:</td>
                            <td>&nbsp;{{ $json['complemento'] }}</td>
                        </tr>
                        <tr>
                            <td width="20%">&nbsp;Bairro:</td>
                            <td colspan="3">&nbsp;{{ $json['bairro'] }}</td>
                        </tr>
                        <tr>
                            <td width="20%">&nbsp;Município:</td>
                            <td width="15%">&nbsp;{{ $json['municipio'] }}</td>
                            <td>&nbsp;UF:</td>
                            <td>&nbsp;{{ $json['uf'] }}</td>
                        </tr>
                        <tr>
                            <td width="20%">&nbsp;CEP:</td>
                            <td width="30%">&nbsp;{{ $json['cep'] }}</td>
                            <td width="20%">&nbsp;Telefone:</td>
                            <td width="30%">&nbsp;{{ $json['telefone'] }}</td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-bordered">
                        <tr>
                            <td colspan="2"><strong>INFORMAÇÕES COMPLEMENTARES</strong></td>
                        </tr>
                        <tr>
                            <td width="40%" align="right">Atividade Econômica:&nbsp;</td>
                            <td width="60%">{{ $json['atividade_economica'] }}</td>
                        </tr>
                        <tr>
                            <td width="40%" align="right">Data de Inicio de Atividade:&nbsp;</td>
                            <td>{{ $json['data_de_inicio_de_atividade'] }}</td>
                        </tr>
                        <tr>
                            <td width="40%" align="right">Situação Cadastral Vigente:&nbsp;</td>
                            <td>{{ $json['situacao_cadastral_vigente'] }}</td>
                        </tr>
                        <tr>
                            <td width="40%" align="right">Data desta Situação Cadastral:&nbsp;</td>
                            <td>{{ $json['data_desta_situacao_cadastral'] }}</td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered">
                        <tr>
                            <td width="40%" align="right">Regime de
                                Apura&ccedil;&atilde;o:&nbsp;</td>
                            <td>{{ $json['regime_de_apuracao'] }}</td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered">
                        <tr>
                            <td width="40%" align="right">Emitente de NFe desde:&nbsp;</td>
                            <td>{{ $json['emitente_de_nfe_desde'] }}</td>
                        </tr>
                    </table>
                    <button class="btn btn-primary pull-right" type="button" onclick="window.location='{{ url('sintegra') }}'">Nova Consulta</button>
                    <br><br>
                </div>
                <div class="clearfix"></div>
            </div>
        @else
            <div class="panel panel-primary" style="margin-top: 10%;">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Consulta Pública ao Cadastro Estado do Espírito Santo</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('sintegra') }}" method="post" id="form-login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('alerts.request')
                        <div class="form-group">
                            <label for="usuario">CNPJ</label>
                            <input type="text" placeholder="99.999.999/9999-99" value="{{ old('cnpj') }}" id="cnpj" name="cnpj"
                                   class="form-control" data-inputmask="'mask':'99.999.999/9999-99'">
                        </div>
                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Consultar</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@stop
@section('javascript')
<script src="{{ asset('js/jquery.maskedinput-1.3.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $(":input").inputmask();
    });
</script>
@stop