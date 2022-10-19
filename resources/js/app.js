import './MyJs/bootstrap';
import './MyJs/config';
import './MyJs/helpers';
import './MyJs/menu';
// import './MyJs/main';
// import './MyJs/dashboards-analytics';
import './MyJs/apexcharts';
import './MyJs/perfect-scrollbar';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// Set jQuery
global.jQuery = require('jquery');
const $ = global.jQuery;
window.$ = $;

InertiaProgress.init();

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Toast, {
        timeout: 3000,
        transition: "Vue-Toastification__bounce",
        maxToasts: 2,
        icon: true,
        hideProgressBar: false,
        pauseOnHover: false,
      })
      .use(VueSweetalert2)
      .mixin({ methods: { route } })
      .mount(el)
  },
});