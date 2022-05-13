
$('#modal-cadastrar').on('show.bs.modal', function (event) {
    $('.select2').select2();

    $('#unidades').select2({
        width: '100%',
    }).trigger('change');

    $('#insalubridade').select2({
        width: '100%',
    }).trigger('change');

    let form = document.getElementById('alterarSetor');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let nome = button.data('nome');
    let insalubridade = button.data('insalubridade');
    let unidade = button.data('unidade');

    var url = '{{route ("setor.update", [":id"])}}';

    url = url.replace (':id', id);
    form.action = url;


    if( typeof id != "undefined") {
        $('#idEdit').val(id);
    }
    if( typeof nome != "undefined"){
        $('#nomeEdit').val(nome);
    }

    if( typeof nome != "undefined"){
        $('#nomeEdit').val(nome);
    }
});


var id = '';
var nome = '';
var insalubridade = '';
var unidade = '';
$('#modal-edit').on('show.bs.modal', function (event) {
    $('.select2').select2();
    //


    let form = document.getElementById('alterarSetor');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let nome = button.data('nome');
    let insalubridade = button.data('insalubridade');
    let unidade = button.data('unidade');

    var url = '{{route ("setor.update", [":id"])}}';

    url = url.replace (':id', id);
    form.action = url;


    if( typeof id != "undefined") {
        $('#idEdit').val(id);
    }

    if( typeof nome != "undefined"){
        $('#nomeEdit').val(nome);
    }

    $('#unidadeEdit').select2({
        width: '100%',
    }).val(unidade);

    $('#insalubridadeEdit').select2({
        width: '100%',
    }).trigger(insalubridade);

    // if( typeof insalubridade != "undefined"){
    //     $('#insalubridadeEdit').val(insalubridade);
    // }
    //
    // if( typeof unidade != "undefined"){
    //     $('#unidadeEdit').val(unidade);
    // }
});



