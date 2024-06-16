import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';
import UserTable from './UserTable';
import AddUserForm from './AddUserForm';
import NotificationToast from './NotificationToast';

function UserManagement() {
  const [users, setUsers] = useState([]);
  const [isFormVisible, setIsFormVisible] = useState(false);

  // Notification Variables
  const [toast, setToast] = useState({
    message: '',
    title: '',
    type: '',
    showToast: false
  });


  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = async () => {
    try {
      const response = await axios.get('http://localhost:8000/usuarios/get');

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
      const response = await axios.post('http://localhost:8000/usuarios/create', newUser);

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
  const deleteUser = id => {
    // setUsers(users.filter(user => user.id !== id));
    alert(`Eliminar al usuario con ID ${id}`);
  };

  // Función para mostrar detalles de un usuario (no implementada)
  const showUser = id => {
    alert(`Mostrar detalles del usuario con ID ${id}`);
  };

  // Función para actualizar información de un usuario (no implementada)
  const updateUser = id => {
    alert(`Actualizar información del usuario con ID ${id}`);
  };

  // Función para alternar la visibilidad del formulario
  const toggleFormVisibility = () => {
    setIsFormVisible(!isFormVisible);
  };

  return (
    <div>
      {toast.showToast && <NotificationToast title={toast.title} message={toast.message} type={toast.type} />}
      <div className="container mt-5">
        <h1 className="text-center mb-4">Gestión de Usuarios</h1>
        <div className="row">
          {!isFormVisible && (
            <div className="col-12 d-flex">
              <button className="btn btn-primary" onClick={toggleFormVisibility}>
                Añadir
              </button>
            </div>
          )}
          <div className="col-12 mb-4">
            <UserTable
              users={users}
              deleteUser={deleteUser}
              showUser={showUser}
              updateUser={updateUser}
            />
          </div>
          {isFormVisible && (
            <div className="col-12">
              <AddUserForm addUser={addUser} toggleFormVisibility={toggleFormVisibility} />
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default UserManagement;
