<div class="modal fade" id="modal-cadastrar" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Perfil</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('admin.perfil')}}"
                        id-form="cadastrarUsuario"
                        cor-botao="primary"
                        acao="{{route('admin.perfil.salvar-perfil')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">

                        <div class="form-group col-md-12" id="validar-nome">
                            {!! Form::label('descricao', 'Nome do Perfil:') !!}
                            {!! Form::text('descricao', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'descricao', 'placeholder' => 'DIGITE O NOME DO PERFIL']) !!}
                            <span id="error-nome"></span>
                        </div>

                    </div>

                </formulario>
                <div class="modal-footer">

                </div>

            </div>
        </div>

    </div>
</div>

