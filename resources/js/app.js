require('./bootstrap');
window.$ = window.jQuery = require("jquery");
window.Vue = require('vue');
window.Vuex = require("vuex");
window.swal = require("sweetalert");

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('formulario', require('./components/formulario/Formulario.vue').default);
Vue.component('box', require('./components/box/Box.vue').default);
Vue.component('dependentes', require('./components/wizards/Dependentes.vue').default);
Vue.component('upload-file', require('./components/upload-file/UploadFile.vue').default);
Vue.component('vue-mask', require('./components/v-mask/src/component.vue').default);
Vue.component('anexo', require('./components/anexo/Anexo.vue').default);
Vue.component('confirm', require('./components/confirm/Confirm.vue').default);
Vue.component('escala', require('./components/escala/Escala.vue').default);
Vue.component('escala-e', require('./components/escala/EscalaE.vue').default);
Vue.component('posto-trabalho', require('./components/wizards/PostoTrabalho.vue').default);
Vue.component('widget', require('./components/widgets/Widget.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = {
    state: {
        confirmAlertStatus: false,
        files: [],
    },

    getters: {
        getConfirmAlertStatus: state => {
            return state.confirmAlertStatus;
        },

    },
    mutations: {
        setConfirmAlertStatus(state, n) {
            state.confirmAlertStatus = n;
        },

    }
};

const app = new Vue({
    el: "#app",
    store: new Vuex.Store(store)
});

