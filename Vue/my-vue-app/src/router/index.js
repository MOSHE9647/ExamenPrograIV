import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';  // Asegúrate de que la ruta sea correcta aquí
import Usuarios from '../views/Usuarios.vue';
import UsuarioDetail from '../views/UsuarioDetail.vue';
import CreateUsuario from '../views/CreateUsuario.vue';
import UpdateUsuario from '../views/UpdateUsuario.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    { 
      path: '/vue',
      name: 'Usuarios',
      component: Usuarios
    },
    {
      path: '/vue/usuarios/:id',
      name: 'UsuarioDetail',
      component: UsuarioDetail
    },
    {
      path: '/vue/create',
      name: 'CreateUsuario',
      component: CreateUsuario
    },
    {
      path: '/vue/update/:id',
      name: 'UpdateUsuario',
      component: UpdateUsuario
    },
    {
      path: '/:catchAll(.*)',
      redirect: '/'
    }
  ]
});

export default router;
