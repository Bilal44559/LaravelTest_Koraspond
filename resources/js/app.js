import { createApp } from "vue";
import { createRouter, createWebHashHistory } from "vue-router";
import { routes } from "./routes";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "toastr/build/toastr.min.css";
import "./style.css";

import App from "./Pages/app.vue";
let app = createApp(App);

const router = createRouter({
    history: createWebHashHistory(),
    routes: routes,
});

app.use(router);
app.mount("#app");
