import React, { useState } from 'react';

const AddUserForm = ({ addUser, toggleFormVisibility }) => {
  const initialFormState = {
    estado: true,
    nombre: '',
    apellido: '',
    cedula: '',
    telefono: '',
    direccion: {
      provincia: '',
      canton: '',
      distrito: '',
      barrio: '',
      informacionAdicional: ''
    },
    email: '',
    tipo: 'Normal',
    password: '',
    confirmPassword: ''
  };

  const [user, setUser] = useState(initialFormState);

  const handleInputChange = event => {
    const { name, value } = event.target;
    if (name.includes('direccion')) {
      const addressField = name.split('.')[1];
      setUser({
        ...user,
        direccion: { ...user.direccion, [addressField]: value }
      });
    } else {
      setUser({ ...user, [name]: value });
    }
  };

  const handleSubmit = event => {
    event.preventDefault();
    if (user.password !== user.confirmPassword) {
      alert("Las contraseñas no coinciden");
      return;
    }
    addUser(user);
    setUser(initialFormState); // Reiniciar formulario después de agregar usuario
  };

  return (
      <div className="card">
        <div className="card-body">
          <h3 className="card-title">Agregar Usuario</h3>
          <form onSubmit={handleSubmit} className='container'>
            <div className="row">
              <div className="col-md-4">
                <label>Nombre:</label>
                <input
                  type="text"
                  className="form-control"
                  name="nombre"
                  value={user.nombre}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="col-md-4">
                <label>Apellido:</label>
                <input
                  type="text"
                  className="form-control"
                  name="apellido"
                  value={user.apellido}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="col-md-4">
                <label>Cédula:</label>
                <input
                  type="text"
                  className="form-control"
                  name="cedula"
                  value={user.cedula}
                  onChange={handleInputChange}
                  required
                />
              </div>
            </div>
            <div className="row">
              <div className="col-md-6">
                <label>Teléfono:</label>
                <input
                  type="text"
                  className="form-control"
                  name="telefono"
                  value={user.telefono}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="col-md-6">
                <label>Email:</label>
                <input
                  type="email"
                  className="form-control"
                  name="email"
                  value={user.email}
                  onChange={handleInputChange}
                  required
                />
              </div>
            </div>
            <div className="row">
              <div className="col-md-4">
                <label>Provincia:</label>
                <input
                  type="text"
                  className="form-control"
                  name="direccion.provincia"
                  value={user.direccion.provincia}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="col-md-4">
                <label>Cantón:</label>
                <input
                  type="text"
                  className="form-control"
                  name="direccion.canton"
                  value={user.direccion.canton}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="col-md-4">
                <label>Distrito:</label>
                <input
                  type="text"
                  className="form-control"
                  name="direccion.distrito"
                  value={user.direccion.distrito}
                  onChange={handleInputChange}
                  required
                />
              </div>
            </div>
            <div className="row">
              <div className="col-md-6">
                <label>Barrio:</label>
                <input
                  type="text"
                  className="form-control"
                  name="direccion.barrio"
                  value={user.direccion.barrio}
                  onChange={handleInputChange}
                />
              </div>
              <div className="col-md-6">
                <label>Información Adicional:</label>
                <input
                  type="text"
                  className="form-control"
                  name="direccion.informacionAdicional"
                  value={user.direccion.informacionAdicional}
                  onChange={handleInputChange}
                />
              </div>
            </div>
            <div className="row">
              <div className="col-md-12">
                <label>Tipo de Usuario:</label>
                <select
                  className="form-control"
                  name="tipo"
                  value={user.tipo}
                  onChange={handleInputChange}
                  required
                >
                  <option value="Normal">Normal</option>
                  <option value="Administrador">Administrador</option>
                </select>
              </div>
            </div>
            <div className="row">
              <div className="col-md-6">
                <label>Contraseña:</label>
                <input
                  type="password"
                  className="form-control"
                  name="password"
                  value={user.password}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="col-md-6">
                <label>Confirmar Contraseña:</label>
                <input
                  type="password"
                  className="form-control"
                  name="confirmPassword"
                  onChange={handleInputChange}
                  required
                />
              </div>
            </div>
            <button type="submit" className="btn btn-primary">Agregar Usuario</button>
            <button type="button" className="btn btn-danger" onClick={toggleFormVisibility}>Cancelar</button>
          </form>
        </div>
      </div>
  );
};

export default AddUserForm;
