require('./bootstrap');

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

// Import modules...
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import { Multiselect } from 'vue-multiselect';

import VueGeolocation from "vue3-geolocation";
import GMaps from "vuejs3-google-maps";

/* import GMaps from "../js/gmaps/gmaps"; */



const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .component('multiselect', Multiselect)
            .use(VueGeolocation)
            .use(GMaps, {
                load: {
                    apiKey: "AIzaSyDszgZC2TR3trCXgf_UzckjbK84mT7GWy4",
                    libraries: ["places"],
                },
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
