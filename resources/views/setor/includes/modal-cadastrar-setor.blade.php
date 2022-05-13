<div class="modal fade" id="modal-cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 class="modal-title">Cadastrar Unidade</h4>
            </div>
            <div class="modal-body">
                <formulario
                        validate="true"
                        redirect="true"
                        enc-type="multipart/form-data"
                        rota-redirect="{{route('setor.index')}}"
                        id-form="cadastrarSetor"
                        cor-botao="primary"
                        acao="{{route('setor.store')}}"
                        metodo="post"
                        nome-botao="Cadastrar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="form-group col-md-12" id="validar-nome">
                            {!! Form::label('nome', 'Nome:') !!}
                            {!! Form::text('nome', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'nome', 'placeholder' => 'DIGITE O NOME DO SETOR']) !!}
                            <span id="error-nome"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            {!! Form::label('unidade', 'Unidades:') !!}
                            {!! Form::select('unidade', $unidades, $unidades->id ?? null, ['class' => 'conselho col-md-12 form-control', 'id' => 'unidades']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('insalubridade', 'Insalubridade:') !!}
                            {!! Form::select('insalubridade', [20 => 20, 40 => 40], 20, ['class' => 'conselho col-md-12 form-control', 'id' => 'insalubridade']) !!}
                        </div>
                    </div>

                </formulario>
                <div class="modal-footer">

                </div>

            </div>
        </div>

    </div>
</div>
