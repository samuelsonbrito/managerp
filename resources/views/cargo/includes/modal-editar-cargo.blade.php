<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Alterar Dados do Cargo</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        rota-redirect="{{route('cargo.index')}}"
                        enc-type="multipart/form-data"
                        id-form="alterarCargo"
                        cor-botao="primary"
                        acao="{{route('cargo.update', ['id'])}}"
                        metodo="put"
                        nome-botao="Alterar"
                        icon-botao="fa fa-edit"
                        id-botao="btn-cargo-alterar"
                        nome-botao-desabilitado="Alterando...">
                    {{csrf_field()}}

                    <div class="row">
                        {!! Form::hidden('cargo_id', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'idEdit']) !!}

                        <div class="form-group col-md-12" id="validar-descricaoEdit">
                            {!! Form::label('descricaoEdit', 'Nome:') !!}
                            {!! Form::text('descricaoEdit', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'id' => 'descricaoEdit']) !!}
                            <span id="error-descricaoEdit"></span>
                        </div>

                    </div>

                </formulario>
                <div class="modal-footer">

                </div>


            </div>
        </div>

    </div>
</div>
