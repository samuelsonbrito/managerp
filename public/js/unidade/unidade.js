var id = '';
var nome = '';

$('#modal-edit').on('show.bs.modal', function (event) {

    let form = document.getElementById('alterarUnidade');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let nome = button.data('nome');

    var url = '{{route ("unidade.update", [":id"])}}';

    url = url.replace (':id', id);
    form.action = url;


    if( typeof id != "undefined") {
        $('#idEdit').val(id);
    }
    if( typeof nome != "undefined"){
        $('#nomeEdit').val(nome);
    }
});



