<template>
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Información del Usuario</h3>
      <template v-if="user">
        <form class="container">
          <div class="row">
            <div class="col-md-4">
              <label>Nombre:</label>
              <input type="text" class="form-control" :value="user.nombre" readonly />
            </div>
            <div class="col-md-4">
              <label>Apellido:</label>
              <input type="text" class="form-control" :value="user.apellido" readonly />
            </div>
            <div class="col-md-4">
              <label>Cédula:</label>
              <input type="text" class="form-control" :value="user.cedula" readonly />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Teléfono:</label>
              <input type="text" class="form-control" :value="user.telefono" readonly />
            </div>
            <div class="col-md-6">
              <label>Email:</label>
              <input type="email" class="form-control" :value="user.email" readonly />
            </div>
          </div>
          <fieldset>
            <div class="row">
              <div class="col-md-4">
                <label>Provincia:</label>
                <input type="text" class="form-control" :value="user.direccion.provincia" readonly />
              </div>
              <div class="col-md-4">
                <label>Cantón:</label>
                <input type="text" class="form-control" :value="user.direccion.canton" readonly />
              </div>
              <div class="col-md-4">
                <label>Distrito:</label>
                <input type="text" class="form-control" :value="user.direccion.distrito" readonly />
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Barrio:</label>
                <input type="text" class="form-control" :value="user.direccion.barrio" readonly />
              </div>
              <div class="col-md-6">
                <label>Información Adicional:</label>
                <input type="text" class="form-control" :value="user.direccion.informacionAdicional" readonly />
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="col-md-6">
              <label>Estado:</label>
              <select class="form-control" :value="user.estado" disabled>
                <option value="true">Activo</option>
                <option value="false">Inactivo</option>
              </select>
            </div>
            <div class="col-md-6">
              <label>Fecha de Creación:</label>
              <input type="datetime-local" class="form-control" :value="formattedFechaCreacion" readonly />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Contraseña:</label>
              <input type="password" class="form-control" :value="user.password" readonly />
            </div>
            <div class="col-md-6">
              <label>Tipo de Usuario:</label>
              <select class="form-control" :value="user.tipo" disabled>
                <option value="Normal">Normal</option>
                <option value="Administrador">Administrador</option>
              </select>
            </div>
          </div>
          <button type="button" class="btn btn-danger" @click="onCancel">Cancelar</button>
        </form>
      </template>
      <template v-else>
        <h6 class="card-title">Usuario no encontrado</h6>
      </template>
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
  computed: {
    formattedFechaCreacion() {
      // Método para formatear la fecha de creación si user.fechaCreacion es un timestamp o similar
      return new Date(this.user.fechaCreacion).toISOString().slice(0, 16);
    }
  },
  methods: {
    onCancel() {
      this.$emit('cancel');
    }
  }
};
</script>

<style>

</style>
