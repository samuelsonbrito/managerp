$('#modal-cadastrar').on('show.bs.modal', function (event) {
    $('#perfil').select2({
        width: '100%',
        placeholder: 'INFORME UM PERFIL'
    }).trigger('change');

    $('#status').select2({
        width: '100%',
        placeholder: 'SELECIONE O STATUS'
    }).trigger('change');
});