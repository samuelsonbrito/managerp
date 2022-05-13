var id = '';
var nome = '';
var cpf = '';
var data_nascimento = null;

$('#modal-edit').on('show.bs.modal', function (event) {

    let form = document.getElementById('alterarDependente');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let nome = button.data('nome');
    let cpf = button.data('cpf');
    let data_nascimento = button.data('data');
    var url = '{{route ("colaborador.editar.dependente", [":id"])}}';

    url = url.replace (':id', id);
    form.action = url;


    if( typeof id != "undefined") {
        $('#idEdit').val(id);
    }
    if( typeof nome != "undefined"){
        $('#nomeEdit').val(nome);
    }

    if( typeof cpf != "undefined"){
        $('#cpfEdit').val(cpf);
    }

    if( typeof data_nascimento != "undefined" && typeof data_nascimento != null){
        $('#dataNascimentoEditar').val(data_nascimento);
    }
});



