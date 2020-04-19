/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

Vue.use({
    install(Vue, options) {
        Vue.prototype.$localStorage = null;
        const ensureRefs = vm => {
            if (!vm.$firestore) {
                vm.$firestore = Object.create(null);
            }
        };

        function localStorageData(vm, obj) {
            //   var obj = { $localStorageDataInjection: "asdf" };
            // console.log(obj);
            var res = {};
            // console.log("setting up local storage", this);
            Object.keys(obj).forEach(key => {

                res[key] = {
                    get() {
                        // return vm.$localStorage[key];
                        var $default = JSON.stringify(vm.$localStorage[key]);
                        return JSON.parse(localStorage.getItem(vm.$options._componentTag + '-' + key) || $default);
                    },
                    set(value) {
                        vm.$localStorage[key] = value;
                        // vm.$set(obj, key, value);
                        // obj[key] = value;
                        localStorage.setItem(vm.$options._componentTag + '-' + key, JSON.stringify(value))
                    }
                };
            });

            return res;
        }

        Vue.mixin({
            beforeCreate() {
                let bindings = this.$options.localStorage;
                if (typeof bindings === 'function') bindings = bindings.call(this);
                if (!bindings) return;
                ensureRefs(this);
                // for (const key in bindings) {
                //     console.log(this, key, bindings[key]);
                // }
                this.$options.computed = Object.assign(this.$options.computed, {
                    ...localStorageData(this, bindings)
                })
                console.log(this.$options)

                this.$localStorage = new Vue({
                    data() {
                        return bindings;
                    },
                })

            },
        });
    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "vue-csv-uploader",
    require("./components/CSVUploader.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

const darkButton = document.getElementById("dark");
const lightButton = document.getElementById("light");
const solarButton = document.getElementById("solar");
const solarDarkButton = document.getElementById("solarDark");

function themeSetter(t) {
    document.body.classList.remove("light", "dark", "solar", "solarDark");
    document.body.classList.add(t);
    localStorage.setItem("theme", t);
}

(function () {
    const theme = localStorage.getItem("theme") || "light";
    themeSetter(theme);
})();

darkButton.onclick = e => {
    e.preventDefault();
    themeSetter("dark");
};

lightButton.onclick = e => {
    e.preventDefault();
    themeSetter("light");
};

solarButton.onclick = e => {
    e.preventDefault();
    themeSetter("solar");
};

solarDarkButton.onclick = e => {
    e.preventDefault();
    themeSetter("solarDark");
};
