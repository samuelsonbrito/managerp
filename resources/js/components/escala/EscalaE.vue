<template>
    <div>

        <div class="box  box-solid">
            <div class="box-header cabecalho with-border text-center">
                <h3 class="box-title text-center">INFORMAÇÕES DA ESCALA</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead class="profissionais">
                    <tr>
                        <td colspan="3">UNIDADE: <strong> {{unidade_dados.nome}}</strong></td>
                        <td colspan="3">CARGO: <strong>{{cargo_dados.descricao}}</strong></td>
                        <td colspan="3">TURNO: <strong>{{escala_dados.turno}}</strong></td>
                        <td colspan="3" class="text-right">PERÍODO: <strong>{{escala_dados.periodo}}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="12" class="text-center ">SETOR: <strong>{{setor_dados.nome}}</strong></td>
                    </tr>

                    </thead>
                </table>
            </div>
        </div>

        <div class="box  box-solid">
            <div class="box-header cabecalho with-border text-center">
                <h6 class="box-title text-center">PROFISSIONAIS</h6>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 text-left" style="padding-left: 1px">
                        <div class="legend">
                            <ul>
                                <li><i v-for="feriado in feriados_dados"><span
                                        ></span>{{feriado.data}} - {{feriado.descricao}}&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class=" col-md-6 text-right">
                        <div class="legend">
                            <ul>
                                <li><span
                                       ></span>F - FERIADO&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        style="background-color:#178D7B"></span>PLANTÃO&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        style="background-color:#db5461"></span>FÉRIAS/LICENÇA
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <span v-for="colaborador in colaboradores_dados">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="profissionais">
                        <tr>
                            <td colspan="3">PROFISSIONAL: <strong>{{colaborador.nome}}</strong></td>
                            <td colspan="3">CONSELHO: <strong>{{colaborador.numero_conselho}}</strong></td>
                            <td colspan="3">CONTATO: <strong>{{colaborador.fone_contato}}</strong></td>
                            <td colspan="3" class="text-right">HORÁRIO DE TRABALHO: <strong>{{colaborador.inicio_expediente}} às {{colaborador.fim_expediente}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="12" class="text-center"><strong>DATAS</strong></td>
                        </tr>
                        <tr>
                            <td colspan="12">
                                <div class="input-group col-md-12">
                                    <span class="button-checkbox input-group-btn" v-for="elemento in elementos">
                                        <button type="button"
                                                :class="'btn '+diaSelecionado(colaborador, elemento.dia)+' '+getFerias(elemento, colaborador.colaborador_id)+' '+elemento.status_feriado"
                                                :id="'b'+escala_dados.id+'/'+colaborador.colaborador_id+'/'+elemento.dia"
                                                data-color="primary"
                                                v-on:click="salvarDiaEscala(
                                                colaborador.colaborador_id,
                                                escala_dados.id,
                                                elemento.dia,
                                                elemento,
                                                'b'+escala_dados.id+'/'+colaborador.colaborador_id+'/'+elemento.dia
                                          )"
                                        >{{elemento.nome_dia}}
                                            <br>{{elemento.dia}} {{elemento.simbolo_f}}
                                        </button>
                                  <input type="checkbox" class="hidden"/>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        </thead>

                    </table>
                    </div>
                    <br>
                </span>

            </div>

        </div>

        <!--<div class="bottom-title text-right">-->
        <!--<strong>Total de Escalas:</strong> <span id="total-1-1">{{total_escalas}}</span>-->
        <!--</div>-->
    </div>


</template>

