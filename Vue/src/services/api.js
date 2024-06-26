import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:3100', // URL del servidor Node.js
  headers: {
    'Content-Type': 'application/json'
  }
});

export default {
  getUsuarios() {
    return api.get('/usuarios');
  },
  getUsuario(id) {
    return api.get(`/usuarios/${id}`);
  },
  createUsuario(usuario) {
    return api.post('/usuarios', usuario);
  },
  updateUsuario(usuario) {
    return api.put('/usuarios', usuario);
  },
  deleteUsuarioFisico(id) {
    return api.delete(`/usuarios/${id}/delete/physical`);
  }
};
