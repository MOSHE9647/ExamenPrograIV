const express = require('express');
const axios = require('axios');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();

// Middleware
app.use(bodyParser.json());
app.use(cors());

// Function to forward requests to PHP
const forwardToPhp = async (path, method, data) => {
    const url = `http://localhost/proyecto_php/api/v1${path}`;
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

// Define routes that forward to PHP
app.get('/usuarios', async (req, res) => {
    const response = await forwardToPhp('/usuarios/getAll', 'GET');
    res.json(response);
});

app.get('/usuarios/active', async (req, res) => {
    const response = await forwardToPhp('/usuarios/getActive', 'GET');
    res.json(response);
});

app.get('/usuarios/inactive', async (req, res) => {
    const response = await forwardToPhp('/usuarios/getInactive', 'GET');
    res.json(response);
});

app.get('/usuarios/:id', async (req, res) => {
    const response = await forwardToPhp(`/usuarios/get?id=${req.params.id}`, 'GET');
    res.json(response);
});

app.post('/usuarios', async (req, res) => {
    const response = await forwardToPhp('/usuarios/create', 'POST', req.body);
    res.json(response);
});

app.put('/usuarios/:id', async (req, res) => {
    const response = await forwardToPhp(`/usuarios/update`, 'PUT', { ...req.body, id: req.params.id });
    res.json(response);
});

app.delete('/usuarios/:id/delete/logical', async (req, res) => {
    const response = await forwardToPhp(`/usuarios/delete/logical?id=${req.params.id}`, 'DELETE');
    res.json(response);
});

app.delete('/usuarios/:id/delete/physical', async (req, res) => {
    const response = await forwardToPhp(`/usuarios/delete/physical?id=${req.params.id}`, 'DELETE');
    res.json(response);
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Node.js server listening on port ${PORT}`);
});
