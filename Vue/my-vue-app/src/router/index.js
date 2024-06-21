import { createRouter, createWebHistory } from 'vue-router';
import Usuarios from '../views/Usuarios.vue';
import Home from '@/views/Home.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'HomeView',
      component: Home
    },
    { 
      path: '/vue',
      name: 'Usuarios',
      component: Usuarios
    },
    {
      path: '/:catchAll(.*)',
      redirect: '/'
    }
  ]
});

export default router;
