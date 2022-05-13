$('#modal-edit').on('show.bs.modal', function (event) {
    $("#validar-substitutoAvulsoEdit").hide();


    let form = document.getElementById('alterarFrequencia');
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let motivo = button.data('motivo');
    let savulso = button.data('savulso');
    let sextra = button.data('sextra');
    let sextranome = button.data('sextranome');
    let tipo = button.data('tipo');

    var url = '{{route ("frequencia.update", [":id"])}}';
    //
    url = url.replace (':id', id);
    form.action = url;
    //
    //
    if( typeof id != "undefined") {
        $('#frequencia_id').val(id);
    }
    //
    if( typeof motivo != "undefined"){
        $('#motivoEdit').val(motivo);
    }

    if( typeof savulso != "undefined"){
        $('#substitutoAvulsoEdit').val(savulso);
    }


    if (tipo == 'AVULSO') {
        $('#c2').prop('checked', true);
        $('#c1').prop('checked', false);
        $('#c3').prop('checked', false);
    }
    else if (tipo == 'PAGANDO FALTA') {
        $('#c3').prop('checked', true);
        $('#c1').prop('checked', false);
        $('#c2').prop('checked', false);
    }
    else if (tipo != 'PAGANDO FALTA' && tipo != 'AVULSO') {
        $('#c1').prop('checked', true);
        $('#c2').prop('checked', false);
        $('#c3').prop('checked', false);
    }

    var colaborador = $('#colaboradores').select2({
        type: 'select2:select',
        width: '100%',
        data: [
            {
                id: sextra,
                text: sextranome
            },
        ]
    }).trigger('change');

    colaborador.select2({
        width: '100%',
        data: null,
        minimumInputLength: 1,
        placeholder: 'NOME - CPF',
        ajax: {
            url: '/setor/get-colaboradores/ajax',
            dataType: 'json',
            data: function (params) {
                colaborador.off('select2:select');

                // data2 = null;
                // $('#colaboradores').val(null).trigger('change');

                var query = {
                    search: params.term,
                    type: 'public'
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function(data, params){
                colaborador.off('select2:select');


                colaborador.val(null).trigger('change');
                colaborador.html('').trigger("change");


                params.page = params.page || 1;
                return{

                    results: data,
                    pagination:{
                        more: (params.page * 30) < data.total_count
                    }
                };
            },

        }
    });

});
$('input[type=radio][name=tipo_substituto]').change(function() {
    if (this.value == 'AVULSO') {
        $("#validar-colaboradores").hide();
        $("#validar-substitutoAvulsoEdit").show();

    }
    else if (this.value == 'PAGANDO FALTA') {
        $("#colaboradores").val(null).trigger('change');
        $("#colaboradores").html('').trigger("change");
        $("#colaboradores").trigger("destroy");
        $("#validar-colaboradores").show();
        $("#validar-substitutoAvulsoEdit").hide();
    }
    else if (this.value == 'NENHUM') {
        $("#validar-colaboradores").show();
        $("#validar-substitutoAvulsoEdit").hide();
    }
});



