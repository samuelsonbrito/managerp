<div class="modal fade" id="modal-cadastrar-anexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Novo Anexo</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('contrato.anexos', $numero_contrato ?? '')}}"
                        id-form="cadastrarAnexo"
                        cor-botao="primary"
                        acao="{{route('contrato.cadastrar.anexo')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('contrato_id', $id ?? '', ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'idColaborador']) !!}
                        <div class="form-group col-md-12" id="validar-nome">
                            {!! Form::label('nome', 'Nome do Anexo:') !!}
                            {!! Form::text('nome', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'nome', 'placeholder' => 'INFORME O NOME DO ANEXO']) !!}
                            <div id="error-nome"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12" data-js="anexo" id="validar-anexo">
                            <label class="">Anexar Documento:</label>
                            <input type="file" class="form-control" name="anexo">
                            <div id="error-anexo"></div>
                        </div>
                    </div>
                </formulario>
                <div class="modal-footer">
                </div>
            </div>
        </div>

    </div>
</div>
