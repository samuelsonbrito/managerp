<br>
<legend class="no-border text-inverse">Informações Básicas</legend>
<div class="row">
    <div class="form-group col-md-2">
        <label class="">Tipo Pessoa</label><span class="text-red">*</span>
        {!! Form::select('tipo_pessoa', [
            'F'=> 'PESSOA FÍSICA',
            'J' => 'PESSOA JURÍDICA'
            ], $cliente->tipo_pessoa ?? null, ['class' => 'select2 col-md-4 form-control', 'id' => 'tipo_pessoa', 'required' => 'required', 'placeholder' => 'SELECIONE']) !!}

    </div>
    <input type="hidden" name="cliente_id" value="{{ $cliente->id ?? null }}">

    <div class="form-group col-md-7">
        <label class="">Nome</label><span class="text-red">*</span>
        <input type="text" name="nome" placeholder="Nome Completo" class="form-control" required="required"
               maxlength="75" value="{{ $cliente->nome ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-2">
        <label class="">Tipo</label><span class="text-red">*</span>
        {!! Form::select('papel', [
            'CLIENTE'=> 'CLIENTE',
            'FORNECEDOR' => 'FORNECEDOR'
            ], $cliente->papel ?? null, ['class' => 'select2 col-md-4 form-control', 'id' => 'tipo', 'required' => 'required', 'placeholder' => 'SELECIONE']) !!}

    </div>


</div>

<div class="row">
    <div class="form-group col-md-2">
        <label class="">CPF/CNPJ</label><span class="text-red">*</span>
        <input type="text" name="cpf_cnpj" placeholder="NÚMERO DO CPF OU CNPJ" id="cpf" class="form-control" required="required"
               v-mask="['###.###.###-##', '##.###.###/####-##']" value="{{ $cliente->cpf_cnpj ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-2">
        <label class="">Telefone</label><span class="text-red">*</span>
        <input type="text" name="telefone" placeholder="INFORME O TELEFONE" id="cpf" class="form-control" required="required"
               v-mask="['(##)#####-####', '(##)####-####']" value="{{ $cliente->telefone ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-7">
        <label class="">Nome Fantasia</label>
        <input type="text" name="nome_fantasia" placeholder="INFORME O NOME FANTASIA" class="form-control" required="required"
               maxlength="75" value="{{ $cliente->nome_fantasia ?? '' }}">
        <span class="help-block"></span>
    </div>
</div>