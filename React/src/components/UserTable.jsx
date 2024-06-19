import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

const UserTable = ({ users, deleteUser, showUser, showUserInfo }) => {
  const [currentPage, setCurrentPage] = useState(1);

  // Cantidad de registros por página
  const recordsPerPage = 5;

  // Calcular índices de inicio y fin para la página actual
  const indexOfLastRecord = currentPage * recordsPerPage;
  const indexOfFirstRecord = indexOfLastRecord - recordsPerPage;
  const currentRecords = users.slice(indexOfFirstRecord, indexOfLastRecord);

  // Cambiar de página
  const paginate = pageNumber => setCurrentPage(pageNumber);

  return (
    <div className="table-responsive">
      <table className="table table-striped table-bordered">
        <thead className="thead-dark">
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
          {currentRecords.map(user => (
            <tr key={user.id}>
              <td>{user.id}</td>
              <td>{user.cedula}</td>
              <td>{`${user.nombre} ${user.apellido}`}</td>
              <td>{user.telefono}</td>
              <td>{user.email}</td>
              <td>{user.tipo}</td>
              <td>{user.estado ? 'Activo' : 'Inactivo'}</td>
              <td>
                <button
                  className="btn btn-info btn-sm mr-2"
                  onClick={() => showUserInfo(user.id)}
                >
                  <i className="las la-info-circle"></i>
                </button>
                <button
                  className="btn btn-warning btn-sm mr-2"
                  onClick={() => showUser(user.id)}
                >
                  <i className="las la-user-edit"></i>
                </button>
                <button
                  className="btn btn-danger btn-sm"
                  onClick={() => deleteUser(user.id)}
                >
                  <i className="las la-trash-alt"></i>
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      {/* Paginación */}
      <nav>
        <ul className="pagination justify-content-center">
          {Array.from({ length: Math.ceil(users.length / recordsPerPage) }, (_, index) => (
            <li key={index} className={`page-item ${currentPage === index + 1 ? 'active' : ''}`}>
              <button onClick={() => paginate(index + 1)} className="page-link">
                {index + 1}
              </button>
            </li>
          ))}
        </ul>
      </nav>
    </div>
  );
};

export default UserTable;
