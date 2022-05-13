<template>
    <span class="row" id="row-dependentes">

        <div class="row">
            <slot></slot>
            <div class="form-group col-md-2 col-xs-12 text-right">
                <button style="margin-top: 2.5rem" class="btn btn-primary btn-md" @click="addDependente"><i
                        class="fa fa-plus-circle"></i> Adicionar</button>
            </div>
            <input type="hidden" name="postos-hidden" id="postos-hidden" value>

            <div class="col-md-12 table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="40%">UNIDADE</th>
                        <th width="40%">SETOR</th>
                        <th width="10%">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="dependente in dependentes" :key="dependente">
                        <td><span>{{dependente.unidade}}</span></td>
                        <td><span>{{dependente.setor}}</span></td>
                        <td><a href="#" class="btn btn-danger btn-flat" v-on:click="removerPosto(dependente)">
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
                dados_input_hidden: '',
                dependentes: [],
                novoDependente: {
                    id: 0,
                    unidade: '',
                    setor: ''
                },
            };
        },

        methods: {
            addDependente: function (e) {
                e.preventDefault();
                let setor_text = $('#setor2 option:selected').text();
                let unidade_text = $('#unidade2 option:selected').text();
                let setor_id = document.getElementById("setor2");

                this.novoDependente.id = setor_id.value;
                this.novoDependente.unidade = unidade_text;
                this.novoDependente.setor = setor_text;

                if (this.novoDependente.unidade === "") {
                    $('#validar-unidade2').addClass('has-error');
                    swal("O campo Unidade é Obrigatório!", {
                        icon: 'error',
                        buttons: false,
                        timer: 3000,
                    });
                    return false
                }

                if ((this.novoDependente.setor === "")) {
                    $('#validar-setor2').addClass('has-error');
                    swal("O campo Setor é Obrigatório!", {
                        icon: 'error',
                        buttons: false,
                        timer: 3000,
                    });
                    return false
                }

                this.dependentes.push(this.novoDependente);
                console.log(this.novoDependente);
                $('#postos-hidden').val(JSON.stringify(this.dependentes));
                this.novoDependente = {id: this.novoDependente.id, unidade: '', setor: ''};

                $('#validar-unidade2').removeClass('has-error');
                $('#validar-setor2').removeClass('has-error');

            },

            removerPosto: function (dependente) {
                console.log(dependente);
                this.dependentes.splice(this.dependentes.indexOf(dependente))
                $('#postos-hidden').val(JSON.stringify(this.dependentes));
            }
        }

    }
</script>