$('#modal-cadastrar').on('show.bs.modal', function (event) {
    $('#unidade').select2({
        placeholder: "SELECIONE A(S) UNIDADE(S)",
        width: '100%',
    });
    $('#cliente_contrato').select2({
        placeholder:"SELECIONE UM CLIENTE",
        width:'100%',
    });

    $('#data_inicial').datepicker({
        format: 'dd/mm/yyyy',
        language:'pt-BR',
        startDate: '-5d'
    });
    $('#data_final').datepicker({
        format: 'dd/mm/yyyy',
        language:'pt-BR',
        startDate: '-1d'
    });
    $('#data_assinatura').datepicker({
        format: 'dd/mm/yyyy',
        language:'pt-BR',
        startDate: '-5d'
    });

    $(document).ready(function(){
        $('#valor').maskMoney({
            showSymbol:true,
            symbol:"R$",
            decimal:",",
            thousands:"."});
    });
});