import { createRouter, createWebHistory } from "vue-router";
import Warehouse from "../views/warehouse.vue";
import Home from "../views/Home.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: "/kategoris",
    name: "kategoris.index",
    component: () => import("../views/kategoris/index.vue"),
  },
  {
    path: "/kategoris/create",
    name: "kategoris.create",
    component: () => import("../views/kategoris/create.vue"),
  },
  {
    path: "/kategoris/:id/edit",
    name: "kategoris.edit",
    component: () => import("../views/kategoris/edit.vue"),
  },
  {
    path: "/sampahs",
    name: "sampahs.index",
    component: () => import("../views/sampahs/index.vue"),
  },
  {
    path: "/sampahs/create",
    name: "sampahs.create",
    component: () => import("../views/sampahs/create.vue"),
  },
  {
    path: "/sampahs/:id/edit",
    name: "sampahs.edit",
    component: () => import("../views/sampahs/edit.vue"),
    props: true,
  },
  {
    path: "/warehouse",
    name: "warehouse",
    component: Warehouse,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
