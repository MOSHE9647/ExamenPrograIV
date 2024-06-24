<template>
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Editar Usuario</h3>
      <form @submit.prevent="onSave" class="container">
        <div class="row">
          <div class="col-md-4">
            <label>Nombre:</label>
            <input type="text" class="form-control" v-model="editedUser.nombre" required />
          </div>
          <div class="col-md-4">
            <label>Apellido:</label>
            <input type="text" class="form-control" v-model="editedUser.apellido" required />
          </div>
          <div class="col-md-4">
            <label>Cédula:</label>
            <input type="text" class="form-control" v-model="editedUser.cedula" required />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Teléfono:</label>
            <input type="text" class="form-control" v-model="editedUser.telefono" required />
          </div>
          <div class="col-md-6">
            <label>Email:</label>
            <input type="email" class="form-control" v-model="editedUser.email" required />
          </div>
        </div>
        <fieldset>
          <div class="row">
            <div class="col-md-4">
              <label>Provincia:</label>
              <input type="text" class="form-control" v-model="editedUser.direccion.provincia" required />
            </div>
            <div class="col-md-4">
              <label>Cantón:</label>
              <input type="text" class="form-control" v-model="editedUser.direccion.canton" required />
            </div>
            <div class="col-md-4">
              <label>Distrito:</label>
              <input type="text" class="form-control" v-model="editedUser.direccion.distrito" required />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Barrio:</label>
              <input type="text" class="form-control" v-model="editedUser.direccion.barrio" required />
            </div>
            <div class="col-md-6">
              <label>Información Adicional:</label>
              <input type="text" class="form-control" v-model="editedUser.direccion.informacionAdicional" />
            </div>
          </div>
        </fieldset>
        <div class="row">
          <div class="col-md-6">
            <label>Tipo de Usuario:</label>
            <select class="form-control" v-model="editedUser.tipo" required>
              <option value="Normal">Normal</option>
              <option value="Administrador">Administrador</option>
            </select>
          </div>
          <div class="col-md-6">
            <label>Estado:</label>
            <select class="form-control" v-model="editedUser.estado" required>
              <option value="true">Activo</option>
              <option value="false">Inactivo</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Contraseña:</label>
            <input type="password" class="form-control" v-model="editedUser.password" required />
          </div>
          <div class="col-md-6">
            <label>Confirmar Contraseña:</label>
            <input type="password" class="form-control" v-model="editedUser.confirmPassword" required />
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        <button type="button" class="btn btn-danger" @click="onCancel">Cancelar</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      editedUser: {
        ...this.user
      }
    };
  },
  computed: {
    passwordMismatch() {
      return this.editedUser.password !== this.editedUser.confirmPassword;
    }
  },
  methods: {
    onSave() {
      // Aquí podrías validar y enviar el formulario editado a través de un evento
      console.log(this.editedUser);
      this.$emit('save', { ...this.editedUser });
    },
    onCancel() {
      this.$emit('cancel');
    }
  }
};
</script>

<style></style>
