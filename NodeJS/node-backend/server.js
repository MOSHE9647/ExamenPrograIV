// server.js

const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();

// Middleware
app.use(bodyParser.json());
app.use(cors());

// Rutas
app.get('/', (req, res) => {
    res.send('Servidor Node.js funcionando correctamente');
});

// Ejemplo de ruta para recibir datos desde PHP
app.post('/usuarios', (req, res) => {
    console.log('Datos recibidos desde PHP:', req.body);
    // Aquí puedes procesar los datos recibidos y devolver una respuesta adecuada
    res.json({ message: 'Datos recibidos correctamente en Node.js' });
});

// Iniciar el servidor
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor Node.js escuchando en el puerto ${PORT}`);
});
