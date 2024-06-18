<template>
  <div class="container mt-5">
    <h1>Crear Usuario</h1>
    <form @submit.prevent="createUsuario">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" v-model="usuario.nombre" class="form-control" id="nombre" required>
      </div>
      <button type="submit" class="btn btn-success">Crear</button>
    </form>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  name: 'CreateUsuarioForm',
  data() {
    return {
      usuario: {
        nombre: ''
      }
    };
  },
  methods: {
    async createUsuario() {
      try {
        await api.createUsuario(this.usuario);
        this.$router.push('/vue');
      } catch (error) {
        console.error('Error creating usuario:', error);
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
