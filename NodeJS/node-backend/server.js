const express = require('express');
const axios = require('axios');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();

// Middleware
app.use(bodyParser.json());
app.use(cors()); // Configuración CORS por defecto

// Function to forward requests to PHP
const forwardToPhp = async (path, method, data = {}) => {
    const url = `http://localhost/PHP/api.php/${path}`;
    const options = {
        method: method,
        url: url,
        data: method !== 'GET' ? data : undefined, // Only attach data if method is not GET
        headers: { 'Content-Type': 'application/json' }
    };

    try {
        const response = await axios(options);
        return { success: true, data: response.data, status: response.status };
    } catch (error) {
        console.error('Error forwarding request:', error.message);
        return { success: false, error: 'Error forwarding request', details: error.message, status: error.response ? error.response.status : 500 };
    }
};

// Define routes that forward to PHP
app.get('/usuarios', async (req, res) => {
    const response = await forwardToPhp('?action=getAll', 'GET');
    res.status(response.status).json(response.data);
});

app.get('/usuarios/active', async (req, res) => {
    const response = await forwardToPhp('?action=getActive', 'GET');
    res.status(response.status).json(response.data);
});

app.get('/usuarios/inactive', async (req, res) => {
    const response = await forwardToPhp('?action=getInactive', 'GET');
    res.status(response.status).json(response.data);
});

app.get('/usuarios/:id', async (req, res) => {
    const response = await forwardToPhp(`?action=get&id=${req.params.id}`, 'GET');
    res.status(response.status).json(response.data);
});

app.post('/usuarios', async (req, res) => {
    const response = await forwardToPhp('?action=create', 'POST', req.body);
    res.status(response.status).json(response.data);
});

app.put('/usuarios', async (req, res) => {
    const usuario = req.body; // Obtén el usuario enviado en el cuerpo de la solicitud
    const response = await forwardToPhp('?action=update', 'PUT', usuario);
    res.status(response.status).json(response.data);
});

app.delete('/usuarios/:id/delete/logical', async (req, res) => {
    const response = await forwardToPhp(`?action=delete/logical&id=${req.params.id}`, 'DELETE');
    res.status(response.status).json(response.data);
});

app.delete('/usuarios/:id/delete/physical', async (req, res) => {
    const response = await forwardToPhp(`?action=delete/physical&id=${req.params.id}`, 'DELETE');
    res.status(response.status).json(response.data);
});

// Start the server
const PORT = process.env.PORT || 3100;
app.listen(PORT, () => {
    console.log(`Node.js server listening on port ${PORT}`);
});
