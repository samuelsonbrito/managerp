$('#modal-edit').on('show.bs.modal', function (event) {
    let form = document.getElementById('alterarHorarioIntervalo');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let hora_inicial = button.data('inicio');
    let hora_final = button.data('fim');

    var url = '{{route ("horario-intervalo.update", [":id"])}}';

    url = url.replace(':id', id);
    form.action = url;

    $('#idEdit').val(id);

    $('#alterarHorarioIntervalo #hora_inicialEdit').val(hora_inicial);


    $('#alterarHorarioIntervalo #hora_finalEdit').val(hora_final);

});



