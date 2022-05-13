$('#modal-edit').on('show.bs.modal', function (event) {

    let form = document.getElementById('alterarHorarioTrabalho');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let descricao_periodo = button.data('descricao');
    let inicio_expediente = button.data('inicio');
    let fim_expediente = button.data('fim');

    var url = '{{route ("horario-trabalho.update", [":id"])}}';

    url = url.replace(':id', id);
    form.action = url;

    $('#idEdit').val(id);

    $('#alterarHorarioTrabalho #descricao_periodoEdit').val(descricao_periodo);


    $('#alterarHorarioTrabalho #inicio_expedienteEdit').val(inicio_expediente);


    $('#alterarHorarioTrabalho #fim_expedienteEdit').val(fim_expediente);

});



