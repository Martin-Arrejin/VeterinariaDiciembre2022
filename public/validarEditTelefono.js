const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const expresiones = {
    telefono: /^[0-9]{1,7}$/, // 0 - 9 numeros
    codigoArea: /^[0-9]{3,7}$/, // 0 - 9 numeros
};
const campos = {
    telefono: false,
    codigoArea: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "telefono":
            validarCampo(expresiones.telefono, e.target, "telefono");
            break;

        case "codigoArea":
            validarCampo(expresiones.codigoArea, e.target, "codigoArea");
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

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    if (campos.telefono && campos.codigoArea) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Telefono Guardado",
            showConfirmButton: false,
            timer: 3000,
        });
        /* 		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo'); */
        setTimeout(() => {
            /* 	document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo'); */

            formulario.submit();
        }, 4000);

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

let telefono = document.getElementsByName("telefono");
let codigoArea = document.getElementsByName("codigoArea");
let formulario__mensaje = document.getElementById("formulario__mensaje");

validarCampo(expresiones.telefono, telefono[0], "telefono");
validarCampo(expresiones.codigoArea, codigoArea[0], "codigoArea");

formulario__mensaje.style.display = "none";

//--------------------------------------------
