const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");


const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,30}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZÀ-ÿ\s]{1,30}$/, // Letras y espacios, pueden llevar acentos.
    dni: /^[0-9]{1,8}$/, // Validar Numero de Dni Solo Numeros y longitud 8
    telefono: /^[0-9]{1,7}$/, // 0 - 9 numeros
    codigoArea: /^[0-9]{1,7}$/, // 0 - 9 numeros
    numeroCalle:/^[0-9]{1,5}$/, // 0 - 5 numeros
    direccion: /^([a-zA-Z0-9_\s\.]){1,30}$/, // Letras y espacios, pueden llevar acentos.
};
const campos = {
    nombre: false,
    apellido: false,
    dni: false,
    telefono: false,
    codigoArea: false,
    seleccionTurno: false,
    numeroCalle:false,
    direccion:false,

};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, "nombre");
            break;
        case "apellido":
            validarCampo(expresiones.apellido, e.target, "apellido");
            break;
        case "telefono":
            validarCampo(expresiones.telefono, e.target, "telefono");
            break;
        case "dni":
            validarCampo(expresiones.dni, e.target, "dni");
            break;
        case "codigoArea":
            validarCampo(expresiones.codigoArea, e.target, "codigoArea");
            break;
        case "numeroCalle":
            validarCampo(expresiones.numeroCalle, e.target, "numeroCalle");
            break;
        case "direccion":
            validarCampo(expresiones.direccion, e.target, "direccion");
            break;
    }
};

const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document
            .getElementById(`grupo__${campo}`)
            .classList.remove("formulario__grupo-incorrecto");
        document
            .getElementById(`grupo__${campo}`)
            .classList.add("formulario__grupo-correcto");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.remove("fa-times-circle");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.add("fa-check-circle");
        document
            .querySelector(`#grupo__${campo} .formulario__input-error`)
            .classList.remove("formulario__input-error-activo");
        campos[campo] = true;
    } else {
        document
            .getElementById(`grupo__${campo}`)
            .classList.add("formulario__grupo-incorrecto");

        document
            .querySelector(`#grupo__${campo} i`)
            .classList.remove("fa-check-circle");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.add("fa-times-circle");
        document
            .querySelector(`#grupo__${campo} .formulario__input-error`)
            .classList.add("formulario__input-error-activo");
        campos[campo] = false;
    }
};

inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario); //cuando se levante la tecla
   input.addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
});

// Botón Cancelar
document.getElementById("cancelar").addEventListener("click", () => {

    document
        .querySelectorAll(".formulario__grupo-correcto")
        .forEach((icono) => {
            icono.classList.remove("formulario__grupo-correcto");
            formulario.reset();
        });
    document
        .querySelectorAll(".formulario__grupo-incorrecto")
        .forEach((icono) => {
            icono.classList.remove("formulario__grupo-incorrecto");
            icono.classList.remove("formulario__input-error-activo");
            formulario.reset();
        });
    document
        .querySelectorAll(".formulario__input-error-activo")
        .forEach((icono) => {
            icono.classList.remove("formulario__input-error-activo");
            formulario.reset();
        });
});