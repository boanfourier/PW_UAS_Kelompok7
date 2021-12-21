import Vue from "vue";
import VueRouter from "vue-router";

import About from "./views/About.vue";
import Beranda from "./views/Beranda.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Admin from "./views/admin/Dashboard.vue";
import Postingan from "./views/admin/Postingan.vue";
import Komentar from "./views/admin/Komentar.vue";
import User from "./views/admin/User.vue";
import EditUser from "./views/admin/EditUser.vue";
import UserAkun from "./views/user/UserAkun.vue";

//User
import BerandaUser from "./views/user/Beranda.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Beranda,
        },
        {
            path: "/about",
            name: "about",
            component: About,
        },
        {
            path: "/beranda",
            name: "beranda",
            component: Beranda,
        },
        {
            path: "/login",
            name: "login",
            component: Login,
        },
        {
            path: "/register",
            name: "register",
            component: Register,
        },
        {
            path: "/admin",
            name: "admin",
            component: Admin,
        },
        {
            path: "/postingan",
            name: "postingan",
            component: Postingan,
        },
        {
            path: "/komentar",
            name: "komentar",
            component: Komentar,
        },
        {
            path: "/user",
            name: "user",
            component: User,
        },
        {
            path: "/berandauser",
            name: "berandauser",
            component: BerandaUser,
        },
        {
            path: "/edituser/:id",
            name: "edituser",
            component: EditUser,
        },
        {
            path: "/userakun",
            name: "userakun",
            component: UserAkun,
        },
    ],
});

export default router;
