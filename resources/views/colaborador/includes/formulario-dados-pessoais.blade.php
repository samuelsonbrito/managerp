<br>
<legend class="no-border text-inverse">Informações Pessoais</legend>
<div class="row">
    <input type="hidden" name="colaborador_id" value="{{ $colaborador->id ?? null }}">
    <div class="form-group col-md-2">
        <label class="">CPF</label><span class="text-red">*</span>
        <input type="text" name="cpf" placeholder="Número do CPF" id="cpf" class="form-control" required="required"
               v-mask="['###.###.###-##']" value="{{ $colaborador->documento->cpf ?? '' }}">
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-7">
        <label class="">Nome</label><span class="text-red">*</span>
        <input type="text" name="nome" placeholder="Nome Completo" class="form-control" required="required"
               maxlength="75" value="{{ $colaborador->nome ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        <label class="">Matrícula</label> <span data-tooltip="Caso deixe o campo em branco, será gerado um número de matrícula."><i class="fa fa-info-circle"></i></span>
        <input type="text" name="matricula" placeholder="Matrícula do Colaborador" class="form-control"
               maxlength="75" value="{{ $colaborador->matricula ?? '' }}">
        <span class="help-block"></span>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label class="">Data de Nascimento</label><span class="text-red">*</span>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="data_nascimento" class="form-control" id="datepicker" required="required"
                   v-mask='["##/##/####"]' placeholder="Informe a Data de Nascimento" value="{{ bdToBr(@$colaborador->data_nascimento) ?? null }}">
        </div>
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-4">
        {!! Form::label('nacionalidade', 'Nacionalidade') !!}<span class="text-red">*</span>
        {!! Form::select('nacionalidade', $paises, nacionalidadeNome(@$colaborador->nacionalidade) ?? '25', ['class' => 'select2 col-md-4 form-control', 'id' => 'nacionalidade', 'required' => 'required']) !!}
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-4">
        {!! Form::label('estado_nascimento', 'Estado de Nascimento'); !!}<span class="text-red">*</span>
        {!! Form::select('estado_nascimento', $estados, $colaborador->estado_nascimento ?? 'AM', ['class' => 'select2 col-md-4 form-control', 'id' => 'estado_nascimento', 'required' => 'required']) !!}
    </div>

</div>

