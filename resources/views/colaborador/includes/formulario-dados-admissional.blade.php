@inject('horarios','App\Services\HorarioTrabalhoService')
@inject('cargos','App\Services\CargoServices')
@inject('intervalos','App\Services\IntervaloService')


<br>
<legend class="no-border text-inverse">Dados para Admissão</legend>
<div class="row">
    <div class="form-group col-md-4">
        <label class="">Salário</label><span class="text-red">*</span>
        <div class="input-group">
            <span class="input-group-addon">R$</span>
        <input type="text" class="form-control" name="salario" placeholder="Informe o Salário" class="form-control" required="required" v-mask ='["#,##", "##,##", "###,##", "####,##", "#.###,##", "##.###,##", "###.###,##"]' value="{{ $colaborador->admissao->salario ?? ''}}">
        </div>
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-5">
        <label class="">Cargo</label><span class="text-red">*</span>
        {!! Form::select('cargo', $cargos->getCargos(), $colaborador->admissao->cargo_id ?? '', ['class' => 'select2 col-md-4 form-control', 'id' => 'cargo', 'required' => 'required']) !!}
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        <label class="">Data de Admissão</label><span class="text-red">*</span>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
        <input type="text" name="data_admissao" class="form-control" id="datepicker" required="required" placeholder="Informa a Data" v-mask='["##/##/####"]' value="{{ bdToBr(@$colaborador->admissao->data_admissao) ?? null}}">
        </div>
        <span class="help-block"></span>

    </div>

</div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="">Horário de Trabalho</label><span class="text-red">*</span>
            <select class="select2 col-md-4 form-control" name="horario_trabalho" required="required" id="horario_trabalho">
                @forelse($horarios->getHorariosTrabalhoSelect() as $horas)
                    @if ($horas->id == @$colaborador->horarioTrabalhoIntervalo->h_trabalho_id ?? null)
                        <option value="{{$horas->id}}" selected="selected">{{$horas->descricao_periodo.' - '.$horas->inicio_expediente.' às '.$horas->fim_expediente}}</option>
                    @else
                        <option value="{{$horas->id}}">{{$horas->descricao_periodo.' - '.$horas->inicio_expediente.' às '.$horas->fim_expediente}}</option>
                    @endif
                @empty
                    <option>Não existem Horários Cadastrados</option>
                @endforelse

            </select>
            <span class="help-block"></span>
        </div>

        <div class="form-group col-md-4">
            <label class="">Intervalo de Trabalho</label><span class="text-red">*</span>
            <select class="select2 col-md-4 form-control" name="horario_intervalo" required="required" id="horario_intervalo">
                @forelse($intervalos->getIntervalos() as $intervalo)
                    @if ($intervalo->id == @$colaborador->horarioTrabalhoIntervalo->i_trabalho_id ?? null)
                        <option value="{{$intervalo->id}}" selected="selected">{{$intervalo->hora_inicial.' às '.$intervalo->hora_final}}</option>
                    @else
                        <option value="{{$intervalo->id}}">{{$intervalo->hora_inicial.' às '.$intervalo->hora_final}}</option>
                    @endif
                @empty
                    <option>Não existem Intervalos Cadastrados</option>
                @endforelse

            </select>
            <span class="help-block"></span>
        </div>

        <div class="form-group col-md-4">
            <label class="">Regime de Trabalho</label><span class="text-red">*</span>
            {!! Form::select('regime_trabalho', ['DIARISTA' => 'DIARISTA', 'PLANTONISTA' => 'PLANTONISTA'], $colaborador->admissao->regime_trabalho ?? 'Diarista', ['class' => 'select2 col-md-4 form-control', 'id' => 'regime_trabalho', 'required' => 'required']) !!}
            <span class="help-block"></span>
        </div>

    </div>

    <div class="row">

        <div class="form-group col-md-2">
            <label class="">Exame Admissional</label><span class="text-red">*</span>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
            <input type="text" name="data_exame_admissional" class="form-control" id="datepicker"  placeholder="Informa a Data" required="required" v-mask='["##/##/####"]' value="{{ bdToBr(@$colaborador->admissao->data_exame_admissional) ?? null }}">
            </div>
            <span class="help-block"></span>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label class="labeltext">Primeiro Emprego?</label><br>
            <div class="form-check-inline">
                <label class="radio-inline">
                    <input type="radio" name="primeiro_emprego" value="0" {{ @$colaborador->admissao->primeiro_emprego != '0' &&  @$colaborador->admissao->primeiro_emprego != '1' ? 'checked' : 'checked' }}>NÃO
                </label>
                <label class="radio-inline">  
                    <input type="radio" name="primeiro_emprego" value="1" {{ @$colaborador->admissao->primeiro_emprego == '1' ? 'checked' : '' }}>SIM
                </label>
            </div>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label class="labeltext">Readmissão?</label><br>
            <div class="form-check-inline">
                <label class="radio-inline">
                    <input type="radio" name="readmissao" value="0" {{ @$colaborador->admissao->readmissao != '0' &&  @$colaborador->admissao->residencia_propria != '1' ? 'checked' : 'checked' }}>NÃO
                </label>
                <label class="radio-inline">
                    <input type="radio" name="readmissao" value="1" {{ @$colaborador->admissao->readmissao == '1' ? 'checked' : '' }}>SIM
                </label>
            </div>
        </div>

        <div class="col-md-5 col-sm-12 col-xs-12 form-group">
            <label class="labeltext">Contrato de Trabalho Registrado em Outra Empresa?</label><br>
            <div class="form-check-inline">
                <label class="radio-inline">
                    <input type="radio" name="contrato_outra" value="0" {{ @$colaborador->admissao->contrato_registrado_outra_empresa != '0' &&  @$colaborador->admissao->contrato_registrado_outra_empresa != '1' ? 'checked' : 'checked' }}>NÃO
                </label>
                <label class="radio-inline">
                    <input type="radio" name="contrato_outra" value="1" {{ @$colaborador->admissao->contrato_registrado_outra_empresa == '1' ? 'checked' : '' }}>SIM
                </label>
            </div>
        </div>
    </div>

<div class="row">

    <div class="col-md-7 col-sm-7 col-xs-12 form-group">
        {!! Form::label('experiencia', 'Experiência') !!}<span class="text-red">*</span>
        {!! Form::select('experiencia', $experiencias , $colaborador->admissao->experiencia_id ?? '1', ['class' => 'select2 col-md-7 form-control', 'id' => 'experiencia', 'required' => 'required']) !!}
        <span class="help-block"></span>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <label class="labeltext"> Vale Transporte, proceder com o Desconto?</label><br>
        <div class="form-check-inline">
            <label class="radio-inline">
                <input type="radio" name="vale_transporte" value="0" {{ @$colaborador->admissao->vale_transporte_desconto != '0' &&  @$colaborador->admissao->vale_transporte_desconto != '1' ? 'checked' : 'checked' }}>NÃO
            </label>
            <label class="radio-inline">
                <input type="radio" name="vale_transporte" value="1" {{ @$colaborador->admissao->vale_transporte_desconto == '1' ? 'checked' : '' }}>SIM
            </label>
        </div>
    </div>

</div>