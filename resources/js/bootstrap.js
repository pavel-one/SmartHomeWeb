import { App, plugin } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import Vue from 'vue'
import VueMeta from 'vue-meta'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
const axios = require('axios').default;

import route from 'ziggy-js';

Vue.use(VueMeta, {
    // optional pluginOptions
    refreshOnceOnNavigation: true
})
Vue.use(plugin)
Vue.use(Buefy)
InertiaProgress.init()
const el = document.getElementById('app')

Vue.mixin({
    methods: {
        route: (name, params, absolute, config = Ziggy) => route(name, params, absolute, config),
    },
});
Vue.prototype.$route = (...args) => route(...args).url();
Vue.prototype.$http = axios;

import Layout from './Layout/default'
new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => import(`./Pages/${name}`)
                .then(({ default: page }) => {
                    // page.layout = page.layout === undefined ? Layout : page.layout
                    return page
                }),
        },
    }),
}).$mount(el)
