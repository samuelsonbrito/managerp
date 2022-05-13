$(document).ready(function () {

    (/edit/i.test(location.href)) ? removerDisableEdit() : false;

    function removerDisableEdit() {
        var nextStepWizard2=  $(".btn-circle");
        nextStepWizard2.removeAttr('disabled')

    }

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default').css('color', '#66737c');
            $item.addClass('btn-primary').css('color', '#ffffff');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');

    $('.select2').select2();
    $('#experiencia').select2({
        width: '100%',
    }).trigger('change');
    $('#grau_instrucao').select2({
        width: '100%',
    }).trigger('change');
    $('#estado_civil').select2({
        width: '100%',
    }).trigger('change');
    $('#raca_cor').select2({
        width: '100%',
    }).trigger('change');
    $('#estado_nascimento').select2({
        width: '100%',
    }).trigger('change');
    $('#uf_titulo').select2({
        width: '100%',
    }).trigger('change');
    $('#uf_ctps').select2({
        width: '100%',
    }).trigger('change');
    $('#nacionalidade').select2({
        width: '100%',
    }).trigger('change');
    $('#horario_trabalho').select2({
        width: '100%',
    }).trigger('change');
    $('#horario_intervalo').select2({
        width: '100%',
    }).trigger('change');
    $('#regime_trabalho').select2({
        width: '100%',
    }).trigger('change');

    $('#cargo').select2({
        width: '100%',
    }).trigger('change');

    $('#categoria_cnh').select2({
        placeholder: "SELECIONE A CATEGORIA",
        width: '100%',
    });

    $('#conselho_profissional').select2({
        placeholder: "SELECIONE O CONSELHO",
        width: '100%',
    });
    $('#uf_conselho').select2({
        placeholder: "SELECIONE UF",
        width: '100%',
    });

    $('.date').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        autoclose: true
    });

    var unidade = $('#unidade2');
    unidade.select2({
        placeholder: "SELECIONE UMA UNIDADE",
        width: '100%'
    });

    var setor = $('#setor2');
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

var nacionalidade = $("#nacionalidade").change(function () {
    if (nacionalidade.val() !== '25') {
        $("#estado_nascimento").prop('disabled', true);
    } else {
        $("#estado_nascimento").prop('disabled', false);
    }
});

function click2() {
    document.getElementById('btn-salvar').click();
}

function liberaRadioRecurso() {
    $("#recurso_fgts0").prop('disabled', false);
    $("#recurso_fgts1").prop('disabled', false);
}

function bloqueiaRadioRecurso() {
    $("#recurso_fgts0").prop('disabled', true);
    $("#recurso_fgts1").prop('disabled', true);
}


$("#cpf").keyup(function () {
    let value = $(this).val();
    if (value.length >= '8') {
        axios.post('/colaborador/verifica-cpf', {
            cpf: value
        }).then(res => {
            if (res.data.status === true) {
                swal(res.data.data.msg, {
                    icon: 'error',
                    buttons: false,
                    timer: 2500,
                }).then(() => {
                        window.location.href = '/colaborador';
                        }
                    );
            }
        });

    }
});






