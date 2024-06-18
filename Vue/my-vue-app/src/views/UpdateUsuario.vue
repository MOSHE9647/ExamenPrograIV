<template>
  <div class="container mt-5">
    <h1>Actualizar Usuario</h1>
    <form @submit.prevent="updateUsuario">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" v-model="usuario.nombre" class="form-control" id="nombre" required>
      </div>
      <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  name: 'UpdateUsuarioForm',
  data() {
    return {
      usuario: {}
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
    },
    async updateUsuario() {
      try {
        await api.updateUsuario(this.$route.params.id, this.usuario);
        this.$router.push('/vue');
      } catch (error) {
        console.error('Error updating usuario:', error);
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