<script>
    export default {
        props: ["escala", "unidade", "setor", "cargo", "colaboradores", "licencas", "dias_edit", "feriados"],
        data() {
            return {
                unidade_dados: JSON.parse(this.unidade),
                dias_dados: JSON.parse(this.dias_edit),
                cargo_dados: JSON.parse(this.cargo),
                escala_dados: JSON.parse(this.escala),
                setor_dados: JSON.parse(this.setor),
                colaboradores_dados: JSON.parse(this.colaboradores),
                licencas_dados: JSON.parse(this.licencas),
                feriados_dados: JSON.parse(this.feriados),
                dias: [],
                dias_string: '',
                elementos: [],
                cor_selecionados: null,
                cont: 0,
                total_escalas: 0,
                texto_botao: 'Sair'
            }
        },
        methods: {
            getDiaSemana: function (dia, periodo) {
                var semana = ["DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB"];
                var data = dia + '/' + periodo;
                var arr = data.split("/").reverse();
                var teste = new Date(arr[0], arr[1] - 1, arr[2]);
                var dia = teste.getDay();
                return semana[dia];
            },
            salvarDiaEscala: function (colaborador_id, escala_id, dia, elemento, id_botao) {
                let botao = document.getElementById(id_botao);

                if (botao.classList.contains("disabled")) {
                    return true;
                }

                this.dias.push(dia);

                this.dias_string = this.dias.toString();

                var result;

                this.colaboradores_dados.map((item) => {
                    if (item.colaborador_id === colaborador_id) {

                        if (item.dias !== null) {
                            if (item.dias !== undefined) {
                                let menos = (dia - 1);
                                let mais = (dia + 1);

                                if (item.dias.indexOf(',' + mais + ',') !== -1 || item.dias.indexOf(',' + menos + ',') !== -1) {
                                    iziToast.show({
                                        title: 'Erro!',
                                        color: 'red', // blue, red, green, yellow
                                        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                                        message: 'Não é Possível Cadastrar dois Plantões Seguidos.'
                                    });

                                    result = true;

                                }
                            }


                        }

                    }

                });
                if (result) {
                    return true
                }

                this.colaboradores_dados = this.colaboradores_dados.map((item) => {
                    if (item.colaborador_id === colaborador_id) {
                        if (item.dias !== undefined) {
                            if (item.dias.indexOf(',' + dia + ',') !== -1) {
                                item.dias = item.dias.replace(',' + dia + ',', ',');
                            } else {
                                item.dias = item.dias + ',' + dia + ','
                            }
                        } else {
                            item.dias = item.dias + ',' + dia + ','
                        }

                        item.dias = item.dias.replace(',,', ',');
                        item.dias = item.dias.replace('undefined', ',');


                    }


                    return item
                });

                if (botao.classList.contains("selecionado")) {
                    botao.classList.remove("selecionado");
                    botao.classList.add("teste");
                } else {
                    botao.classList.remove("teste");
                    botao.classList.add("selecionado");
                }



                axios.post('/escala/salva-dia-escala', {
                    colaborador_id: colaborador_id,
                    escala_id: escala_id,
                    dia: this.colaboradores_dados
                })
                    .then((response) => {
                        if (response.data == 'erro_dia_outra_escala') {
                            iziToast.show({
                                title: 'Erro!',
                                color: 'red', // blue, red, green, yellow
                                position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                                message: 'Não é Possível Cadastrar dois Plantões Seguidos.'
                            });

                            botao.classList.remove("selecionado");
                            botao.classList.add("teste");

                            this.colaboradores_dados = this.colaboradores_dados.map((item) => {
                                if (item.colaborador_id === colaborador_id) {
                                    if (item.dias !== undefined) {
                                        if (item.dias.indexOf(',' + dia + ',') !== -1) {
                                            item.dias = item.dias.replace(',' + dia + ',', ',');
                                        } else {
                                            item.dias = item.dias + ',' + dia + ','
                                        }
                                    } else {
                                        item.dias = item.dias + ',' + dia + ','
                                    }

                                    item.dias = item.dias.replace(',,', ',');
                                    item.dias = item.dias.replace('undefined', ',');


                                }


                                return item
                            });

                            return true

                        } else {

                            iziToast.show({
                                title: 'Sucesso!',
                                color: 'green', // blue, red, green, yellow
                                position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                                message: 'Plantão Salvo com Sucesso.'
                            });


                        }


                    });
            },
            selecionados: function (dia) {
                if (this.dias_string.indexOf(dia) !== -1) {
                    return 'selecionado';
                } else {
                    return 'teste'
                }
            },
            getFerias: function (elemento, colaborador_id) {
                let result;
                if (elemento.licenca.length > 0) {
                    elemento.licenca.forEach((value) => {
                        if (value.colaborador_id === colaborador_id) {
                            result = "disabled"
                        }
                    });
                    return result
                }
            },


            quant_escalas: function () {

                this.total_escalas = this.colaboradores_dados.length;
            },

            diaSelecionado: function (colaborador, dia) {

                let cont = 0
                let result;
                $.each(colaborador.dias_selecionados, function (i, dado) {

                    if (Number(dado) === dia) {
                        result = "selecionado"
                    }

                    // obj[cont] = {'dia' : dado};
                    cont++
                });
                return result
            }

        },
        created: function () {


            var dias_mes = [];
            let ferias = [5, 6, 7, 8, 9];

            // console.log(this.licencas_dados)
            for (var i = 1; i <= this.escala_dados.quantidade_dias; i++) {

                let valor_ferias;
                let lf = [];
                let f = [];
                let status_feriado = null;
                let simbolo_f = null;

                ferias.includes(i) ? valor_ferias = 'disabled' : valor_ferias = 'teste';
                this.licencas_dados.forEach((value) => {

                    value.dias.forEach((v) => {
                        if (Number(v.dia) === i) {
                            lf.push({"colaborador_id": value.colaborador_id})
                        } else {
                        }
                    });


                });

                this.feriados_dados.forEach((value) => {

                        if (Number(value.dia) === i) {
                            f.push({
                                "descricao": value.descricao,
                                "dia": value.dia,
                                "data": value.data,
                            })
                            status_feriado = 'feriado'
                            simbolo_f = '- F'
                        } else {
                        }



                });
                dias_mes.push({
                    'nome_dia': this.getDiaSemana(i, this.escala_dados.periodo),
                    'dia': i,
                    'feriados': f,
                    'ferias': null,
                    'licenca': lf,
                    'profissional_id': null,
                    'status_feriado': status_feriado,
                    'simbolo_f': simbolo_f
                });

            }
            this.elementos = dias_mes;


            // more statements

            this.quant_escalas();


        },
    };
</script>
<style scoped>
    .cabecalho {
        background: #11785e;
        color: whitesmoke;
    }

    .profissionais {
        background: #EAF7F5;
        /*color: whitesmoke;*/
    }

    .selecionado {
        background: #178D7B;
        color: whitesmoke;
    }

    /*.feriado {*/
        /*background: #6192c2;*/
        /*color: whitesmoke;*/
    /*}*/

    .btn {
        padding: 6px 1px !important;
        font-size: 12px !important;
    }

    .disabled {
        background: #db5461;
        color: whitesmoke;
    }

    *:focus {
        outline: none !important;
    }

    .input-group-btn .btn {
        width: 100%;
    }

    :not(:first-child):not(:last-child).input-group-btn.button-checkbox .btn {
        border-radius: 0px;
    }

    .teste {
        background: #DDDDDD;
        color: #333333;
        font-weight: normal;
    }

    .legend {
        left: 80px;
        top: 10px;
        padding: 5px;

    }

    .legend h4 {
        margin: 0 0 10px;
        text-transform: uppercase;
        font-family: sans-serif;
        text-align: center;
    }

    .legend ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .legend li {
        padding-bottom: 5px;
    }

    .legend span {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin-right: 6px;
    }
</style>