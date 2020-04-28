module.exports = {
    install(Vue, options) {
        Vue.prototype.$localStorage = null;
        const ensureRefs = vm => {
            if (!vm.$firestore) {
                vm.$firestore = Object.create(null);
            }
        };

        function localStorageData(vm, obj) {
            var res = {};
            Object.keys(obj).forEach(key => {

                res[key] = {
                    get() {
                        var $default = JSON.stringify(vm.$localStorage[key]);
                        return JSON.parse(localStorage.getItem(vm.$options._componentTag + '-' + key) || $default);
                    },
                    set(value) {
                        vm.$localStorage[key] = value;
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
}