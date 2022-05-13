<div class="modal fade" id="modal-edit" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Alterar Frequência</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        rota-redirect="{{route('frequencia.gerenciar-frequencias', [
                                                                                        'periodo' => $periodo,
                                                                                        'dia' => $dia,
                                                                                        'unidade' => $unidade,
                                                                                        'turno' => $turno,
                                                                                    ])}}"
                        enc-type="multipart/form-data"
                        id-form="alterarFrequencia"
                        cor-botao="primary"
                        acao="{{route('frequencia.update', ['id'])}}"
                        metodo="put"
                        nome-botao="Alterar"
                        icon-botao="fa fa-edit"
                        id-botao="btn-frequencia-alterar"
                        nome-botao-desabilitado="Alterando...">
                    {{csrf_field()}}

                    <div class="row">
                        <input type="hidden" name="frequencia_id" id="frequencia_id">
                        <div class="form-group col-md-12" id="validar-motivoEdit">
                            {!! Form::label('motivoEdit', 'Motivo da Ausência:') !!}
                            {!! Form::textarea('motivoEdit', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'motivoEdit', 'placeholder' => 'DIGITE O NOME DA UNIDADE']) !!}
                            <span id="error-nomeEdit"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <div class="form-check-inline">
                                <label class="radio-inline">
                                    <input type="radio" name="tipo_substituto" id="c1" value="NENHUM">NENHUM
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="tipo_substituto" id="c2" value="AVULSO">AVULSO
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="tipo_substituto" id="c3" value="PAGANDO FALTA">PAGANDO
                                    FALTA
                                </label>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12" id="validar-substitutoAvulsoEdit">
                            {!! Form::label('substitutoAvulsoEdit', 'Substituto(Avulso):') !!}
                            {!! Form::text('substitutoAvulsoEdit', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'substitutoAvulsoEdit', 'placeholder' => 'INFORME O NOME']) !!}
                            <span id="error-motivoEdit"></span>
                        </div>

                        <div class="form-group col-md-12" id="validar-colaboradores">
                            {!! Form::label('colaboradores', 'Substituto(Extra):', ['class' => 'm-b-1']) !!}
                            {!!
                                Form::select('colaborador', [], [], [
                                    'id' => 'colaboradores',
                                    'class' => 'form-control trigger select2',
                                    'data-parsley-required' => 'true'
                                ])
                            !!}
                            <div id="error-colaboradores"></div>
                        </div>
                    </div>

                </formulario>
                <div class="modal-footer">
                </div>


            </div>
        </div>

    </div>
</div>
