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
        data: method !== 'GET' ? data : undefined,
        headers: { 'Content-Type': 'application/json' }
    };

    try {
        const response = await axios(options);
        return { status: response.status, data: response.data };
    } catch (error) {
        console.error('Error forwarding request:', error.message);
        return { status: error.response ? error.response.status : 500, data: { error: 'Error forwarding request' } };
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

app.put('/usuarios', async (req, res) => {
    const usuario = req.body;
    const response = await forwardToPhp('?action=update', 'PUT', usuario);

    if (response.error) {
        // Si hay un error en la respuesta, devolver un estado de error.
        return res.status(500).json({ error: response.error });
    }
    
    // Verifica que `response` contenga el código de estado y los datos adecuados.
    if (!response.status || !response.data) {
        return res.status(500).json({ error: 'Invalid response format from PHP server' });
    }

    // Si la respuesta es correcta, envía el código de estado y los datos.
    res.status(response.status).json(response.data);
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