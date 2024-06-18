<template>
  <div class="container mt-5">
    <h1>Detalles del Usuario</h1>
    <div v-if="usuario">
      <p><strong>ID:</strong> {{ usuario.id }}</p>
      <p><strong>Nombre:</strong> {{ usuario.nombre }}</p>
    </div>
    <router-link to="/vue" class="btn btn-primary">Volver</router-link>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  name: 'UsuarioDetail',
  data() {
    return {
      usuario: null
    };
  },
  created() {
    this.fetchUsuario();
  },
  methods: {
    async fetchUsuario() {
      try {
        const response = await api.getUsuario(this.$route.params.id);
        this.usuario = response.data;
      } catch (error) {
        console.error('Error fetching usuario:', error);
      }
    }
  }
};
</script>

<style>
.container {
  max-width: 500px;
}
</style>
