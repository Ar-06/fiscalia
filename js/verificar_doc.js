function verificarDocumento() {
    var tipoDoc = document.querySelector('select[name="TipoDoc"]').value;
    var numDoc = document.querySelector('input[name="numDoc"]').value;
    var contra1 = document.getElementById('contra1');
    var contra2 = document.getElementById('contra2');
    var mensaje = '';

    if (tipoDoc == '1') {
        if (numDoc.length !== 8) {
            mensaje = 'El número de DNI debe tener 8 dígitos.';
        }
    } else if (tipoDoc == '2') {
        if (numDoc.length !== 9) {
            mensaje = 'El número de Carné de extranjería debe tener 9 dígitos.';
        }
    } else if (tipoDoc == '3') {
        if (numDoc.length !== 11) {
            mensaje = 'El número de Registro Único de Contribuyente debe tener 11 dígitos.';
        }
    }

    if(contra1.textContent !== contra2.textContent){
        mensaje = 'Las contraseñas no coinciden.';
    }

    if (mensaje) {
        alert(mensaje);
        return false;
    }
    return true;
}