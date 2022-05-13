<!--
	EXEMPLO

<formulario
		validate="true"
		redirect="true"
		rota-redirect="{{route('admin.admissao.index')}}"
		enc-type="multipart/form-data"
		id-form="form-exemple"
		icon-botao='fa fa-save'
		cor-botao="primary"
		acao="{{route('admin.admissao.store')}}"
		metodo="post"
		nome-botao="Salvar"
		id-botao="btn-salvar"
		nome-botao-desabilitado="Cadastrando">
	{{csrf_field()}}

	<div class="row">

		<div class="form-group col-md-12" id="validar-nome">
			{!! Form::label('nome', 'Nome da Agenda') !!}
			{!! Form::text('nome', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'nome']) !!}
			<span id="error-nome"></span>
		</div>

		<div class="form-group col-md-12" id="validar-ano">
			{!! Form::label('ano', 'Ano') !!}
			{!! Form::number('ano', null, ['class' => 'form-control trigger', 'data-parsley-required' => 'true', 'id' => 'ano']) !!}
			<span id="error-ano"></span>
		</div>


	</div>
</formulario>
-->


<template>
    <div>
        <form :id="this.id" :enctype="this.enctype" data-parsley-validate="true">
            <slot></slot>
            <button
                    v-if="idBotao"
                    :id="idBotao"
                    type="button"
                    @click="enviar"
                    :style="styleBotao"
                    :class="'pull-right btn btn-'+cor"
            >
                <i v-if="iconBotao" :class="iconBotao"></i>
                {{ nome }}
            </button>
            <slot name="btn-secondary"></slot>
        </form>
    </div>
</template>

