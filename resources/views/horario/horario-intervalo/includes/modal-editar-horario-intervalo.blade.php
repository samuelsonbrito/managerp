<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Alterar Dados do Horário de Intervalo</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        rota-redirect="{{route('horario-intervalo.index')}}"
                        enc-type="multipart/form-data"
                        id-form="alterarHorarioIntervalo"
                        cor-botao="primary"
                        acao="{{route('horario-intervalo.update', ['id'])}}"
                        metodo="put"
                        nome-botao="Alterar"
                        icon-botao="fa fa-edit"
                        id-botao="btn-cargo-alterar"
                        nome-botao-desabilitado="Alterando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('horario_intervalo_id', null, ['class' => 'form-control', 'id' => 'idEdit']) !!}

                        <div class="form-group col-md-6" id="validar-hora_inicialEdit">
                            {!! Form::label('hora_inicialEdit', 'Hora Inicial:') !!}
                            {!! Form::time('hora_inicialEdit', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'hora_inicialEdit', 'placeholder' => 'INFOME O INÍCIO DO INTERVALO', 'v-mask' => '["##:##"]']) !!}
                            <span id="error-hora_inicialEdit"></span>
                        </div>

                        <div class="form-group col-md-6" id="validar-hora_finalEdit">
                            {!! Form::label('hora_finalEdit', 'Hora Final:') !!}
                            {!! Form::time('hora_finalEdit', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'hora_finalEdit', 'placeholder' => 'INFOME O FIM DO INTERVALO', 'v-mask' => '["##:##"]']) !!}
                            <span id="error-hora_finalEdit"></span>
                        </div>

                    </div>


                </formulario>
                <div class="modal-footer">

                </div>


            </div>
        </div>

    </div>
</div>
