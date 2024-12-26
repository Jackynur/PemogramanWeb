import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import "@/assets/css/main.css";
import "@/assets/css/warehouse.css";
import "@/assets/css/form.css";
import "@fortawesome/fontawesome-free/css/all.css";

createApp(App).use(router).mount("#app");
