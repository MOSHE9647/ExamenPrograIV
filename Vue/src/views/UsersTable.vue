<template>
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
        <tr v-for="usuario in users" :key="usuario.id">
          <td>{{ usuario.id }}</td>
          <td>{{ usuario.cedula }}</td>
          <td>{{ usuario.nombre }} {{ usuario.apellido }}</td>
          <td>{{ usuario.telefono }}</td>
          <td>{{ usuario.email }}</td>
          <td>{{ usuario.tipo }}</td>
          <td>{{ usuario.estado ? 'Activo' : 'Inactivo' }}</td>
          <td>
            <button class="btn btn-info btn-sm mr-2" @click="viewUser(usuario)">
              <i class="las la-info-circle"></i>
            </button>
            <button class="btn btn-warning btn-sm mr-2" @click="editUser(usuario)">
              <i class="las la-user-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm" @click="deleteUser(usuario.id)">
              <i class="las la-trash-alt"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    users: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      filteredUsers: [...this.users],
    };
  },
  methods: {
    viewUser(user) {
      this.$emit('infoUser', user);
    },
    editUser(user) {
      this.$emit('editUser', user);
    },
    deleteUser(id) {
      this.$emit('deleteUser', id);
    }
  }
};
</script>

<style>

</style>