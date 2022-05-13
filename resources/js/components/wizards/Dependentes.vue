<template>
    <span class="row" id="row-dependentes">

        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                <label class="labeltext">Tem Filhos Menores de 21 Anos?</label><br>
                <div class="form-check-inline">

                    <label class="radio-inline">
                        <input type="radio" name="filhos" value="0" v-model="radio" checked>Não
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="filhos" v-model="radio" value="1">Sim
                    </label>

                </div>
            </div>
        </div>

        <div class="row" v-show="radio === '1'">
            <legend class="no-border text-inverse" style="margin-left: 1rem">Adicionar Dependente</legend>

            <div :class="'form-group col-md-4 ' +status_nome">
                <label class="">Nome</label>
                <input type="text" name="nome_dependente" placeholder="Nome do Dependente" class="form-control"
                       maxlength="75"
                       v-model="novoDependente.nome">
            </div>

             <div :class="'form-group col-md-3 ' +status_data">
                    <label class="">Data de Nascimento</label><span class="text-red">*</span>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="data_nasc" class="form-control" id="datepicker-dependente"
                               v-mask='["##/##/####"]' placeholder="Informe a Data de Nascimento">
                    </div>
                    <span class="help-block"></span>
                </div>

            <div :class="'form-group col-md-3 ' +status_cpf">
                <label class="">CPF</label>
                <input type="text" name="cpf-dependente" placeholder="Informe o CPF" class="form-control"
                       v-model="novoDependente.cpf" v-mask="['###.###.###-##']">
            </div>
            <div class="form-group col-md-2 col-xs-12 text-right">
                <button style="margin-top: 2.5rem" class="btn btn-primary btn-md" @click="addDependente"><i
                        class="fa fa-plus-circle"></i> Adicionar</button>
            </div>
            <input type="hidden" name="dependentes-hidden" id="dependentes-hidden" value>

            <div class="col-md-12 table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th width="40%">Nome</th>
                    <th width="20%">Data de Nascimento</th>
                    <th width="20%">CPF</th>
                    <th>Anexar Documentos</th>
                    <th width="10%">Ação</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="dependente in dependentes" :key="dependente">
                    <td><span>{{dependente.nome}}</span></td>
                    <td><span>{{dependente.data_nasc}}</span></td>
                    <td><span>{{dependente.cpf}}</span></td>
                    <td><span>
                        <input multiple="multiple" :name="dependente.id+'[]'" type="file">
                    </span></td>
                    <td><a href="#" class="btn btn-danger btn-flat" v-on:click="removerDependente(dependente)">
                        <i class="fa fa-remove"></i> Remover</a></td>
                </tr>
                </tbody>
            </table>
                </div>
        </div>
    </span>
</template>
<script>
    export default {
        data() {
            return {
                status_nome: '',
                status_cpf: '',
                status_data: '',
                dados_input_hidden: '',
                dependentes: [],
                novoDependente: {
                    id: 0,
                    nome: '',
                    data_nasc: '',
                    cpf: ''
                },
                radio: 0
            };
        },

        methods: {
            addDependente: function (e) {
                let cpf_quant = this.novoDependente.cpf.length;
                let data = document.getElementById("datepicker-dependente");
                if (this.novoDependente.nome !== "") {
                    if (data.value !== "") {
                        if (this.novoDependente.cpf !== "" && cpf_quant === 14) {
                            this.novoDependente.id++;
                            e.preventDefault();
                            // let data = document.getElementById("datepicker-dependente");
                            this.novoDependente.data_nasc = data.value;
                            this.dependentes.push(this.novoDependente);
                            $('#dependentes-hidden').val(JSON.stringify(this.dependentes));
                            this.novoDependente = {id: this.novoDependente.id, nome: '', data_nasc: '', cpf: ''};
                            $('#datepicker-dependente').val('');
                            this.status_cpf = '';
                            this.status_nome = '';
                            this.status_data = '';
                        } else {
                            this.status_cpf = 'has-error';
                            swal("CPF é Obrigatório e Não Pode ser Menor que 11 Caracteres!", {
                                icon: 'error',
                                buttons: false,
                                timer: 3000,
                            });
                        }
                    } else {
                        this.status_data = 'has-error';
                        swal("O Campo Data de Nascimento do Dependente é Obrigatório!  ", {
                            icon: 'error',
                            buttons: false,
                            timer: 3000,
                        });
                    }
                } else {
                    this.status_nome = 'has-error';
                    swal("O Campo Nome do Dependente é Obrigatório!", {
                        icon: 'error',
                        buttons: false,
                        timer: 3000,
                    });


                }
            },
            removerDependente: function (dependente) {
                this.dependentes.splice(this.dependentes.indexOf(dependente))
            }
            ,
        }
    }
    ;

</script>