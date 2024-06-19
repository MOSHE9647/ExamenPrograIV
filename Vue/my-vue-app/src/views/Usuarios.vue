<template>
  <div class="container mt-5">
    <h1>Usuarios</h1>
    <router-link to="/vue/create" class="btn btn-success mb-3">Crear Usuario</router-link>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usuario in usuarios" :key="usuario.id">
          <td>{{ usuario.id }}</td>
          <td>{{ usuario.nombre }}</td>
          <td>
            <router-link :to="`/vue/usuarios/${usuario.id}`" class="btn btn-info">Ver</router-link>
            <router-link :to="`/vue/update/${usuario.id}`" class="btn btn-warning">Actualizar</router-link>
            <button @click="deleteUsuario(usuario.id)" class="btn btn-danger">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  name: 'UsuariosList',
  data() {
    return {
      usuarios: []
    };
  },
  created() {
    this.fetchUsuarios();
  },
  methods: {
    async fetchUsuarios() {
      try {
        const response = await api.getUsuarios();
        this.usuarios = response.data;
      } catch (error) {
        console.error('Error fetching usuarios:', error);
      }
    },
    async deleteUsuario(id) {
      try {
        await api.deleteUsuarioFisico(id);
        this.fetchUsuarios(); // Refresh the list after deletion
      } catch (error) {
        console.error('Error deleting usuario:', error);
      }
    }
  }
};
</script>

<style>
.container {
  max-width: 800px;
}
</style>
