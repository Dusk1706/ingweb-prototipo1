document.addEventListener("DOMContentLoaded", function() {
    var cambiarChequesForm = document.getElementById('formCambiarCheques');
    if (cambiarChequesForm) {
        cambiarChequesForm.addEventListener('submit', function(e) {
            var importe = document.getElementById('importe').value;
            document.getElementById('importe-hidden').value = importe;
        });
    }

    var agregarDineroForm = document.querySelector('form[action="/agregar-dinero"]');
    if (agregarDineroForm) {
        agregarDineroForm.addEventListener('submit', function(e) {
            var importe = document.getElementById('importe').value;
            document.getElementById('importe-hidden-agregar').value = importe;
        });
    }

    var guardarEnCajaForm = document.getElementById('guardarenCaja');
    if (guardarEnCajaForm) {
        guardarEnCajaForm.addEventListener('submit', function(e) {
            var denominaciones = {};
            document.querySelectorAll('.denominacion-input').forEach(function(input) {
                var denominacion = input.getAttribute('data-denominacion');
                var cantidad = input.value;
                denominaciones[denominacion] = cantidad;
            });
            document.getElementById('denomDetalle-oculto').value = JSON.stringify(denominaciones);
        });
    }
});