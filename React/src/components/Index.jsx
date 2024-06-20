import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Link } from 'react-router-dom';

// import UserManagement from '../UserManagement'; // Importa el componente UserManagement aquí si es necesario

function Index() {
  const links = [
    { name: 'React', path: '/react' },
    { name: 'Angular', path: process.env.REACT_APP_API_URL + process.env.REACT_APP_ANGULAR_PORT + '/angular', external: true },
    { name: 'Vue', path: 'https://vuejs.org', external: true },
    { name: 'Laravel', path: 'https://laravel.com', external: true }
  ];

  return (
    <div className="container mt-5 w-50">
      <h1 className="text-center">Enlaces a los Frameworks</h1>
      <ul className="list-group">
        {links.map(link => (
          <li key={link.name} className="list-group-item list-group-item-action list-group-item-light">
            {link.external ? (
              <a href={link.path} rel="noopener noreferrer">
                {link.name}
              </a>
            ) : (
              <Link to={link.path}>
                {link.name}
              </Link>
            )}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default Index;