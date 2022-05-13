@extends('adminlte::page')
@section('css')
    <style>
        input{
            text-transform:uppercase;
        }
    </style>
@stop
@section('content_header')
    <h1>
        Gerenciamento Admissional
        <small>Gerencie os Colaboradores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('colaborador.index')}}"></a>Colaboradores</li>
        <li class="active">Anexos</li>
    </ol>
@stop

@section('content')
    <div id="app">

        @if (session('msg'))
            <confirm
                    title="{{ session('titulo') }}"
                    text="{{ session('msg') }}"
                    icon="{{ session('icon') }}"
            ></confirm>
        @endif

        <box boxtipo="box-success" boxtitulo="ANEXOS DO COLABORADOR E DE SEU(S) DEPENDENTE(S)">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-12">
                    <a href="" data-toggle="modal" data-target="#modal-cadastrar-anexo" class="btn btn-primary"><i
                                class="fa fa-plus"></i> Cadastrar Novo Anexo</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'tabela-anexos']) !!}
                    </div>
                </div>
            </div>
        </box>
        @include('colaborador.includes.modal-editar-anexo')
        @include('colaborador.includes.modal-cadastrar-anexo')
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('js/colaborador/anexo.js') }}"></script>


    {!! $dataTable->scripts() !!}

    <script>
        $('#dependentesSelect').select2({
            placeholder: "SELECIONE O DEPENDENTE OU COLABORADOR",
            width: '100%',
        });

            let rota = '{{route('colaborador.anexos', $id)}}';
            console.log(rota);


        function confirmacaoExcluir(id) {

            event.preventDefault();
            swal({
                title: "Excluir Anexo!",
                text: "Você tem certeza que deseja excluir este Anexo?",
                icon: "warning",
                buttons: ["Cancelar", "Excluir"],
                dangerMode: true,
            }).then((response) => {
                if (response) {
                    document.getElementById("form-" + id).submit();

                }
            });

        }
    </script>

@stop