<style scoped>
</style>
<script>

    import {mask} from "vue-the-mask";

    export default {
        props: [
            "styleBotao",
            "metodo",
            "acao",
            "nome-botao",
            "id-botao",
            "cor-botao",
            "id-form",
            "enc-type",
            "redirect",
            "rota-redirect",
            "validate",
            "icon-botao",
            "nome-botao-desabilitado",
            "modal-tabela",
            "modal-to-close"
        ],
        directives: {
            mask
        },
        data: function () {
            return {
                requisicao: this.metodo,
                rota: this.acao,
                nome: this.nomeBotao,
                cor: this.corBotao,
                id: this.idForm,
                enctype: this.encType,
                idButton: this.idBotao,
                nomeDesabilitado: this.nomeBotaoDesabilitado
            };
        },

        methods: {
            invalidar: function (errors) {
                function formGroupEvento(id) {
                    let form_group = document.getElementById("validar-" + id);
                    form_group.classList.remove("has-error");
                }

                if (this.validate) {
                    for (var erro in errors) {
                        var input = document.getElementById(erro);
                        let form_group = document.getElementById("validar-" + erro);

                        input.classList.add("parsley-error");
                        form_group.classList.add("has-error");
                        this.adicionarMensagemError(input, errors[erro][0]);
                        input.classList.remove("trigger");
                        input.addEventListener("blur", function () {
                            formGroupEvento(this.id);
                            this.classList.remove("parsley-error");
                            this.classList.add("trigger");

                            let label = document.querySelectorAll(
                                "[for='" + this.id + "']"
                            );
                            let divMsg = document.getElementById(
                                "error-" + this.id
                            );

                            if (label.length > 0) {
                                label[0].classList.remove("error");
                            }

                            if (divMsg) {
                                divMsg.innerHTML = "";
                            }
                        });
                    }
                    this.validar();
                }
            },

            validar: function () {
                let success = $("#" + this.id).find(".trigger");
                let array = [];
                console.log(success);
                for (var i = 0; i < success.length; i++) {
                    if (success[i].nodeName == "LABEL") {
                        array.push(success[i]);
                    }
                }

                for (var j = 0; j < array.length; j++) {
                    array[j].classList.add("success");
                    array[j].classList.remove("trigger");
                }

                for (var i = 0; i < success.length; i++) {
                    let input;
                    let form_group;
                    if (success[i].type != undefined) {
                        input = document.getElementById(success[i].id);
                        form_group = document.getElementById(
                            "validar-" + success[i].id
                        );
                        console.log(form_group);

                        this.removerMensagemError(input);

                        setTimeout(function () {
                            $(".trigger")
                                .addClass("parsley-success")
                                .removeClass("trigger");

                            console.log(form_group);
                            form_group.classList.add("has-success");
                            let label = document.querySelectorAll(
                                "[for='" + input.id + "']"
                            );
                            if (label.length > 0) {
                                label[0].classList.add("success");
                            }

                            input.addEventListener("blur", function () {
                                input.classList.add("trigger");
                                input.classList.remove("parsley-success");

                                let label = document.querySelectorAll(
                                    "[for='" + input.id + "']"
                                );
                                if (label.length > 0) {
                                    label[0].classList.remove("success");
                                }
                            });
                        }, 5);
                    } else {
                        success[i].classList.add("success");
                        form_group = document.getElementById(
                            "validar-" + success[i].id
                        );
                        form_group.classList.add("has-success");
                        success[i].classList.remove("trigger");
                    }
                }
            },
            removerBordasAll: function () {
                this.limparTudo();
            },

            enviar: function (e) {
                e.preventDefault();

                var form = document.getElementById(this.id);

                if (this.requisicao == "post") {
                    var formData = new FormData(form);
                    var files = this.$store.state.files;
                    files.forEach(file => {
                        formData.append("files[]", file);
                    });
                } else {
                    var formData = $("#" + this.id).serialize();
                }

                if (!this.modalTabela) {
                    this.desabilitarBotao();
                    this.metodos(formData, form);
                } else {
                    this.modal(formData, form);
                }
            },

            adicionarMensagemError: function (input, mensagem) {
                let id = "error-" + input.id;
                let span = document.getElementById(id);

                if (span) {
                    span.style.display = "block";

                    var label = document.querySelectorAll(
                        "[for='" + input.id + "']"
                    );
                    if (label.length > 0) {
                        label[0].classList.add("help-block");
                    }

                    span.innerHTML =
                        "<span class='help-block'>" + mensagem + "</span>";
                }
            },

            removerMensagemError: function (input) {
                let divMsg = document.getElementById("error-" + input.id);
                let label = document.querySelectorAll("[for='" + input.id + "']");

                if (divMsg) {
                    divMsg.style.display = "none";
                }

                if (label.length > 0) {
                    label[0].classList.remove("error");
                }
            },

            inputs: function () {
                var inputs = document.querySelectorAll(
                    '[data-parsley-required="true"]'
                );

                return inputs;
            },

            limpar: function (input) {
                document
                    .querySelectorAll("[for='" + input.id + "']")[0]
                    .classList.remove("error");
                document
                    .querySelectorAll("[for='" + input.id + "']")[0]
                    .classList.remove("success");
                document.getElementById("error-" + input.id).innerHTML = "";
                input.classList.remove("parsley-success");
                input.classList.remove("parsley-error");
                input.classList.add("trigger");
            },

            limparTudo: function () {
                let labels = document.querySelectorAll("[class='success']");
                let inputs = document.getElementsByClassName("parsley-success");

                for (let i = 0; i < labels.length; i++) {
                    labels[i].classList.add("trigger");
                    labels[i].classList.remove("success");
                }

                for (let j = 0; j < inputs.length; j++) {
                    $(".parsley-success")
                        .removeClass("parsley-success")
                        .addClass("trigger");
                }
            },

            metodos: function (formData, form) {
                switch (this.requisicao) {
                    case "post":
                        this.post(formData, form);
                        break;
                    case "get":
                        this.get(formData);
                        break;
                    case "put":
                        this.put(formData);
                        break;
                    case "delete":
                        this.delete();
                        break;
                }
            },

            criarInput: function (metodo) {
                var method = document.createElement("input");
                method.type = "hidden";
                method.name = "_method";
                method.value = metodo;
                var t = document.getElementById(this.id);
                t.appendChild(method);
            },

            post: function (formData, form) {
                axios
                    .post(this.rota, formData)
                    .then(response => {
                        this.abilitarBotao();
                        this.redirecionar(response);
                        setTimeout(() => {
                            this.removerBordasAll();
                        }, 50);
                    })
                    .catch(error => {
                        this.abilitarBotao();
                        if (error.response != undefined) {
                            if (error.response.status == 422) {
                                swal('Ops!', 'Possui campos inválidos', 'error');
                            } else if (error.response.data) {
                                swal('Ops!', error.response.data.message, 'error');
                            } else {
                                swal('Ops!', 'Ocorreu um erro', 'error');
                            }
                            this.invalidar(error.response.data.errors);
                        }
                    });
            },

            get: function (formData) {
                axios
                    .get(this.rota, formData)
                    .then(response => {
                        this.abilitarBotao();
                    })
                    .catch(error => {
                        this.abilitarBotao();
                        swal("Ops!", error.response.data.message, "error");
                    });
            },

            put: function (formData) {
                axios
                    .put(this.rota, formData)
                    .then(response => {
                        this.abilitarBotao();
                        this.redirecionar(response);
                        setTimeout(() => {
                            this.removerBordasAll();
                        }, 50);
                    })
                    .catch(error => {
                        if (error.response != undefined) {
                            this.abilitarBotao();
                            if (error.response.status == 422) {
                                swal('Ops!', 'Possui campos inválidos', 'error');
                            } else if (error.response.data) {
                                swal('Ops!', error.response.data.message, 'error');
                            } else {
                                swal('Ops!', 'Ocorreu um erro', 'error');
                            }

                            this.invalidar(error.response.data.errors);
                        }
                    });
            },

            delete: function () {
                axios
                    .delete(this.rota)
                    .then(response => {
                        this.abilitarBotao();
                        this.redirecionar(response);
                    })
                    .catch(error => {
                        this.abilitarBotao();
                        swal("Ops!", error.response.data.message, "error");
                    });
            },

            redirecionar: function (response) {
                swal({
                    title: "Sucesso!",
                    text: response.data.message,
                    icon: "success",
                    button: true,
                    dangerMode: false,
                })
                    .then(() => {
                            if (this.redirect == "true") {
                                window.location.href = this.rotaRedirect;
                            } else if (this.modalToClose !== undefined) {
                                $('#' + this.modalToClose).modal('hide');
                            }
                        }
                    );
            },

            desabilitarBotao: function () {
                let botao = document.getElementById(this.idButton);
                botao.innerHTML = this.nomeDesabilitado;
                botao.setAttribute("disabled", "true");
            },

            abilitarBotao: function () {
                let botao = document.getElementById(this.idButton);
                botao.innerHTML = this.nome;
                botao.removeAttribute("disabled");
            }
        }
        ,

        mounted: function () {
            $("#formulario").html(this.formulario);
            var inputs = this.inputs();
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].classList.add("trigger");
            }
            if (this.requisicao == "put") {
                this.criarInput("PUT");
            } else if (this.requisicao == "delete") {
                this.criarInput("DELETE");
            } else if (this.requisicao == "patch") {
                this.criarInput("PATCH");
            }
        }
    }
    ;
</script>
