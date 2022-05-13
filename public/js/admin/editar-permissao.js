$('#modal-edit').on('show.bs.modal', function (event) {

    let form = document.getElementById('alterarPermissao');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let descricao = button.data('descricao');
    let modulos = button.data('modulos');
    var url = '{{route ("colaborador.editar.anexo", [":id"])}}';

    console.log(descricao)
    console.log(modulos)

    url = url.replace (':id', id);
    console.log(url);
    form.action = url;
    let modal = $(this);

    modal.find('.modal-body #idEdit').val(id);
    modal.find('.modal-body #nomeEdit').val(nome);
    console.log(nome)
});