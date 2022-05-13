
$('#modal-cadastrar').on('show.bs.modal', function (event) {


    $('#colaboradores').select2({
        width: '100%',
            minimumInputLength: 1,
            placeholder: 'NOME - CPF',
            ajax: {
                url: '/setor/get-colaboradores/ajax',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
                processResults: function(data, params){
                    params.page = params.page || 1;
                    return{

                        results: data,
                        pagination:{
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
        }
    });



});




