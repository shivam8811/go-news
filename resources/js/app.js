import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h } from 'vue';
import { createPinia } from 'pinia';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Layout from '@/Layouts/Layout.vue';

import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';

import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import BaseButtonComponent from '@/Components/UI/BaseButtonComponent.vue';
import BaseCardComponent from '@/Components/UI/BaseCardComponent.vue';

const vuetify = createVuetify({
    components,
    directives,
});

const pinia = createPinia();
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || Layout
        return page
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(pinia)
            .use(ZiggyVue)
            .component('BaseButtonComponent', BaseButtonComponent)
            .component('BaseCardComponent', BaseCardComponent)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
