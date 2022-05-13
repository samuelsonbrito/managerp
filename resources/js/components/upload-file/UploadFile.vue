<template>
        <div class="row">
            <legend class="no-border text-inverse" style="margin-left: 1rem">Adicionar Anexos</legend>

            <div class="form-group col-md-4">
                <label class="">Nome do Documento</label><span class="text-red">*</span>
                <input type="text" name="nome_dependente" placeholder="Nome do Dependente" class="form-control"
                       v-model="novaTarefa.nome">
            </div>

            <div class="form-group col-md-6">
                <label class="">Adicionar Observação</label>
                <input type="text" name="observacao" class="form-control" v-model="novaTarefa.observacao">
            </div>
            <div class="form-group col-md-2">
                <button style="margin-top: 2.5rem" class="btn btn-primary btn-flat" @click="addTarefa"><i
                        class="fa fa-plus-circle"></i> Adcionar</button>
            </div>
            <div class="col-md-12 table-responsive">
            <table class="table table-striped table-bordered" style="width: 100rem; margin-left: 0.5rem">
                <thead>
                <tr>
                    <th width="20%">Nome</th>
                    <th width="50%">Observação</th>
                    <th>Anexar Documentos</th>
                    <th width="10%">Ação</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="tarefa in tarefas" :key="tarefa">
                    <td><span>{{tarefa.nome}}</span></td>
                    <td><span>{{tarefa.observacao}}</span></td>
                    <td><span>
                        <input multiple="multiple" :name="tarefa.nome-+'photos[]'" type="file">
                    </span></td>
                    <td><a href="#" class="btn btn-danger btn-flat" v-on:click="removerTarefa(tarefa)"><i
                            class="fa fa-remove"></i> Remover</a></td>
                </tr>
                </tbody>
            </table>
                </div>
        </div>

</template>
<script>
    export default {
        data() {
            return {
                tarefas: [],
                novaTarefa: {
                    nome: '',
                    data_nasc: '',
                    cpf: '',
                },
                radio: ''
            };
        },

        methods: {
            addTarefa: function (e) {
                e.preventDefault();

                this.tarefas.push(this.novaTarefa);
                this.novaTarefa = {nome: '', data_nasc: '', cpf: ''};
            },
            removerTarefa: function (tarefa) {
                this.tarefas.splice(this.tarefas.indexOf(tarefa))
            },
            watch: {
                radio(val) {
                    console.log(val)
                },
            }
        }
    };


</script>