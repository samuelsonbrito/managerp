@extends('adminlte::page')
@section('css')
    <style>
        a{
            color: #1a1a1a;
        }

        a:hover {
            color: #555555;
        }
        input {
            text-transform: uppercase;
        }
    </style>
@stop
@section('content_header')
    <h1>
        Administração Sistema
        <small>Gerencie os usuários e permissões do sistema</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Admin</li>
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



        <div class="row">

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="{{route('admin.usuario')}}">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Usuários</span>
                            <small class="info-box-more">Gerencie os Usuários do Sistema</small>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="{{route('admin.perfil')}}">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-tasks"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Perfís</span>
                            <small class="info-box-more">Controle de Perfís do Sistema</small>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="{{route('admin.permissao-acesso')}}">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-cubes"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Controle de Acesso</span>
                            <small class="info-box-more">Permissão de Acesso aos Módulos do Sistema</small>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                </div>

        </div>
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-square"></i> USUÁRIOS ATIVOS NO SISTEMA</h3>

            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                    <tr>

                        <th>USUÁRIO</th>
                        <th>EMAIL</th>
                        <th>DATA</th>
                        <th>STATUS</th>

                    </tr>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{createdbdToBr($usuario->created_at)}}</td>
                        @if($usuario->status == 'ativo')
                            <td><span class="label label-success">Ativo</span></td>
                        @endif


                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>

            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tasks"></i> PERFÍS</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>PERFIL</th>
                            <th>MÓDULOS</th>
                            <th>PERMISSOES</th>
                        </tr>
                        @foreach($perfis as $perfil)
                            <tr>
                                <td>{{$perfil['descricao']}}</td>
                                <td>
                                    @if($perfil['descricao'] == 'admin')
                                        <span class="label label-success"> Todos</span>
                                    @else
                                        @foreach($perfil->modulos as $modulo)
                                            <span class="label label-info"> {{$modulo->modulo}}</span>
                                        @endforeach
                                </td>
                                @endif
                                <td>
                                    @if($perfil['descricao'] == 'admin')
                                        <span class="label label-success"> Todas</span>
                                    @else


                                        <span class="label label-primary"> {{isset($perfil->modulos[0]->pivot->cadastrar) ? "Cadastrar" : null}}</span>
                                        <span class="label label-info"> {{isset($perfil->modulos[0]->pivot->editar) ? "Editar" : null}}</span>
                                        <span class="label label-warning"> {{isset($perfil->modulos[0]->pivot->visualizar) ? "Visualizar" : null}}</span>
                                        <span class="label label-danger"> {{isset($perfil->modulos[0]->pivot->excluir) ? "excluir" : null}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>




    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-cubes"></i> MÓDULOS DO SISTEMA</h3>

        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>MÓDULO</th>
                    <th>CHAVE</th>
                    <th>DESCRICAO</th>
                </tr>
                @foreach($modulos as $modulo)
            <tr>
                <td>{{$modulo->modulo}}</td>
                        <td>{{$modulo->chave}}</td>
                        <td>{{$modulo->descricao}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box-header -->

    <!-- /.box-body -->



    <!-- /.box-header -->

    <!-- /.box-body -->



    </div>


@stop



