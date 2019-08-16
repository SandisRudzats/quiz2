import Vue from 'vue';

//Import quiz component
Vue.component('quiz', require ('./vue-components/quiz/components/main.vue').default);

new Vue ({
   el:'#app',
});