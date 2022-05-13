
$(document).ready(function () {
    var meses = $('#mes');
    meses.select2({
        width: '100%'
    });

    var cargo = $('#cargo');
    cargo.select2({

        width: '100%'
    });

    var turno = $('#turno');
    turno.select2({

        width: '100%'
    });


    var unidade = $('#unidade');
unidade.select2({
    placeholder: "SELECIONE UMA UNIDADE",
    width: '100%'
});

var setor = $('#setor');
var enviar = $('#enviar');
    setor.prop("disabled", true);
unidade.select2({
    placeholder: "SELECIONE UMA UNIDADE",
    width: '100%'
});
    unidade.change(function(){

        setor.prop("disabled", false);

    // let unidade_id = unidade.val();
            axios.post('/escala/unidade', {
                unidade: unidade.val()
            }).then(res => {
                if (res.data.status === true) {
                    let result =  res.data.dados;

                    if(result.length === 0){
                        enviar.prop("disabled", true);
                    } else {
                        enviar.prop("disabled", false);
                    }

                    setor.html('').trigger("change");

                    setor.select2({
                        placeholder: "SELECIONE UM SETOR",
                        data: result
                    });
                    this.clear();
                }
            });

});




});