<div class="row">

    <div class="form-group col-md-2">
        <label class="">Cidade</label><span class="text-red">*</span>
        <input type="text" name="cidade_nascimento" placeholder="Cidade de Nascimento" class="form-control"
               required="required" maxlength="30" value="{{ $colaborador->local_nascimento ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-2">
        <label class="">Raça e Cor</label><span class="text-red">*</span>
        {!! Form::select('raca_cor', [
            'INDÍGENA'=> 'INDÍGENA',
            'BRANCA' => 'BRANCA',
            'NEGRA' => 'NEGRA',
            'PARDA' => 'PARDA'
            ], $colaborador->raca_cor ?? 'INDÍGENA', ['class' => 'select2 col-md-4 form-control', 'id' => 'raca_cor', 'required' => 'required']) !!}

    </div>

    <div class=" form-group col-md-2">
        {!! Form::label('estado_civil', 'Estado Civil'); !!}
        {!! Form::select('estado_civil', [
            'SOLTEIRO(A)' => 'SOLTEIRO(A)',
            'CASADO(A)' => 'CASADO(A)',
            'VIÚVO(A)' => 'VIÚVO(A)',
            'SEPARADO(A)' => 'SEPARADO(A)',
            'DIVORCIADO(A)' => 'DIVORCIADO(A)',
            'UNIÃO ESTÁVEL' => 'UNIÃO ESTÁVEL',
        ], $colaborador->estado_civil ?? '', ['class' => 'select2 col-md-12 form-control', 'id' => 'estado_civil']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grau_instrucao">Grau de Instrução</label><span class="text-red">*</span>
        {!! Form::select('grau_instrucao', [
            "PRIMEIRO GRAU INCOMPLETO"=>'PRIMEIRO GRAU INCOMPLETO',
            "PRIMEIRO GRAU COMPLETO"=>'PRIMEIRO GRAU COMPLETO',
            "SEGUNDO GRAU COMPLETO"=>'SEGUNDO GRAU COMPLETO',
            "SEGUNDO GRAU INCOMPLETO"=>'SEGUNDO GRAU INCOMPLETO',
            "SUPERIOR INCOMPLETO"=>'SUPERIOR INCOMPLETO',
            "SUPERIOR COMPLETO"=>'SUPERIOR COMPLETO',
            "PÓS-GRADUAÇÃO"=>'PÓS-GRADUAÇÃO',
            "MESTRADO"=>'MESTRADO',
            "DOUTORADO"=>'DOUTORADO',
            "TÉCNICO"=>'TÉCNICO'
        ], $colaborador->grau_instrucao ?? '', ['class' => 'select2 col-md-12 form-control', 'id' => 'grau_instrucao']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-3">
        <label class="">Fone Contato</label><span class="text-red">*</span>
        <input type="text" name="fone_contato" placeholder="Telefone pra Contato" class="form-control"
               required="required" maxlength="30" value="{{ $colaborador->fone_contato ?? '' }}" v-mask="['(##)####-####', '(##)#####-####']">
        <span class="help-block"></span>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-12 form-group">
        <label class="labeltext">Residência Própria?</label><br>
        <div class="form-check-inline">
            <label class="radio-inline">
                <input type="radio" name="residencia_propria" value="0" onClick="bloqueiaRadioRecurso(this)" {{ @$colaborador->residencia_propria != '0' &&  @$colaborador->residencia_propria != '1' ? 'checked' : 'checked' }} required="required">NÃO
            </label>
            <label class="radio-inline">
                <input type="radio" name="residencia_propria" value="1" onClick="liberaRadioRecurso(this)" {{ @$colaborador->residencia_propria == '1' ? 'checked' : '' }} required="required">SIM
            </label>
        </div>
    </div>


    <div class="col-md-4 col-xs-12 col-sm-12 form-group">
        <label class="labeltext">Comprada com Recursos do FGTS?</label><br>
        <div class="form-check-inline">
            <label class="radio-inline">
                <input type="radio" name="recurso_fgts" value="0" id="recurso_fgts0" {{ @$colaborador->recurso_fgts == '0' ? 'checked' : '' }} {{ @$colaborador->recurso_fgts != '0' && @$colaborador->recurso_fgts != '1' ? 'disabled' : '' }}>NÃO
            </label>
            <label class="radio-inline">
                <input type="radio" name="recurso_fgts" value="1" id="recurso_fgts1" {{ @$colaborador->recurso_fgts == '1' ? 'checked' : 'disabled' }}>SIM
            </label>
        </div>
    </div>
</div>

<legend class="no-border text-inverse">Endereço</legend>
<div class="row">

    <div class="form-group col-md-4">
        <label class="">Cep</label><span class="text-red">*</span>
        {!! Form::text('cep', $colaborador->endereco->cep ?? '', ['class' => 'form-control', 'id'=> 'cep', 'required' => 'required', 'placeholder' => 'Informe o CEP', 'v-mask' => "'#####-###'"]) !!}
        <span class="help-block"></span>
    </div>


    <div class="form-group col-md-4">
        <label class="">Cidade</label><span class="text-red">*</span>
        <input type="text" name="cidade" placeholder="Cidade do Endereço" id="cidade" class="form-control"
               required="required" maxlength="30" value={{ $colaborador->endereco->cidade ?? ''}}>
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-4">
        <label class="">UF</label><span class="text-red">*</span>
        <input type="text" name="uf" placeholder="Estado do Endereço" id="uf" class="form-control" required="required"
               v-mask="['AA']" value="{{ $colaborador->endereco->uf ?? ''}}">
        <span class="help-block"></span>
    </div>
</div>
<div class="row">

    <div class="form-group col-md-6">
        <label class="">Rua</label><span class="text-red">*</span>
        <input type="text" name="rua" placeholder="Rua" id="rua" class="form-control" required="required"
               maxlength="50" value="{{ $colaborador->endereco->rua ?? ''}}">
        <span
                class="help-block"></span>
    </div>


    <div class="form-group col-md-3">
        <label class="">Número</label><span class="text-red">*</span>
        <input type="text" name="numero" placeholder="Número da Residência" id="numero" class="form-control"
               required="required" maxlength="20" value="{{ $colaborador->endereco->numero ?? '' }}">
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        <label class="">Bairro</label><span class="text-red">*</span>
        <input type="text" name="bairro" placeholder="Bairro" id="bairro" class="form-control" required="required"
               maxlength="30" value="{{ $colaborador->endereco->bairro ?? '' }}">
        <span class="help-block"></span>
    </div>
</div>

<div class="row">

    <div class="form-group col-md-12">
        <label class="">Complemento</label>
        <input type="text" name="complemento" placeholder="Complemento" class="form-control" maxlength="75" value="{{ $colaborador->endereco->complemento ?? '' }}">
    </div>

</div>
