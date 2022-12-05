const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZÀ-ÿ\s]{2,30}$/, // Letras y espacios, pueden llevar acentos.
    dni: /^[0-9]{1,8}$/, // Validar Numero de Dni Solo Numeros y longitud 8
    numeroCalle: /^[0-9]{1,5}$/, // 0 - 5 numeros
    direccion: /^([a-zA-Z0-9_\s\.]){1,30}$/, // Letras y espacios, pueden llevar acentos.
};
const campos = {
    nombre: false,
    apellido: false,
    dni: false,
    seleccionTurno: false,
    numeroCalle: false,
    direccion: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, "nombre");
            break;
        case "apellido":
            validarCampo(expresiones.apellido, e.target, "apellido");
            break;
        case "dni":
            validarCampo(expresiones.dni, e.target, "dni");
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
let longitud = inputs.length;
for (let i = 2; i < longitud - 1; i++) {
    inputs[i].addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    inputs[i].addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
}

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    if (
        campos.nombre &&
        campos.apellido &&
        campos.dni &&
        campos.direccion &&
        campos.numeroCalle
    ) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Cliente Guardado",
            showConfirmButton: false,
            timer: 3000,
        });
        /* 		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo'); */
        setTimeout(() => {
            /* 	document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo'); */

            formulario.submit();
        }, 3000);

        document
            .querySelectorAll(".formulario__grupo-correcto")
            .forEach((icono) => {
                icono.classList.remove("formulario__grupo-correcto");
            });
    } else {
        console.log("entro a la parte de mostrar el mensaje de error ");
        document
            .getElementById("formulario__mensaje")
            .classList.add("formulario__mensaje-activo");
        setTimeout(() => {
            document
                .getElementById("formulario__mensaje")
                .classList.remove("formulario__mensaje-activo");
        }, 3000);
    }
});
//comprobar los input al inicio

let nombre = document.getElementsByName("nombre");
let apellido = document.getElementsByName("apellido");
let dni = document.getElementsByName("dni");
let numeroCalle = document.getElementsByName("numeroCalle");
let direccion = document.getElementsByName("direccion");
let formulario__mensaje = document.getElementById("formulario__mensaje");

validarCampo(expresiones.nombre, nombre[0], "nombre");
validarCampo(expresiones.apellido, apellido[0], "apellido");
validarCampo(expresiones.dni, dni[0], "dni");
validarCampo(expresiones.numeroCalle, numeroCalle[0], "numeroCalle");
validarCampo(expresiones.direccion, direccion[0], "direccion");
formulario__mensaje.style.display = "none";

//--------------------------------------------
