<template>
  <div>
    <div class="container mt-5">
      <h1 class="text-center mb-4">Gestión de Usuarios</h1>
      <div class="row">
        <div v-if="!isAddFormVisible" class="col-12 d-flex">
          <button class="btn btn-primary" @click="toggleAddFormVisibility">
            Añadir
          </button>
        </div>
        <div class="col-12 mb-4">
          <!-- Aquí va la tabla de Usuarios -->
          <UsersTable :users="users" @infoUser="toggleInfoFormVisibility" @editUser="toggleEditFormVisibility"
            @deleteUser="deleteUser" />
        </div>
        <div v-if="isAddFormVisible" class="col-12">
          <AddUserForm @cancel="hideForm" @save="createUser" />
        </div>
        <div v-if="isEditFormVisible" class="col-12">
          <EditUserForm :user="selectedUser" @cancel="hideForm" @save="updateUser" />
        </div>
        <div v-if="isInfoFormVisible" class="col-12">
          <InfoUserForm :user="selectedUser" @cancel="hideForm" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";
import UsersTable from './UsersTable.vue';
import AddUserForm from './AddUserForm.vue';
import EditUserForm from './EditUserForm.vue';
import InfoUserForm from './InfoUserForm.vue';
import api from '@/services/api';

export default {
  name: 'UserComponent',
  components: {
    UsersTable,
    AddUserForm,
    EditUserForm,
    InfoUserForm,
  },
  setup() {
    const toast = useToast();
    return { toast }
  },
  data() {
    return {
      users: [],
      selectedUser: null,
      isAddFormVisible: false,
      isEditFormVisible: false,
      isInfoFormVisible: false
    };
  },
  created() {
    this.loadUsers();
  },
  methods: {
    toggleAddFormVisibility() {
      this.isAddFormVisible = !this.isAddFormVisible;
      this.isEditFormVisible = false;
      this.isInfoFormVisible = false;
      this.selectedUser = null;
    },
    toggleEditFormVisibility(user) {
      this.isEditFormVisible = !this.isEditFormVisible;
      this.isAddFormVisible = false;
      this.isInfoFormVisible = false;
      this.selectedUser = user;
    },
    toggleInfoFormVisibility(user) {
      this.isInfoFormVisible = !this.isInfoFormVisible;
      this.isEditFormVisible = false;
      this.isAddFormVisible = false;
      this.selectedUser = user;
    },
    hideForm() {
      this.isInfoFormVisible = false;
      this.isEditFormVisible = false;
      this.isAddFormVisible = false;
      this.selectedUser = null;
    },
    showToast(message, type) {
      let options = {
        position: "top-right",
        timeout: 5000,
        closeOnClick: true,
        pauseOnFocusLoss: false,
        pauseOnHover: true,
        draggable: true,
        draggablePercent: 0.6,
        showCloseButtonOnHover: false,
        hideProgressBar: false,
        closeButton: "button",
        icon: true,
        rtl: false
      }

      if (type === 'success') {
        this.toast.success(message, options);
      } else if (type === 'warning') {
        this.toast.warning(message, options);
      } else if (type === 'error') {
        this.toast.error(message, options);
      } else {
        this.toast(message, options); // Mostrar un toast simple sin icono específico
      }
    },
    async loadUsers() {
      try {
        const response = await api.getUsuarios();
        this.users = response.data.data;
      } catch (error) {
        if (error.response) {
          this.showToast(
            "No se pudo obtener la lista de usuarios.\n" +
            "Error " + error.response.status + ": " + error.response.data,
            'error'
          );
        } else {
          this.showToast(
            "No se pudo obtener la lista de usuarios.\n" + error.message,
            'error'
          );
        }
        console.error('Error fetching usuarios:', error);
      }
    },
    async createUser(newUser) {
      try {
        const response = await api.createUsuario(newUser);
        if (response.data.success) {
          this.showToast(response.data.message, response.data.type);
          this.loadUsers();
          this.isAddFormVisible = false;
        } else {
          this.showToast(response.data.message, response.data.type);
        }
      } catch (error) {
        if (error.response) {
          this.showToast(
            "No se pudo obtener la lista de usuarios.\n" +
            "Error " + error.response.status + ": " + error.response.data,
            'error'
          );
        } else {
          this.showToast(
            "No se pudo obtener la lista de usuarios.\n" + error.message,
            'error'
          );
        }
        console.error('Error fetching usuarios:', error);
      }
    },
    async updateUser(updatedUser) {
      try {
        const response = await api.updateUsuario(updatedUser);
        if (response.data.success) {
          this.showToast(response.data.message, response.data.type);
          this.loadUsers();
          this.isEditFormVisible = false;
          this.selectedUser = null;
        } else {
          this.showToast(response.data.message, response.data.type);
        }
      } catch (error) {
        if (error.response) {
          this.showToast(
            "No se pudo obtener la lista de usuarios.\n" +
            "Error " + error.response.status + ": " + error.response.data,
            'error'
          );
        } else {
          this.showToast(
            "No se pudo obtener la lista de usuarios.\n" + error.message,
            'error'
          );
        }
        console.error('Error fetching usuarios:', error);
      }
    },
    async deleteUser(id) {
      const confirmed = window.confirm(`¿Está seguro de querer eliminar al usuario? Esta acción es permanente`);
      if (confirmed && id) {
        try {
          const response = await api.deleteUsuarioFisico(id);
          if (response.data.success) {
            // Actualiza la lista de usuarios después de eliminar
            this.showToast(response.data.message, response.data.type);
            this.loadUsers();
          } else {
            this.showToast(response.data.message, response.data.type);
          }
        } catch (error) {
          if (error.response) {
            this.showToast(
              "No se pudo obtener la lista de usuarios.\n" +
              "Error " + error.response.status + ": " + error.response.data,
              'error'
            );
          } else {
            this.showToast(
              "No se pudo obtener la lista de usuarios.\n" + error.message,
              'error'
            );
          }
          console.error('Error deleting usuario:', error);
        }
      }
    },
  },
};
</script>

<style>

</style>
