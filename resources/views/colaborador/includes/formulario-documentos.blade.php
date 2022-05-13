@inject('uf','App\Services\PaisEstadoCidadeService')
<br>
<legend class="no-border text-inverse">Documentos</legend>
<div class="row">
    <div class="form-group col-md-2">
        <label class="">RG</label><span class="text-red">*</span>
        <input type="text" name="rg" placeholder="Número do RG" class="form-control" required="required"
    v-mask="['#######-#']" value="{{ $colaborador->documento->rg ?? '' }}">
        <span class="help-block"></span>
    </div>


    <div class="form-group col-md-2">
        <label class="">Orgão Emissor/UF</label><span class="text-red">*</span>
        <input type="text" name="orgao_emissor" placeholder="Orgão Emissor" class="form-control" required="required"
               maxlength="10" value="{{ $colaborador->documento->orgao_emissor ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-2">
        <label class="">Data de Expedição</label><span class="text-red">*</span>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="data_expedicao_rg" class="form-control" id="datepicker" required="required"
                   placeholder="Informe a Data" v-mask="['##/##/####']" value="{{ bdToBr(@$colaborador->documento->rg_data_emissao) ?? '' }}">
        </div>
        <span class="help-block"></span>

        <!-- /.input group -->
    </div>

    <div class="form-group col-md-3">
        <label class="">PIS</label><span class="text-red">*</span>
        <input type="text" name="pis" placeholder="Número do PIS" class="form-control" required="required"
               v-mask="['###########']" value="{{ $colaborador->documento->pis ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        <label class="">Data de Inscrição(PIS)</label><span class="text-red">*</span>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="data_pis" class="form-control" id="data_pis" required="required"
                   v-mask="['##/##/####']" placeholder="Informe a Data de Inscrição" value="{{ bdToBr(@$colaborador->documento->data_inscricao_pis) ?? '' }}">
        </div>
        <span class="help-block"></span>

        <!-- /.input group -->
    </div>
</div>

<div class="row">
    <div class="form-group col-md-3">
        <label class="">Título de Eleitor</label><span class="text-red">*</span>
        <input type="text" name="titulo" placeholder="Número do Título de Eleitor" class="form-control"
               required="required" v-mask="['##############']" value="{{ $colaborador->documento->titulo_eleitor ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        <label class="">Zona</label><span class="text-red">*</span>
        <input type="text" name="zona" placeholder="Número da Zona" class="form-control" required="required"
               v-mask="['####']" value="{{ $colaborador->documento->titulo_eleitor_zona ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        <label class="">Seção</label><span class="text-red">*</span>
        <input type="text" name="secao" placeholder="Número da Seção" class="form-control" required="required"
               v-mask="['####']" value="{{ $colaborador->documento->titulo_eleitor_secao ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        {!! Form::label('uf_titulo', 'UF'); !!}<span class="text-red">*</span>
        {!! Form::select('uf_titulo', $uf->getEstadosUf(), $colaborador->documento->titulo_eleitor_uf ?? 'AM', ['class' => 'col-md-4 form-control select2', 'id' => 'uf_titulo', 'required' => 'required']) !!}
    </div>
</div>


<div class="row">
    <div class="form-group col-md-3">
        <label class="">CTPS</label><span class="text-red">*</span>
        <input type="text" name="ctps" placeholder="Número CTPS" class="form-control" required="required"
               v-mask="['########']" value="{{ $colaborador->documento->ctps ?? '' }}">
        <span class="help-block"></span>
    </div>


    <div class="form-group col-md-3">
        <label class="">Série</label><span class="text-red">*</span>
        <input type="text" name="serie_ctps" placeholder="Número da Série" class="form-control" required="required"
               v-mask="['#####']" value="{{ $colaborador->documento->ctps_serie ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        {!! Form::label('uf_ctps', 'UF'); !!}<span class="text-red">*</span>
        {!! Form::select('uf_ctps', $uf->getEstadosUf(), $colaborador->documento->ctps_uf ?? 'AM', ['class' => 'col-md-4 form-control select2', 'id' => 'uf_ctps', 'required' => 'required']) !!}
    </div>

    <div class="form-group col-md-3">
        <label class="">Data de Emissão</label><span class="text-red">*</span>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="data_emissao_ctps" class="form-control" id="datepicker" required="required"
                   placeholder="Inform a Data de Emissão do CTPS" v-mask="['##/##/####']" value="{{ bdToBr(@$colaborador->documento->ctps_data_emissao) ?? '' }}">
        </div>
        <span class="help-block"></span>

    </div>

</div>

