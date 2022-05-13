$('#modal-edit').on('show.bs.modal', function (event) {

    let form = document.getElementById('alterarAnexo');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let nome = button.data('nome');
    var url = '{{route ("colaborador.editar.anexo", [":id"])}}';

    url = url.replace (':id', id);
    console.log(url);
    form.action = url;
    let modal = $(this);

    modal.find('.modal-body #idEdit').val(id);
    modal.find('.modal-body #nomeEdit').val(nome);
    console.log(nome)
});



