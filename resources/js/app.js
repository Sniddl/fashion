/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

// Allow components to quickly save to local storage.
Vue.use(require('./vueLocalStorage'));

// Auto register vue components.
require('./autoRegister');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    data: {
        testing: true,
    }
});


const buttonIds = ["dark", "light", "color", "solar", "solarDark"];

function themeSetter(t) {
    document.body.classList.remove(...buttonIds);
    document.body.classList.add(t);
    localStorage.setItem("theme", t);
}


buttonIds.map(id => {
    var btn = document.getElementById(id);
    if (btn) {
        btn.addEventListener('click', e => {
            e.preventDefault();
            themeSetter(id);
        })
    }
});

(function () {
    const theme = localStorage.getItem("theme") || "light";
    themeSetter(theme);
})();

