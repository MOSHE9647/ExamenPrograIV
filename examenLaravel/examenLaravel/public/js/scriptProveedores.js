

function submitFormProveedor() {
    var crearForm = document.querySelector('.editForm');
    crearForm.addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Desea continuar con la edición de este proveedor?',
            text: '¡Asegúrate de tener los datos correctos!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                const idProveedor = document.getElementById("id").value;
                const nombreProveedor = document.getElementById("nombre").value;
                const telefonoProveedor = document.getElementById("telefono").value;
                const descripcionProveedor = document.getElementById("descripcion").value;
                const correo = document.getElementById("correo").value;
                const direccionProveedor = document.getElementById("direccion").value;
                const categoriaServicio = document.getElementById("categoria").value;
                const informacionAdicional = document.getElementById("informacionadicional").value;



                fetch(crearForm.action, {
                    method: 'PUT',
                    headers: {
                        "Content-Type": "application/json",
                      },
                    body: JSON.stringify({
                        idProveedor,
                        nombreProveedor,
                        telefonoProveedor,
                        descripcionProveedor,
                        correo,
                        direccionProveedor,
                        categoriaServicio,
                        informacionAdicional,
                      }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {



                            mostrarToastConfirmacion(data.message);
                            setTimeout(function () {
                                window.location.href = "/";
                            }, 1000);
                        } else {
                            mostrarToastError(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });
}

function validarFormularioCrear(event) {
    event.preventDefault(); // Evitar que el evento por defecto se ejecute

    var form = document.getElementById('form-crear');
    var inputs = form.getElementsByTagName('input');
    var mensajeContainer = document.getElementById('texto_error');

    for (var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        if (input.value.trim() === '') {
            var mensaje = "Por favor, completa todos los campos.";
            mostrarMensaje(mensaje, mensajeContainer);
            return false; // Detener la validación y no enviar el formulario
        }
    }

    // Si todos los campos están llenos, enviar el formulario después de 3 segundos
    //setTimeout(function() {
    //form.submit(); // Envía el formulario de manera programática

    //}, 2000); // 3000 milisegundos = 3 segundos

    return true; // Devuelve true para indicar que el formulario se enviará después del retraso
}



function mostrarMensaje(mensaje, container) {
    container.innerHTML = mensaje;
}

function validarCreacionProveedor(selector, mensajeConfirmacion, urlRedireccion) {
    var crearForm = document.querySelector(selector);
    crearForm.addEventListener('submit', function (event) {
        event.preventDefault();
        if (validarFormularioCrear(event)) {
            Swal.fire({
                title: mensajeConfirmacion,
                text: '¡Asegurate de tener los datos correctos!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Obtener los valores de los campos del formulario
                    var nombre = crearForm.querySelector('#nombre').value;
                    var telefono = crearForm.querySelector('#telefono').value;
                    var descripcion = crearForm.querySelector('#descripcion').value;
                    var correo = crearForm.querySelector('#correo').value;
                    var direccion = crearForm.querySelector('#direccion').value;
                    var categoria = crearForm.querySelector('#categoria').value;
                    var informacionAdicional = crearForm.querySelector('#informacionadicional').value;

                    // Crear el cuerpo JSON del proveedor
                    var proveedor = {
                        nombreProveedor_Proveedor: nombre,
                        telefonoProveedor_Proveedor: telefono,
                        descripcionProveedor_Proveedor: descripcion,
                        correo_Proveedor: correo,
                        direccionProveedor_Proveedor: direccion,
                        categoriaServicio_Proveedor: categoria,
                        informacionAdicional_Proveedor: informacionAdicional
                    };

                    // Realizar una petición AJAX o enviar el formulario de forma asíncrona
                    fetch(crearForm.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(proveedor)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Si el proceso de agregar el cliente fue exitoso, mostrar mensaje de éxito
                                mostrarToastConfirmacion(data.message);
                                // Redirigir después de un pequeño retraso
                                setTimeout(function () {
                                    window.location.href = urlRedireccion;
                                }, 1000); // 1000 milisegundos de retraso
                            } else {
                                // Si el proceso de agregar el cliente falló, mostrar mensaje de error
                                mostrarToastError(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        }
    });
}

// Función para mostrar un Toast de error
function mostrarToastError(mensaje) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 2500
    });
    Toast.fire({
        icon: 'error',
        title: mensaje
    });
}

// Función para mostrar un Toast de confirmación
function mostrarToastConfirmacion(titulo) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 2500
    });
    Toast.fire({
        icon: 'success',
        title: titulo
    });
}

function validarEliminacionProveedor(selector, mensajeConfirmacion, urlRedireccion) {
    var deleteButtons = document.querySelectorAll(selector);
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var url = this.querySelector('a').getAttribute('href');
            Swal.fire({
                title: mensajeConfirmacion,
                text: '¡No podrás revertir esto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar una petición AJAX para eliminar el proveedor
                    fetch(url, {
                        method: 'DELETE'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Si el proceso de eliminación fue exitoso, mostrar mensaje de éxito
                                mostrarToastConfirmacion(data.message);
                                // Redirigir después de un pequeño retraso
                                setTimeout(function () {
                                    window.location.href = urlRedireccion;
                                }, 1000); // 1000 milisegundos de retraso
                            } else {
                                // Si el proceso de eliminación falló, mostrar mensaje de error
                                mostrarToastError(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });
    });
}
