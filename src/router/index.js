import { createRouter, createWebHistory } from 'vue-router';
import App from '../components/Dashboard.vue';
import AuthPage from '../components/AuthPage.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: App
  },
  {
    path: '/auth',
    name: 'Auth',
    component: AuthPage
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
