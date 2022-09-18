import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import MyHomepage from './pages/MyHomepage.vue';
import MyAbout from './pages/MyAbout.vue';
import NotFound from './pages/NotFound.vue';
import MyBlog from './pages/MyBlog.vue';
import SinglePost from './pages/SinglePost.vue'
import ContactUs from './pages/ContactUs.vue'




const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: MyHomepage
        },
        {
            path: '/about',
            name: 'about',
            component: MyAbout
        },
        {
            path: '/blog',
            name: 'blog',
            component: MyBlog
        },
        {
            path: '/blog/:slug',
            name: 'single-post',
            component: SinglePost
        },
        {
            path: '/contact',
            name: 'contact',
            component: ContactUs
        },
        {
            path: '/*',
            name: 'not-found',
            component: NotFound
        }
    ],
  });

  export default router;