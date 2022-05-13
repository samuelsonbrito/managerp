<br>
<legend class="no-border text-inverse">Posto de Trabalho</legend>

@if(count($unidades) <= 0)
<div class="callout callout-warning">
    <h4>Aviso!</h4>
    <p>Não há Unidades Cadastradas no Momento.</p>
</div>
@endif


@if(\Route::getCurrentRoute()->getName() != 'colaborador.edit')
    <posto-trabalho>
        <div class="form-group col-md-5" id="validar-unidade2">
            {!! Form::label('unidade2', 'Unidade:') !!}
            {!! Form::select('unidade2', $unidades, '' , ['class' => 'conselho col-md-12 form-control select2 trigger', 'data-parsley-required' => 'true', 'id' => 'unidade2', 'placeholder'=> '']) !!}
        </div>

        <div class="form-group col-md-5" id="validar-setor2">
            {!! Form::label('setor2', 'Setor:') !!}
            {!! Form::select('setor2', [], null, ['class' => 'conselho col-md-12 form-control trigger', 'id' => 'setor2', 'placeholder'=> '']) !!}
        </div>

    </posto-trabalho>
@endif

