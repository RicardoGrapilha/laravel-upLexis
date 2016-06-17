@extends('layout')
@section('content')
    <div class="panel panel-primary" style="margin-top: 2%;">
        <div class="panel-heading">
            <div class="panel-title">
                <h4>Histórico de Consultas</h4>
            </div>
        </div>
        <div class="panel-body">
            <div class="content">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>CNPJ</th>
                        <th>Json</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$lista->count())
                        <tr>
                            <td colspan="5" style="padding: 20px;" class="text-danger text-center"><h4>Nenhum registro encontrado</h4></td>
                        </tr>
                    @else
                        @foreach($lista as $row)
                            <tr id="row_{{ $row->id }}">
                                <th>{{ $row->id }}</th>
                                <td>{{ $row->cnpj }}</td>
                                <td>{!! print_r(json_decode($row->resultado_json, true), true) !!}</td>
                                <td>
                                    <button class="btn btn-danger" onclick="deletarRegistro('{{ $row->id }}')"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        function deletarRegistro(id){
            if(confirm('Deseja realmente excluir este registro?')){
                $.post(
                    '{{ route('sintegra.delete') }}',
                    {id:id},
                    function(res){
                        console.log(res.response);
                        if(res.response){
                            $('#row_' + id).remove();
                        }
                    }
                );
            }
        }
    </script>
@stop