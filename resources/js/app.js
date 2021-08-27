require('./bootstrap');



import Vue from 'vue'
import Vuex from 'vuex'
import 'es6-promise/auto'

// window.Vue = require('vue').default;
window.Vue = new Vue()

Vue.use(Vuex)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const store = new Vuex.Store({
    state:{
        item:{}
    },
    mutations:{
        setItem(state,obj){
            state.item = obj;
        }
    }
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('formulario', require('./components/Formulario.vue').default);
Vue.component('tabela-lista', require('./components/TabelaLista.vue').default);
Vue.component('modal', require('./components/modal/Modal.vue').default);
Vue.component('modallink', require('./components/modal/ModalLink.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
