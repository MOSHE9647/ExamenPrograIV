<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html xmlns:th="http://thymeleaf.org">

<head>
    <title>Administracion de proveedores</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- JS de Bootstrap (opcional, para funcionalidades como dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/proveedorStyles.css') }}">
    <script type="text/javascript" src="{{ asset('js/scriptProveedores.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}" />
    <script src="https://kit.fontawesome.com/a2dd6045c4.js"></script>
    <script src="https://kit.fontawesome.com/51553d23ad.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/paginacion.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/buscador.css') }}" />
</head>

<body>

    <div class="wrapper">

        <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <img th:src="@{/img/logo.png}" alt="Logo">
            </header>
            <nav>
                <ul class="menu">
                    <li>
                        <button id="todos" class="boton-menu boton-categoria"
                            onclick="window.location.href = '/index'"><i class="bi bi-hand-index-thumb"></i>
                            Inicio</button>
                    </li>
                    <li>
                        <button id="todos" class="boton-menu boton-categoria"
                            onclick="window.location.href = '/apartados/listar'"><i class="bi bi-hand-index-thumb"></i>
                            Apartados</button>
                    </li>

                    <li><button id="empleados" class="boton-menu boton-categoria"
                            onclick="window.location.href = '/empleados/listar'"><i class="bi bi-hand-index-thumb"></i>
                            Empleados</button></li>

                    <li>
                        <button id="camisetas" class="boton-menu boton-categoria active"><i
                                class="bi bi-hand-index-thumb-fill"></i> Proveedores</button>
                    </li>
                    <li>
                        <button id="camisetas" class="boton-menu boton-categoria"
                            onclick="window.location.href = '/ordenes_compra/listar'"><i
                                class="bi bi-hand-index-thumb"></i> Ordenes de Compra</button>
                    </li>
                    <li>
                        <button id="pantalones" class="boton-menu boton-categoria"
                            onclick="window.location.href = '/clientes/listar'"><i class="bi bi-hand-index-thumb"></i>
                            Clientes</button>
                    </li>
                    <li>
                        <button id="pantalones" class="boton-menu boton-categoria"
                            onclick="window.location.href = '/envios/listar'"><i class="bi bi-hand-index-thumb"></i>
                            Envios</button>
                    </li>
                    <li>
                        <button class="boton-menu boton-categoria" onclick="window.location.href='/productos/listar'">
                            <i class="bi bi-hand-index-thumb"></i> Productos
                        </button>
                    </li>
                    <li>
                        <button class="boton-menu boton-categoria" onclick="window.location.href='/ofertas/listar'">
                            <i class="bi bi-hand-index-thumb"></i> Ofertas
                        </button>
                    </li>
                    <li>
                        <button id="pantalones" class="boton-menu boton-categoria"
                            onclick="window.location.href = '/facturas/listar'"><i class="bi bi-hand-index-thumb"></i>
                            Facturas</button>
                    </li>
                    <li>
                        <button id="facturas" class="boton-menu boton-categoria"
                            onclick="window.location.href = '/pedidos/listar'"><i class="bi bi-hand-index-thumb"></i>
                            Pedidos</button>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer">© Proyecto Progra 4</p>
            </footer>
        </aside>
        <main>
            <div class="title-admin-pro-container">
                <h1>Panel de administración de proveedores</h1>
            </div>

            <div class="create-button-container">
                <div class="create-button_container">
                    <button class="add_new">Crear nuevo</button>
                </div>
            </div>
            <br><br>
            <div id="editar_proveedor_container">

            </div>
            <div class="tb-container">
                @if (!empty($proveedores) && count($proveedores) > 0)
                    <table class="contenedor-productos table table-striped table-hover">
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Categoría</th>
                            <th>Opciones</th>
                        </tr>
                        @foreach ($proveedores as $proveedor)
                            <tr>
                                <td>{{ $proveedor['nombreProveedor'] }}</td>
                                <td>{{ $proveedor['telefonoProveedor'] }}</td>
                                <td>{{ $proveedor['correo'] }}</td>
                                <td>{{ $proveedor['categoriaServicio'] }}</td>
                                <td>
                                    <button type="button" class="producto-editar btn_editar"
                                        value="{{ $proveedor['idProveedor'] }}"><i class="bi bi-pen"></i></button>
                                    <br> -----
                                    <br>
                                    <button class="btn_delete producto-eliminar">
                                        <a class="btn_eliminar"
                                            href="{{ 'http://localhost:3000/ProveedoresEliminar/' . $proveedor['idProveedor'] }}"><i
                                                class="bi bi-trash"></i></a>
                                    </button>
                                    <br> -----
                                    <br>
                                    <button type="button" class="btn_detalles"
                                        value="{{ $proveedor['idProveedor'] }}"><i
                                            class="fa-solid fa-circle-info"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="{{ asset('js/alertScript.js') }}"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            validarEliminacionProveedor('.btn_delete', "¿Estás seguro?", '/');

                            // Obtener todos los botones de detalles y agregar un evento clic a cada uno
                            var botonesEditar = document.querySelectorAll('.btn_editar');
                            botonesEditar.forEach(function(boton) {
                                boton.addEventListener('click', function() {
                                    // Obtener el valor (ID del producto) del botón clicado
                                    var idProveedor = this.value;
                                    //alert("ID del producto: " + idProveedor);
                                    //window.location.href="/editarProveedor/"+idProveedor;

                                    $.ajax({
                                        url: '/editarProveedor/' + idProveedor,
                                        method: 'GET',
                                        success: function(response) {
                                            $('#editar_proveedor_container').html(response);
                                        },
                                        error: function(xhr) {
                                            console.error('Error al cargar el formulario:', xhr);
                                        }
                                    });
                                });
                            });
                            
                            var botonesDetalle = document.querySelectorAll('.btn_detalles');
                            botonesDetalle.forEach(function(boton) {
                                boton.addEventListener('click', function() {
                                    // Obtener el valor (ID del producto) del botón clicado
                                    var idProveedor = this.value;
                                    //alert("ID del producto: " + idProveedor);
                                    //window.location.href="/editarProveedor/"+idProveedor;

                                    $.ajax({
                                        url: '/detalleProveedor/' + idProveedor,
                                        method: 'GET',
                                        success: function(response) {
                                            $('#editar_proveedor_container').html(response);
                                        },
                                        error: function(xhr) {
                                            console.error('Error al cargar el formulario:', xhr);
                                        }
                                    });
                                });
                            });


                        });
                    </script>
                    <br><br>
                @else
                    <div>
                        <p>No se encontraron registros para mostrar.</p>
                    </div>
                @endif
            </div>



            <div type="hidden" id="myModalCrearCliente" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="container">
                        <form class="crear-cliente-form" id="form-crear"
                            action="http://localhost:3000/proveedoresAgregar" method="POST">
                            <label for="nombre">Nombre: </label>
                            <input type="text" name="nombre" id="nombre">
                            <br><br>
                            <label for="telefono">Teléfono: </label>
                            <input type="text" name="telefono" id="telefono">
                            <br><br>
                            <label for="descripcion">Descripción: </label>
                            <textarea name="descripcion" id="descripcion"></textarea>
                            <br><br>
                            <label for="correo">Correo: </label>
                            <input type="email" name="correo" id="correo">
                            <br><br>
                            <label for="direccion">Dirección: </label>
                            <input type="text" name="direccion" id="direccion">
                            <br><br>
                            <label for="categoria">Categoria: </label>
                            <input type="text" name="categoria" id="categoria">
                            <br><br>
                            <label for="informacionadicional">Información adicional: </label>
                            <textarea name="informacionadicional" id="informacionadicional"></textarea>
                            <br>
                            <div id="mensaje_container">
                                <p id="texto_error" style="color: red;"></p>
                            </div>
                            <br>
                            <input type="submit" id="submitButton" value="Registrar Proveedor">
                            <input type="button" value="Cancelar" onclick="cancelarCreacionButton()">
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="{{ asset('js/scriptModal.js') }}"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    validarCreacionProveedor('.crear-cliente-form',
                        '¿Estás seguro de continuar con la creación de este proveedor?', '/')
                });
            </script>
        </main>
    </div>
</body>

</html>
