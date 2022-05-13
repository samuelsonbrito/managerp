<br>
<legend class="no-border text-inverse">Informações Familiar</legend>
<div class="row">

    <div class="form-group col-md-6">
        <label class="">Nome do Pai</label>
        <input type="text" name="nome_pai" placeholder="Nome do Pai" class="form-control" maxlength="75" value="{{ $colaborador->nome_pai ?? '' }}">
        <span class="help-block"></span>
    </div>


    <div class="form-group col-md-6">
        <label class="">Nome da Mãe</label><span class="text-red">*</span>
        <input type="text" name="nome_mae" placeholder="Nome da Mãe" class="form-control" maxlength="75" required="required" value="{{ $colaborador->nome_mae ?? ''}}">
        <span class="help-block"></span>
    </div>
</div>

@if(\Route::getCurrentRoute()->getName() != 'colaborador.edit')
    <dependentes></dependentes>
@endif

