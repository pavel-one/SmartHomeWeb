import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

import route from 'ziggy-js';
import { Ziggy } from 'ziggy-js';

Vue.mixin({
    methods: {
        route: (name, params, absolute, config = Ziggy) => route(name, params, absolute, config),
    },
});
Vue.prototype.$route = (...args) => route(...args).url();

Vue.use(Buefy, plugin)
const el = document.getElementById('app')

import Layout from './Layout/default'
new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => import(`./Pages/${name}`)
                .then(({ default: page }) => {
                    page.layout = page.layout === undefined ? Layout : page.layout
                    return page
                }),
        },
    }),
}).$mount(el)
