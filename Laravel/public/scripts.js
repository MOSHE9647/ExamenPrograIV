const api = axios.create({
    baseURL: 'http://localhost:3100',
    headers: {
        'Content-Type': 'application/json'
    }
});

function validarPasswords() {
    /* Obtenemos los valores de los campos de contraseña */
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    /* Verificamos que los campos de contraseña no estén vacíos */
    if (password === "") {
        mostrarMensaje("Error", "El campo 'Contraseña' no puede estar vacío", "error");
        return false;
    }
    if (confirmPassword === "") {
        mostrarMensaje("Error", "Debe confirmar la contraseña introducida", "error");
        return false;
    }

    /* Verificamos que las contraseñas coincidan */
    if (password !== confirmPassword) {
        mostrarMensaje("Error", "Las contraseñas no coinciden.", "error");
        return false;
    }

    // Si llegamos a este punto, las contraseñas son iguales y no están vacías
    return true;
}

function initializeToast() {
    const toast = document.querySelector(".notification-toast");
    const closeIcon = document.querySelector(".close");
    const progress = document.querySelector(".progress");
    let timer1, timer2;

    toast.classList.add("active");
    progress.classList.add("active");

    timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, 5000); // 1s = 1000 milliseconds

    timer2 = setTimeout(() => {
        progress.classList.remove("active");
    }, 5300);

    closeIcon.addEventListener("click", () => {
        toast.classList.remove("active");

        setTimeout(() => {
            progress.classList.remove("active");
        }, 300);

        clearTimeout(timer1);
        clearTimeout(timer2);
    });
}

function mostrarMensaje(titulo, mensaje, tipo) {
    var icono = "";
    if (tipo === 'success') {
        icono = 'la-check';
    } else if (tipo === 'error') {
        icono = 'la-times';
    } else if (tipo === 'warning') {
        icono = 'la-exclamation-triangle'
    }

    console.log('Mostrando Toast');

    var notificationHTML = `
        <div id="toastNotification" class="notification-toast">
            <div class="toast-content">
                <i class="fas fa-solid las ${icono} check ${tipo}"></i>
                <div class="message">
                    <span class="text text-1">${titulo}</span>
                    <span class="text text-2">${mensaje}</span>
                </div>
            </div>
            <i class="fa-solid las la-times close"></i>
            <div class="progress ${tipo}"></div>
        </div>
    `;
    var notificationContainer = document.getElementById('notification-container');
    notificationContainer.innerHTML = notificationHTML;
    initializeToast();
}