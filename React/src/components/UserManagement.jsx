import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';
import UserTable from './UserTable';
import AddUserForm from './AddUserForm';
import NotificationToast from './NotificationToast';
import EditUserForm from './EditUserForm';
import InfoUserForm from './InfoUserForm';

function UserManagement() {
  const [users, setUsers] = useState([]);
  const [isAddFormVisible, setIsAddFormVisible] = useState(false);
  const [isEditFormVisible, setIsEditFormVisible] = useState(false);
  const [isInfoFormVisible, setIsInfoFormVisible] = useState(false);
  const [selectedUser, setSelectedUser] = useState(null);

  // Notification Variables
  const [toast, setToast] = useState({
    message: '',
    title: '',
    type: '',
    showToast: false
  });

  // Función para alternar la visibilidad del formulario
  const toggleAddFormVisibility = () => {
    setIsAddFormVisible(!isAddFormVisible);
    setIsEditFormVisible(false);
    setIsInfoFormVisible(false);
  };
  
  const toggleEditFormVisibility = () => {
    setIsEditFormVisible(!isEditFormVisible);
    setIsAddFormVisible(false);
    setIsInfoFormVisible(false);
  };
  
  const toggleInfoFormVisibility = () => {
    setIsInfoFormVisible(!isInfoFormVisible);
    setIsAddFormVisible(false);
    setIsEditFormVisible(false);
  };  

  useEffect(() => {
    fetchUsers();
  }, []);

  const baseURL = 'http://25.7.147.209:8000/usuarios';

  const fetchUsers = async () => {
    try {
      const response = await axios.get(baseURL + '/get');

      if (response.data.success) {
        setUsers(response.data.data);
      } else {
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
      }
    } catch (error) {
      setToast({
        message: error.message,
        title: 'Error inesperado',
        type: 'error',
        showToast: true
      });
    }
  };

  // Función para agregar un nuevo usuario
  const addUser = async newUser => {
    try {
      const response = await axios.post(baseURL + '/create', newUser);

      if (response.data.success) {
        // Actualiza la lista de usuarios después de agregar el nuevo usuario
        setUsers([...users, response.data.data]);
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
      } else {
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
      }
    } catch (error) {
      setToast({
        message: error.message,
        title: 'Error inesperado',
        type: 'error',
        showToast: true
      });
    }
  };

  // Función para eliminar un usuario
  const deleteUser = async id => {
    const confirmDelete = window.confirm("¿Estás seguro de que deseas eliminar este usuario?");
    
    if (!confirmDelete) {
      return;
    }

    try {
      const response = await axios.delete(`${baseURL}/delete?id=${id}`);

      if (response.data.success) {
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
        setUsers(users.filter(user => user.id !== id));
        fetchUsers();
      } else {
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
      }
    } catch (error) {
      setToast({
        message: error.message,
        title: 'Error inesperado',
        type: 'error',
        showToast: true
      });
    }
  };

  // Función para mostrar detalles de un usuario
  const showUserInfo = async id => {
    try {
      const response = await axios.get(`${baseURL}/get?id=${id}`);

      if (response.data.success) {
        setSelectedUser(response.data.data);
        toggleInfoFormVisibility();
      } else {
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
      }
    } catch (error) {
      setToast({
        message: error.message,
        title: 'Error inesperado',
        type: 'error',
        showToast: true
      });
    }
  };

  const showUser = async id => {
    try {
      const response = await axios.get(`${baseURL}/get?id=${id}`);

      if (response.data.success) {
        setSelectedUser(response.data.data);
        toggleEditFormVisibility();
      } else {
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
      }
    } catch (error) {
      setToast({
        message: error.message,
        title: 'Error inesperado',
        type: 'error',
        showToast: true
      });
    }
  };

  // Función para actualizar información de un usuario
  const updateUser = async updatedUser => {
    try {
      const response = await axios.put(`${baseURL}/update`, updatedUser);

      if (response.data.success) {
        setUsers(users.map(user => (user.id === updatedUser.id ? updatedUser : user)));
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
        setIsEditFormVisible(false);
      } else {
        setToast({
          message: response.data.message,
          title: response.data.title,
          type: response.data.type,
          showToast: true
        });
      }
    } catch (error) {
      setToast({
        message: error.message,
        title: 'Error inesperado',
        type: 'error',
        showToast: true
      });
    }
  };

  return (
    <div>
      {toast.showToast && <NotificationToast title={toast.title} message={toast.message} type={toast.type} />}
      <div className="container mt-5">
        <h1 className="text-center mb-4">Gestión de Usuarios</h1>
        <div className="row">
          {!isAddFormVisible && (
            <div className="col-12 d-flex">
              <button className="btn btn-primary" onClick={toggleAddFormVisibility}>
                Añadir
              </button>
            </div>
          )}
          <div className="col-12 mb-4">
            <UserTable
              users={users}
              deleteUser={deleteUser}
              showUser={showUser}
              showUserInfo={showUserInfo}
            />
          </div>
          {isAddFormVisible && (
            <div className="col-12">
              <AddUserForm 
                addUser={addUser} 
                toggleFormVisibility={toggleAddFormVisibility}
              />
            </div>
          )}
          {isEditFormVisible &&(
            <div className="col-12">
              <EditUserForm 
                user={selectedUser} 
                updateUser={updateUser} 
                toggleFormVisibility={toggleEditFormVisibility} 
              />
            </div>
          )}
          {isInfoFormVisible &&(
            <div className="col-12">
              <InfoUserForm 
                user={selectedUser} 
                toggleFormVisibility={toggleInfoFormVisibility}
              />
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default UserManagement;