<div class="row">

    <div class="form-group col-md-4">
        {!! Form::label('conselho_profissional', 'Conselho Profissional') !!}
        {!! Form::select('conselho_profissional', $conselhos, $colaborador->conselhoProfissional->conselho_id ?? null, ['class' => 'conselho col-md-12 form-control', 'id' => 'conselho_profissional', 'placeholder' => 'SELECIONE UM CONSELHO']) !!}
    </div>

    <div class="form-group col-md-2">
        {!! Form::label('numero_conselho', 'Número Conselho') !!}
        {!! Form::text('numero_conselho', $colaborador->conselhoProfissional->numero_conselho ?? null, ['class' => 'conselho col-md-12 form-control', 'id' => 'numero_conselho', 'placeholder' => 'Número do Conselho', 'v-mask' => "['##################']"]) !!}
    </div>

    <div class="form-group col-md-2">
        <label class="">Data de Emissão</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="data_emissao_conselho" class="form-control" id="datepicker" placeholder="Inform a Data de Emissão" value="{{ bdToBr(@$colaborador->conselhoProfissional->data_emissao) ?? '' }}">
        </div>
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-2">
        <label class="">Data de Validade</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="validade_conselho" class="form-control" id="datepicker" placeholder="Informe  a Data de Validade" value="{{ bdToBr(@$colaborador->conselhoProfissional->data_validade) ?? '' }}">
        </div>
        <span class="help-block"></span>

    </div>

    <div class="form-group col-md-2">
        {!! Form::label('uf_conselho', 'UF'); !!}
        {!! Form::select('uf_conselho', $uf->getEstadosUf(), $colaborador->conselhoProfissional->uf ?? null, ['class' => 'col-md-4 form-control', 'id' => 'uf_conselho', 'required' => 'required', 'placeholder' => 'SELECIONE UF']) !!}
    </div>

</div>

<div class="row">
    <div class="form-group col-md-4">
        <label class="">Certificado de Reservista</label>
        <input type="text" name="certificado_reservista" placeholder="Informe o Número" class="form-control"
    v-mask="['##################']" value="{{ $colaborador->documento->certificado_reservista ?? '' }}">
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-4">
        <label class="">Série</label>
        <input type="text" name="serie_reservista" placeholder="Número da Série" class="form-control"
               v-mask="['#########']" value="{{ $colaborador->documento->certificado_reservista_serie ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-4">
        <label class="">Categoria do Certificado de Reservista</label>
        <input type="text" name="categoria_reservista" placeholder="Informe a Categoria" class="form-control" value="{{ $colaborador->documento->certificado_reservista_categoria ?? '' }}">
        <span class="help-block"></span>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label class="">CNH</label>
    <input type="text" name="cnh" placeholder="Número da CNH" class="form-control" v-mask="['##############']" value="{{ $colaborador->documento->cnh_numero ?? ''}}">
        <span class="help-block"></span>
    </div>
    <div class=" form-group col-md-2">
        {!! Form::label('categoria_cnh', 'Categoria'); !!}
        {!! Form::select('categoria_cnh', [
            'A' => 'CATEGORIA TIPO A',
            'B' => 'CATEGORIA TIPO B',
            'AB' => 'CATEGORIA TIPO AB',
            'C' => 'CATEGORIA TIPO C',
            'D' => 'CATEGORIA TIPO D',
            'E' => 'CATEGORIA TIPO E'
        ], $colaborador->documento->cnh_categoria ?? null, ['class' => 'categoria col-md-12 form-control', 'id' => 'categoria_cnh', 'placeholder' => 'Categoria da CNH']) !!}
    </div>
    <div class="form-group col-md-3">
        <label class="">Data de Validade</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="validade_cnh" class="form-control" id="datepicker" v-mask="['##/##/####']"
                   placeholder="Data de Validade da CNH" value="{{ bdToBr(@$colaborador->documento->cnh_data_validade) ?? '' }}">
        </div>
        <span class="help-block"></span>

    </div>
    <div class="form-group col-md-3">
        <label class="">Data de Emissão</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="emissao_cnh" class="form-control" id="datepicker" v-mask="['##/##/####']"
                   placeholder="Data de Emissão da CNH" value="{{ bdToBr(@$colaborador->documento->cnh_data_emissao) ?? '' }}">
        </div>
        <span class="help-block"></span>
    </div>
</div>
@if(\Route::getCurrentRoute()->getName() != 'colaborador.edit')
<legend class="no-border text-inverse">Anexos</legend>
<div class="row">
    <div class="form-group col-md-12">
        <button type="button" class="btn btn-warning btn-lg btn-flat" data-toggle="modal" data-target="#modal-dependentes">
            <i class="fa fa-paperclip"></i> Anexar Documentos
        </button>
    </div>
</div>

    <anexo></anexo>
@endif


