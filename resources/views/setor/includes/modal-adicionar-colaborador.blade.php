<div class="modal fade" id="modal-cadastrar" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        rota-redirect="{{route('setor.colaboradores', $id)}}"
                        id-form="cadastrarSetor"
                        cor-botao="primary"
                        acao="{{route('setor.adicionar-colaborador', $id)}}"
                        metodo="post"
                        nome-botao="Adicionar"
                        icon-botao="fa fa-save"
                        id-botao="btn-cadastrar"
                        nome-botao-desabilitado="Salvando...">
                    {{csrf_field()}}

                    <div class="row">

                        {{--<div class="form-group col-md-12" id="validar-nome">--}}
                            {{--{!! Form::label('nome', 'Nome:') !!}--}}
                            {{--{!! Form::text('nome', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'nome', 'placeholder' => 'DIGITE O NOME DO SETOR']) !!}--}}
                            {{--<span id="error-nome"></span>--}}
                        {{--</div>--}}

                        <div class="form-group col-md-12" id="validar-colaboradores">
                            {!! Form::label('colaboradores', 'Informe o Nome do Colaborador:', ['class' => 'm-b-1']) !!}<span class="text-red">*</span>
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

