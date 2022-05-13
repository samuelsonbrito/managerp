<div class="modal fade" id="modal-cadastrar" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Adicionar Permissão de Acesso</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('admin.permissao-acesso')}}"
                        id-form="cadastrarUsuario"
                        cor-botao="primary"
                        acao="{{route('admin.permissao-acesso.adicionar')}}"
                        metodo="post"
                        nome-botao="Adicionar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    @inject('modulos','App\Services\AdministradorService')

                    <div class="row">
                        <div class="form-group col-md-12" id="validar-perfil">
                            {!! Form::label('perfil', 'Perfil:') !!}
                            {!! Form::select('perfil', $perfis, null , ['class' => 'form-control trigger select2', 'data-parsley-required' => 'true', 'id' => 'perfil', 'placeholder' => 'SELECIONE UM PERFIL']) !!}
                            <span id="error-nome"></span>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="">Módulos</label><span class="text-red">*</span>
                            {!! Form::select('modulos[]',@$modulos->getModulosSelect(), null,
                            ['class' => 'select2  form-control', 'id' => 'modulos', 'required' => 'required', 'data-placeholder' => 'SELECIONE OS MÓDULOS']) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('permissoes', 'Permissões para o Perfil:') !!}

                            <div>
                                <input type="checkbox" id="cadastrar" name="cadastrar" value="true">
                                <label for="cadastrar">Cadastrar</label>

                                <input type="checkbox" id="editar"  name="editar" value="true">
                                <label for="editar">Editar</label>

                                <input type="checkbox" id="visualizar" name="visualizar" value="true">
                                <label for="visualizar">Visualizar</label>

                                <input type="checkbox" id="excluir"  name="excluir" value="true">
                                <label for="excluir">Excluir</label>
                            </div>

                        </div>
                    </div>

                </formulario>
                <div class="modal-footer">

                </div>

            </div>
        </div>

    </div>
</div>

