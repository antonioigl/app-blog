import Vue from 'vue'
import VueRouter from "vue-router";
import HomeComponent from "./views/HomeComponent";
import AboutComponent from "./views/AboutComponent";
import NotFound from "./views/NotFound";
import ArticleIndex from "./views/ArticleIndex";

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', component: HomeComponent },
        { path: '/about', component: AboutComponent },
        { path: '/articles', component: ArticleIndex },
        { path: '*', component: NotFound },
    ]
});
