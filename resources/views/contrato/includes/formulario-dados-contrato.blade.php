@inject('unidades','App\Services\UnidadeService')
@inject('clientes','App\Models\Cliente')
<br>
<legend class="no-border text-inverse">Informações Básicas</legend>
<div class="row">
    {{-- {{dd($unidades->getUnidades())}} --}}
    <div class="form-group col-md-12">
        <label class="">Unidade</label><span class="text-red">*</span>
        {!! Form::select('unidades[]',@$unidades->getUnidades(), null,
        ['class' => 'select2  form-control', 'id' => 'unidades_contrato', 'required' => 'required', 'data-placeholder' => 'SELECIONE']) !!}

      
    </div>

    <div class="form-group col-md-2 col-sm-4">
        <input type="hidden" value={{@$dados['contrato']->id}} name="contrato_id">
        <label class="">Número Contrato</label> <span data-tooltip="Caso deixe o campo em branco, será gerado um número de contrato."><i class="fa fa-info-circle"></i></span>
        <input type="text" name="numero" placeholder="Número contrato" class="form-control"
               maxlength="75" value="{{ @$dados['contrato']->numero ?? '' }}">
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-2 col-sm-4">
        <label class="">Cliente</label><span class="text-red">*</span>
        {!! Form::select('cliente', @$clientes->pluck('nome','id')->sortByDesc('created_at'), @$dados['contrato']->cliente_id ?? '',
            ['class' => 'select2  form-control', 'id' => 'tipo', 'required' => 'required', 'placeholder' => 'SELECIONE']) !!}
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-2 col-sm-4">
        <label class="">Data Início</label><span class="text-red">*</span>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="data_inicial" required="required" name="data_inicial"
                   maxlength="75" value="{{@$dados['contrato']->data_inicial ?? '' }}">
        </div>
        <span class="help-block"></span>
        <!-- /.input group -->
    </div>
    <div class="form-group col-md-2 col-sm-4">
        <label class="">Data Final </label><span class="text-red">*</span>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="data_final" required="required" name="data_final"
                   maxlength="75" value="{{ @$dados['contrato']->data_fim ?? '' }}">
        </div>
        <span class="help-block"></span>
        <!-- /.input group -->
    </div>
    <div class="form-group col-md-2 col-sm-4">
        <label class="">Data Assinatura</label><span class="text-red">*</span>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="data_assinatura" required="required" name="data_assinatura"
                   maxlength="75" value="{{ @$dados['contrato']->data_assinatura ?? '' }}">
        </div>
        <span class="help-block"></span>
        <!-- /.input group -->
    </div>

    <div class="form-group col-md-2 col-sm-4">
        <label class="">Valor do Contrato</label><span class="text-red">*</span>
        <div class="input-group ">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            <input type="text" class="form-control pull-right" id="valor" required="required"  value="{{ number_format(@$dados['contrato']->valor,2,",",".") ?? '' }}" name="valor">
        </div>
        <span class="help-block"></span>
        <!-- /.input group -->
    </div>
    
</div>