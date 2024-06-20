<template>
  <div class="container mt-5">
    <h1>Crear Usuario</h1>
    <form @submit.prevent="createUsuario">
      <div class="row">
        <div class="col-md-4">
          <label>Nombre:</label>
          <input type="text" class="form-control" v-model="usuario.nombre" required />
        </div>
        <div class="col-md-4">
          <label>Apellido:</label>
          <input type="text" class="form-control" v-model="usuario.apellido" required />
        </div>
        <div class="col-md-4">
          <label>Cédula:</label>
          <input type="text" class="form-control" v-model="usuario.cedula" required />
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label>Teléfono:</label>
          <input type="text" class="form-control" v-model="usuario.telefono" required />
        </div>
        <div class="col-md-6">
          <label>Email:</label>
          <input type="email" class="form-control" v-model="usuario.email" required />
        </div>
      </div>
      <fieldset>
        <div class="row">
          <div class="col-md-4">
            <label>Provincia:</label>
            <input type="text" class="form-control" v-model="usuario.direccion.provincia" required />
          </div>
          <div class="col-md-4">
            <label>Cantón:</label>
            <input type="text" class="form-control" v-model="usuario.direccion.canton" required />
          </div>
          <div class="col-md-4">
            <label>Distrito:</label>
            <input type="text" class="form-control" v-model="usuario.direccion.distrito" required />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Barrio:</label>
            <input type="text" class="form-control" v-model="usuario.direccion.barrio" required />
          </div>
          <div class="col-md-6">
            <label>Información Adicional:</label>
            <input type="text" class="form-control" v-model="usuario.direccion.informacionAdicional" />
          </div>
        </div>
      </fieldset>
      <div class="row">
        <div class="col-md-12">
          <label>Tipo de Usuario:</label>
          <select class="form-control" v-model="usuario.tipo" required>
            <option value="Normal">Normal</option>
            <option value="Administrador">Administrador</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label>Contraseña:</label>
          <input type="password" class="form-control" v-model="usuario.password" required />
        </div>
        <div class="col-md-6">
          <label>Confirmar Contraseña:</label>
          <input type="password" class="form-control" v-model="confirmPassword" required />
          <p v-if="passwordMismatch" class="text-danger">Las contraseñas no coinciden</p>
        </div>
      </div>
      <button type="submit" class="btn btn-success">Crear</button>
      <button type="button" class="btn btn-danger" @click="onCancel">Cancelar</button>
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
        nombre: '',
        apellido: '',
        cedula: '',
        telefono: '',
        email: '',
        direccion: {
          provincia: '',
          canton: '',
          distrito: '',
          barrio: '',
          informacionAdicional: ''
        },
        tipo: 'Normal',
        password: ''
      },
      confirmPassword: ''
    };
  },
  computed: {
    passwordMismatch() {
      return this.usuario.password !== this.confirmPassword;
    }
  },
  methods: {
    async createUsuario() {
      if (this.passwordMismatch) {
        alert('Las contraseñas no coinciden');
        return;
      }

      try {
        await api.createUsuario(this.usuario);
        this.$router.push('/vue');
      } catch (error) {
        console.error('Error creating usuario:', error);
      }
    },
    onCancel() {
      this.$router.push('/vue');
    }
  }
};
</script>

<style scoped>
.container {
  max-width: 800px;
}
</style>
