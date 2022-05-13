<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Alterar Dados do Horário de Trabalho</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        rota-redirect="{{route('horario-trabalho.index')}}"
                        enc-type="multipart/form-data"
                        id-form="alterarHorarioTrabalho"
                        cor-botao="primary"
                        acao="{{route('horario-trabalho.update', ['id'])}}"
                        metodo="put"
                        nome-botao="Alterar"
                        icon-botao="fa fa-edit"
                        id-botao="btn-cargo-alterar"
                        nome-botao-desabilitado="Alterando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('horario_trabalho_id', null, ['class' => 'form-control', 'id' => 'idEdit']) !!}

                        <div class="form-group col-md-12" id="validar-descricao_periodoEdit">
                            {!! Form::label('descricao_periodoEdit', 'Descricao:') !!}
                            {!! Form::text('descricao_periodoEdit', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'descricao_periodoEdit', 'placeholder' => 'INFOME A DESCRIÇÃO']) !!}
                            <span id="error-descricao_periodoEdit"></span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" id="validar-inicio_expedienteEdit">
                            {!! Form::label('inicio_expedienteEdit', 'Início do Expediente:') !!}
                            {!! Form::time('inicio_expedienteEdit', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'inicio_expedienteEdit', 'placeholder' => 'INFOME O INÍCIO DO EXPEDIENTE', 'v-mask' => '["##:##"]']) !!}
                            <span id="error-inicio_expedienteEdit"></span>
                        </div>

                        <div class="form-group col-md-6" id="validar-fim_expedienteEdit">
                            {!! Form::label('fim_expedienteEdit', 'Fim do Expediente:') !!}
                            {!! Form::time('fim_expedienteEdit', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'fim_expedienteEdit', 'placeholder' => 'INFOME O FIM DO EXPEDIENTE', 'v-mask' => '["##:##"]']) !!}
                            <span id="error-fim_expedienteEdit"></span>
                        </div>

                    </div>


                </formulario>
                <div class="modal-footer">

                </div>


            </div>
        </div>

    </div>
</div>
