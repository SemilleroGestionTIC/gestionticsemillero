function validarFormulario() {
    // Obtiene los valores de los campos
    var documento = document.getElementById("documento").value;
    var nombre = document.getElementById("nombre").value;
    var carrera = document.getElementById("carrera").value;
    var semestre = document.getElementById("semestre").value;
    var correo = document.getElementById("correo").value;

    // Verificación del número de documento (10 dígitos)
    var documentoRegex = /^\d{10}$/;
    if (!documentoRegex.test(documento)) {
        alert("El número de documento debe tener exactamente 10 dígitos.");
        return false;
    }

    // Verificación del nombre (solo letras)
    var nombreRegex = /^[a-zA-Z\s]+$/;
    if (!nombreRegex.test(nombre)) {
        alert("El nombre solo debe contener letras.");
        return false;
    }

    // Verificación de la carrera (solo letras)
    var carreraRegex = /^[a-zA-Z\s]+$/;
    if (!carreraRegex.test(carrera)) {
        alert("La carrera solo debe contener letras.");
        return false;
    }

    // Verificación del semestre (número entre 1 y 12)
    if (semestre < 1 || semestre > 12 || isNaN(semestre)) {
        alert("El semestre debe ser un número entre 1 y 12.");
        return false;
    }

    // Verificación del correo (formato válido)
    var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(correo)) {
        alert("Por favor, ingrese un correo válido.");
        return false;
    }

    return true; // Si todo está bien, el formulario se envía
}