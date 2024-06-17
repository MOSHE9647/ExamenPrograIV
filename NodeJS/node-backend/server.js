const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const axios = require('axios');

const app = express();

// Middleware
app.use(bodyParser.json());
app.use(cors());

// Forward request to Spring Boot
const forwardRequest = async (path, method, data) => {
    const url = `http://localhost:8080${path}`;
    const options = {
        method: method,
        url: url,
        data: data,
        headers: { 'Content-Type': 'application/json' }
    };

    try {
        const response = await axios(options);
        return response.data;
    } catch (error) {
        console.error('Error forwarding request:', error);
        return { error: 'Error forwarding request' };
    }
};

// Rutas
app.get('/usuarios', async (req, res) => {
    const response = await forwardRequest('/api/usuarios', 'GET');
    res.json(response);
});

app.get('/usuarios/active', async (req, res) => {
    const response = await forwardRequest('/api/usuarios/active', 'GET');
    res.json(response);
});

app.get('/usuarios/inactive', async (req, res) => {
    const response = await forwardRequest('/api/usuarios/inactive', 'GET');
    res.json(response);
});

app.get('/usuarios/:id', async (req, res) => {
    const response = await forwardRequest(`/api/usuarios/${req.params.id}`, 'GET');
    res.json(response);
});

app.post('/usuarios', async (req, res) => {
    const response = await forwardRequest('/api/usuarios', 'POST', req.body);
    res.json(response);
});

app.put('/usuarios/:id', async (req, res) => {
    const response = await forwardRequest(`/api/usuarios/${req.params.id}`, 'PUT', req.body);
    res.json(response);
});

app.delete('/usuarios/:id/delete/logical', async (req, res) => {
    const response = await forwardRequest(`/api/usuarios/${req.params.id}/delete/logical`, 'DELETE');
    res.json(response);
});

app.delete('/usuarios/:id/delete/physical', async (req, res) => {
    const response = await forwardRequest(`/api/usuarios/${req.params.id}/delete/physical`, 'DELETE');
    res.json(response);
});

// Iniciar el servidor
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor Node.js escuchando en el puerto ${PORT}`);
});
