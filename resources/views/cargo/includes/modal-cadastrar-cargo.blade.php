<div class="modal fade" id="modal-cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Cargo</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('cargo.index')}}"
                        id-form="cadastrarCargo"
                        cor-botao="primary"
                        acao="{{route('cargo.store')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                        <div class="row">
                            <div class="form-group col-md-12" id="validar-descricao">
                                {!! Form::label('descricao', 'Nome:') !!}
                                {!! Form::text('descricao', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'descricao', 'placeholder' => 'DIGITE O NOME DO CARGO']) !!}
                                <span id="error-descricao"></span>
                            </div>

                        </div>

                </formulario>
                <div class="modal-footer">

                </div>

            </div>
        </div>

    </div>
</div>
