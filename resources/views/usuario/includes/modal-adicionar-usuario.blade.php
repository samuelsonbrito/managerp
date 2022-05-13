<div class="modal fade" id="modal-cadastrar" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Usuário</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('admin.usuario')}}"
                        id-form="cadastrarUsuario"
                        cor-botao="primary"
                        acao="{{route('admin.usuario.salvar-usuario')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">

                        <div class="form-group col-md-12" id="validar-nome">
                            {!! Form::label('nome', 'Nome:') !!}
                            {!! Form::text('nome', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'nome', 'placeholder' => 'DIGITE O NOME COMPLETO']) !!}
                            <span id="error-nome"></span>
                        </div>

                        <div class="form-group col-md-6" id="validar-nome">
                            {!! Form::label('nome_usuario', 'Nome de Usuário:') !!}
                            {!! Form::text('nome_usuario', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'nome', 'placeholder' => 'DIGITE O NOME DE USUÁRIO']) !!}
                            <span id="error-nome"></span>
                        </div>

                        <div class="form-group col-md-6" id="validar-email">
                            {!! Form::label('email', 'E-mail:') !!}
                            {!! Form::text('email', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'nome', 'placeholder' => 'DIGITE O EMAIL']) !!}
                            <span id="error-nome"></span>
                        </div>

                        <div class="form-group col-md-4" id="validar-password">
                            {!! Form::label('senha', 'Senha:') !!}
                            {!! Form::password('senha', ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'nome', 'placeholder' => 'INFORME A SENHA (NO MÍNIMO 6 CARACTERES)']) !!}
                            <span id="error-nome"></span>
                        </div>

                        <div class="form-group col-md-4" id="validar-perfil">
                            {!! Form::label('perfil', 'Perfil:') !!}
                            {!! Form::select('perfil', $perfis, null , ['class' => 'form-control trigger select2', 'data-parsley-required' => 'true', 'id' => 'perfil', 'placeholder' => 'SELECIONE UM PERFIL']) !!}
                            <span id="error-nome"></span>
                        </div>

                        <div class="form-group col-md-4" id="validar-perfil">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::select('status', ['ativo' => 'ATIVO', 'inativo' => 'INATIVO'], null , ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'status', 'placeholder' => 'SELECIONE O STATUS']) !!}
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

