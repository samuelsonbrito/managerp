@extends('adminlte::page')
@section('css')
    <style>
        input{
            text-transform:uppercase;
        }

        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{url('assets/img/loading2.gif')}}") 50% 50% no-repeat white;
        }
    </style>
@stop
@section('content_header')
    <h1>
        Dashboard
        <small>SEGEAM - SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop
@section('content')
@inject('dashboard','App\Services\DashboardService')


<div id="loader" class="loader">
</div>
<div style="display:none" id="tudo_page">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Colaboradores</span>
                    <span class="info-box-number">{{\App\Models\Colaborador::all()->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-folder-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Contratos</span>
                    <span class="info-box-number">{{\App\Models\Contrato::where('status', 'ATIVO')->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-suitcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number">{{\App\Models\Cliente::where('papel', 'CLIENTE')->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion ion-person-add"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Usuários Cadastrados</span>
                    <span class="info-box-number">{{\App\User::all()->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-file-text"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Contratos Ativos</span>
                    <span class="info-box-number">{{\App\Models\Contrato::all()->where('status', 'ATIVO')->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-file-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Contratos Vencidos</span>
                    <span class="info-box-number">{{\App\Models\Contrato::all()->where('status', 'VENCIDO')->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-7">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Frequência Geral de {{$dashboard->frequenciaDiaAnterior()['data']}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChart" height="210"></canvas>
                            </div>
                            <!-- ./chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="fa fa-circle-o text-green"></i> Presentes</li>
                                <li><i class="fa fa-circle-o text-red"></i> Faltas</li>
                                {{--<li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>--}}
                                {{--<li><i class="fa fa-circle-o text-aqua"></i> Safari</li>--}}
                                {{--<li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>--}}
                                {{--<li><i class="fa fa-circle-o text-gray"></i> Navigator</li>--}}
                            </ul>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#">Unidade Com Mais Presentes - <b> {{$dashboard->frequenciaDiaAnterior()['unidade_mais_presentes'] ?? 'Nenhum Registro'}}</b>
                                <span class="pull-right text-green"><i class="fa fa-angle-down"></i> {{$dashboard->frequenciaDiaAnterior()['percentual_presenca']}}%</span></a></li>
                        <li><a href="#">Unidade Com Mais Faltas - <b> {{$dashboard->frequenciaDiaAnterior()['unidade_mais_faltantes'] ?? 'Nenhum Registro'}} <span class="pull-right text-red "><i
                                            class="fa fa-angle-up"></i> {{$dashboard->frequenciaDiaAnterior()['percentual_falta']}}%</span></a>
                        </li>
                    </ul>
                </div>
                <!-- /.footer -->
            </div>

        </div>
        <div class="col-md-5">
        <!-- Info Boxes Style 2 -->
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-calendar-minus-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Conselhos Profissionais Prestes a Vencer</span>
                    <span class="info-box-number">{{ $dashboard->conselhosAVencer() }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">
                        <a href="{{ route('conselhos.prestes.vencer') }}" class="small-box-footer" style="color:white">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
                  </span>
                </div>


            <!-- /.info-box-content -->
            </div>

            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-calendar-times-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Conselhos Profissionais Vencidos</span>
                    <span class="info-box-number">{{ $dashboard->conselhosVencidos() }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 40%"></div>
                    </div>
                    <span class="progress-description">
                        <a href="{{ route('conselhos.vencidos') }}" class="small-box-footer" style="color:white">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
                  </span>
                </div>
            <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Alerta de Férias a Partir de 18 meses da Admissão</span>
                    <span class="info-box-number">{{ $dashboard->alertaFerias() }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 20%"></div>
                    </div>
                    <span class="progress-description">
                        <a href="{{ route('alerta.ferias.colaboradores') }}" class="small-box-footer" style="color:white">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
                  </span>
                </div>
            <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->

        <!-- /.info-box -->
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-heart-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Alerta de exame periódico a cada 12 meses</span>
                    <span class="info-box-number">0</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 40%"></div>
                    </div>
                    <span class="progress-description">
                        <a href="#" class="small-box-footer" style="color:white">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Totais de Custos e Receitas</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        {{--<div class="btn-group">--}}
                            {{--<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">--}}
                                {{--<i class="fa fa-wrench"></i></button>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li><a href="#">Action</a></li>--}}
                                {{--<li><a href="#">Another action</a></li>--}}
                                {{--<li><a href="#">Something else here</a></li>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<li><a href="#">Separated link</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{--<p class="text-center">--}}
                                {{--<strong>Vendas: 1 de janeiro de 2014 a 30 de julho de 2018</strong>--}}
                            {{--</p>--}}

                            {{--<div class="chart">--}}
                                {{--<!-- Sales Chart Canvas -->--}}
                                {{--<canvas id="salesChart" style="height: 180px;"></canvas>--}}
                            {{--</div>--}}
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header" id="currency">{{
                                  'R$ '.number_format($dashboard->getTotalReceitas(), 2, ',', '.')
                                  }}</h5>
                                <span class="description-text">TOTAL RECEITA</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-6">
                            <div class="description-block border-right">
                                {{--<span class="description-percentage text-yellow"><i--}}
                                            {{--class="fa fa-caret-left"></i> 0%</span>--}}
                                <h5 class="description-header currency">{{
                                  'R$ '.number_format($dashboard->getTotalCustos(), 2, ',', '.')
                                }}</h5>
                                <span class="description-text">CUSTO TOTAL</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-6">
                            <div class="description-block border-right">
                                {{--<span class="description-percentage text-green"><i--}}
                                            {{--class="fa fa-caret-up"></i> 20%</span>--}}
                                <h5 class="description-header currency">{{
                                 'R$ '.number_format($dashboard->getLucroTotal(), 2, ',', '.')
                                }}</h5>
                                <span class="description-text">LUCRO TOTAL</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>


</div>

@stop

 @section('js')
     <script>
         var PieData        = [
             {
                 value    : '{{$dashboard->frequenciaDiaAnterior()['faltas']}}',
                 color    : '#f56954',
                 highlight: '#f56954',
                 label    : 'Faltas'
             },
             {
                 value    : '{{$dashboard->frequenciaDiaAnterior()['presentes']}}',
                 color    : '#00a65a',
                 highlight: '#00a65a',
                 label    : 'Presentes'
             },

         ];
     </script>
     <script src="{{ asset('plugins/chart.js/Chart.js') }}"></script>
     <script src="{{ asset('js/dashboard/graficos.js') }}"></script>

     <script>
        let valor = document.getElementById('currency').innerText;
        console.log(valor.toLocaleString('pt-BR',{style:'decimal',currency:'BRL'}));
     </script>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js" integrity="sha256-ivk71nXhz9nsyFDoYoGf2sbjrR9ddh+XDkCcfZxjvcM=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        
        jQuery(window).load(function () {
            $(".loader").fadeOut("slow"); //retire o delay quando for copiar!
            $("#tudo_page").toggle("fast");
        });
    </script>
 @stop