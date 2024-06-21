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
    const url =`http://localhost/ExamenPrograIV/PHP/api.php/${path}`;
    const options = {
        method: method,
        url: url,
        data: method !== 'GET' ? data : undefined, // Only attach data if method is not GET
        headers: { 'Content-Type': 'application/json' }
    };

    try {
        const response = await axios(options);
        return response.data;
    } catch (error) {
        console.error('Error forwarding request:', error.message);
        return { error: 'Error forwarding request' };
    }
};

// Define routes that forward to PHP
app.get('/usuarios', async (req, res) => {
    const response = await forwardToPhp('?action=getAll', 'GET');
    res.json(response);
});

app.get('/usuarios/active', async (req, res) => {
    const response = await forwardToPhp('?action=getActive', 'GET');
    res.json(response);
});

app.get('/usuarios/inactive', async (req, res) => {
    const response = await forwardToPhp('?action=getInactive', 'GET');
    res.json(response);
});

app.get('/usuarios/:id', async (req, res) => {
    const response = await forwardToPhp(`?action=get&id=${req.params.id}`, 'GET');
    res.json(response);
});

app.post('/usuarios', async (req, res) => {
    const response = await forwardToPhp('?action=create', 'POST', req.body);
    res.json(response);
});

app.put('/usuarios/:id', async (req, res) => {
    const response = await forwardToPhp(`?action=update`, 'PUT', { ...req.body, id: req.params.id });
    res.json(response);
});

app.delete('/usuarios/:id/delete/logical', async (req, res) => {
    const response = await forwardToPhp(`?action=delete/logical&id=${req.params.id}`, 'DELETE');
    res.json(response);
});

app.delete('/usuarios/:id/delete/physical', async (req, res) => {
    const response = await forwardToPhp(`?action=delete/physical&id=${req.params.id}`, 'DELETE');
    res.json(response);
});

// Start the server
const PORT = process.env.PORT || 3100;
app.listen(PORT, () => {
    console.log(`Node.js server listening on port ${PORT}`);
});