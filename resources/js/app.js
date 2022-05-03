/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import "./css/hover.css";
import "./css/main.css";
import { library } from '@fortawesome/fontawesome-svg-core';
import { faHeart,faSearch,faShoppingCart,faBars,faTimes,
        faFilter,faPlus,faMinus,faGreaterThan,faLessThan,
        faExpand,faUpRightAndDownLeftFromCenter,faMapMarkerAlt,
        faPhone,faSquareEnvelope,faLock,faUser,faEye,faEdit,faTrash,faNoteSticky
    }
         from '@fortawesome/free-solid-svg-icons';
import {faFacebook,faPinterest,faInstagram} 
            from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import router from "./router/router";
import VueRouter from 'vue-router';
import Fragment from 'vue-fragment';
import Vuex from 'vuex';
import state from "./store/state";
import mutations from "./store/mutations";
import getters from "./store/getters";
import actions from "./store/actions";
import VueSweetalert2 from 'vue-sweetalert2';
import * as VueGoogleMaps from 'vue2-google-maps'
import Toasted from "vue-toasted";
import VueFileAgent from "vue-file-agent";
import Paginate from 'vuejs-paginate';
import Flutterwave from 'vue-flutterwave';


import 'animate.css';
import 'floating-vue/dist/style.css'
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-file-agent/dist/vue-file-agent.css';

import Vue from "vue";

library.add(faHeart,faSearch,faShoppingCart,faBars,faTimes,faFilter,faPlus,
            faMinus,faGreaterThan,faLessThan,faExpand,faUpRightAndDownLeftFromCenter,
            faMapMarkerAlt,faPhone,faSquareEnvelope,faLock,faUser,faEye,faEdit,faTrash,
            faFacebook,faInstagram,faPinterest,faNoteSticky
            );


window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.use(Fragment.Plugin);
Vue.use(Vuex);
Vue.use(VueSweetalert2);
let toastoption = {
    position:'top-right',
    duration:'3000'
}
Vue.use(Toasted,toastoption);
Vue.use(VueFileAgent);
Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyBPF6T9Hr0d8gMMRyFeCMhTFFExTJumQRc',
      libraries: 'places'
    }
  })
Vue.use(Flutterwave, { publicKey: 'FLWPUBK_TEST-3b83d1c7a02f28b84261eb9a4e925fe0-X' })
Vue.component('font-awesome-icon', FontAwesomeIcon);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('App', require('./components/App.vue').default);
Vue.component('paginate', Paginate);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
let store = new Vuex.Store({
    state:{...state},
    mutations:{
        ...mutations
    },
    getters:{
        ...getters
    },
    actions:{
        ...actions
    }
})
const app = new Vue({
    el: '#app',
    router,
    store
});
