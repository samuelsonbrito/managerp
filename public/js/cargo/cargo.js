var id = '';
var descricao = '';

$('#modal-edit').on('show.bs.modal', function (event) {

    let form = document.getElementById('alterarCargo');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let descricao = button.data('descricao');

    var url = '{{route ("cargo.update", [":id"])}}';

    url = url.replace (':id', id);
    form.action = url;


    if( typeof id != "undefined") {
        $('#idEdit').val(id);
    }
    if( typeof descricao != "undefined"){
        $('#descricaoEdit').val(descricao);
    }
});



