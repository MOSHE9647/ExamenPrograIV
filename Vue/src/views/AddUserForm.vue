<template>
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Agregar Usuario</h3>
      <form @submit.prevent="onSave" class="container">
        <div class="row">
          <div class="col-md-4">
            <label>Nombre:</label>
            <input type="text" class="form-control" v-model="user.nombre" required />
          </div>
          <div class="col-md-4">
            <label>Apellido:</label>
            <input type="text" class="form-control" v-model="user.apellido" required />
          </div>
          <div class="col-md-4">
            <label>Cédula:</label>
            <input type="text" class="form-control" v-model="user.cedula" required />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Teléfono:</label>
            <input type="text" class="form-control" v-model="user.telefono" required />
          </div>
          <div class="col-md-6">
            <label>Email:</label>
            <input type="email" class="form-control" v-model="user.email" required />
          </div>
        </div>
        <fieldset>
          <div class="row">
            <div class="col-md-4">
              <label>Provincia:</label>
              <input type="text" class="form-control" v-model="user.direccion.provincia" required />
            </div>
            <div class="col-md-4">
              <label>Cantón:</label>
              <input type="text" class="form-control" v-model="user.direccion.canton" required />
            </div>
            <div class="col-md-4">
              <label>Distrito:</label>
              <input type="text" class="form-control" v-model="user.direccion.distrito" required />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Barrio:</label>
              <input type="text" class="form-control" v-model="user.direccion.barrio" required />
            </div>
            <div class="col-md-6">
              <label>Información Adicional:</label>
              <input type="text" class="form-control" v-model="user.direccion.informacionAdicional" />
            </div>
          </div>
        </fieldset>
        <div class="row">
          <div class="col-md-12">
            <label>Tipo de Usuario:</label>
            <select class="form-control" v-model="user.tipo" required>
              <option value="Normal">Normal</option>
              <option value="Administrador">Administrador</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Contraseña:</label>
            <input type="password" class="form-control" v-model="user.password" required />
          </div>
          <div class="col-md-6">
            <label>Confirmar Contraseña:</label>
            <input type="password" class="form-control" v-model="user.confirmPassword" required />
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-primary">Agregar Usuario</button>
          <button type="button" class="btn btn-danger" @click="onCancel">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AddUserForm',
  data() {
    return {
      user: {
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
        password: '',
        confirmPassword: ''
      },
    };
  },
  computed: {
    passwordMismatch() {
      return this.user.password !== this.user.confirmPassword;
    }
  },
  methods: {
    onSave() {
      if (this.passwordMismatch) {
        alert('Las contraseñas no coinciden');
        return;
      }
      this.$emit('save', { ...this.user });
    },
    onCancel() {
      this.$emit('cancel');
    }
  }
};
</script>

<style></style>