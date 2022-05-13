
$('#modal-cadastrar').on('show.bs.modal', function (event) {
    $('.select2').select2();

    $('#tipo').select2({
        width: '100%',
    }).trigger('change');

    $('#repetir_anualmente').select2({
        width: '100%',
    }).trigger('change');

    $('.date').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        autoclose: true
    });

});



