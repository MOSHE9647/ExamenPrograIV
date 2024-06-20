<template>
  <div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Usuarios</h1>
    <div class="row">
      <router-link to="/vue/create" class="btn btn-primary">Añadir</router-link>
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>N° Cédula</th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Correo</th>
              <th>Tipo</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="usuario in usuarios" :key="usuario.id">
              <td>{{ usuario.id }}</td>
              <td>{{ usuario.cedula }}</td>
              <td>{{ usuario.nombre }} {{ usuario.apellido }}</td>
              <td>{{ usuario.telefono }}</td>
              <td>{{ usuario.email }}</td>
              <td>{{ usuario.tipo }}</td>
              <td>{{ usuario.estado ? 'Activo' : 'Inactivo' }}</td>
              <td>
                <router-link :to="`/vue/usuarios/${usuario.id}`" class="btn btn-info btn-sm mr-2">
                  <i class="las la-info-circle"></i>
                </router-link>
                <router-link :to="`/vue/update/${usuario.id}`" class="btn btn-warning btn-sm mr-2">
                  <i class="las la-user-edit"></i>
                </router-link>
                <button @click="deleteUsuario(usuario.id)" class="btn btn-danger btn-sm">
                  <i class="las la-trash-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
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
        this.usuarios = response.data.data.data;
        console.log(response.data.data.data);
      } catch (error) {
        console.error('Error fetching usuarios:', error);
      }
    },
    async deleteUsuario(id) {
      try {
        await api.deleteUsuarioFisico(id);
        // Actualiza la lista de usuarios después de eliminar
        this.usuarios = this.usuarios.filter(usuario => usuario.id !== id);
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
