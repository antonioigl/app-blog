import Vue from 'vue'
import VueRouter from "vue-router";
import HomeComponent from "./views/HomeComponent";
import AboutComponent from "./views/AboutComponent";
import NotFound from "./views/NotFound";
import ArticleIndex from "./views/ArticleIndex";
import MyArticles from "./views/MyArticles";
import ArticleShow from "./views/ArticleShow";
import ArticleCreate from "./views/ArticleCreate";

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', component: HomeComponent },
        { path: '/about', component: AboutComponent },
        { path: '/articles', component: ArticleIndex },
        { path: '/articles/create', component: ArticleCreate },
        { path: '/my_articles', component: MyArticles },
        { path: '/articles/:slug', component: ArticleShow, name: 'show' },
        { path: '*', component: NotFound },
    ]
});
