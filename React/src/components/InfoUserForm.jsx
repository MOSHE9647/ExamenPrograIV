import React, { useState, useEffect } from 'react';

const InfoUserForm = ({ user: initialUser, toggleFormVisibility }) => {
  const [user, setUser] = useState(initialUser);

  useEffect(() => {
    setUser(initialUser);
  }, [initialUser]);

const fechaCreacion = user.fechaCreacion.slice(0, 19);

  return (
    <div className="card">
      <div className="card-body">
        <h3 className="card-title">Información del Usuario</h3>
        <form className='container'>
          <div className="row">
            <div className="col-md-4">
              <label>Nombre:</label>
              <input
                type="text"
                className="form-control"
                name="nombre"
                value={user.nombre}
                disabled
              />
            </div>
            <div className="col-md-4">
              <label>Apellido:</label>
              <input
                type="text"
                className="form-control"
                name="apellido"
                value={user.apellido}
                disabled
              />
            </div>
            <div className="col-md-4">
              <label>Cédula:</label>
              <input
                type="text"
                className="form-control"
                name="cedula"
                value={user.cedula}
                disabled
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
                disabled
              />
            </div>
            <div className="col-md-6">
              <label>Email:</label>
              <input
                type="email"
                className="form-control"
                name="email"
                value={user.email}
                disabled
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
                disabled
              />
            </div>
            <div className="col-md-4">
              <label>Cantón:</label>
              <input
                type="text"
                className="form-control"
                name="direccion.canton"
                value={user.direccion.canton}
                disabled
              />
            </div>
            <div className="col-md-4">
              <label>Distrito:</label>
              <input
                type="text"
                className="form-control"
                name="direccion.distrito"
                value={user.direccion.distrito}
                disabled
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
                disabled
              />
            </div>
            <div className="col-md-6">
              <label>Información Adicional:</label>
              <input
                type="text"
                className="form-control"
                name="direccion.informacionAdicional"
                value={user.direccion.informacionAdicional}
                disabled
              />
            </div>
          </div>
          <div className="row">
            <div className="col-md-6">
              <label>Estado:</label>
              <select
                className="form-control"
                name="estado"
                value={user.estado}
                disabled
              >
                <option value="true">Activo</option>
                <option value="false">Inactivo</option>
              </select>
            </div>
            <div className="col-md-6">
              <label>Fecha de Creación:</label>
              <input
                type="datetime-local"
                className="form-control"
                name="fechaCreacion"
                value={fechaCreacion}
                readOnly
              />
            </div>
          </div>
          <div className="row">
            <div className="col-md-6">
              <label>Contraseña:</label>
              <input
                type="text"
                className="form-control"
                name="password"
                value={user.password}
                disabled
              />
            </div>
            <div className="col-md-6">
              <label>Tipo de Usuario:</label>
              <select
                className="form-control"
                name="tipo"
                value={user.tipo}
                disabled
              >
                <option value="Normal">Normal</option>
                <option value="Administrador">Administrador</option>
              </select>
            </div>
          </div>
          <button type="button" className="btn btn-danger" onClick={toggleFormVisibility}>Cancelar</button>
        </form>
      </div>
    </div>
  );
};

export default InfoUserForm;
