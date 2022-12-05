/* const { component } = require("vue/types/umd"); */

const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");
let calendario = document.getElementById("agenda");
let textoTurno = document.getElementById("textoTurno");


const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    dni: /^[0-9]{1,8}$/, // Validar Numero de Dni Solo Numeros y longitud 8
    telefono: /^[0-9]{1,7}$/, // 0 - 9 numeros
    codigoArea: /^[0-9]{1,7}$/, // 0 - 9 numeros
    asunto: /^[a-z0-9A-ZÀ-ÿ\s]{1,80}$/
};
const campos = {
    nombre: false,
    apellido: false,
    dni: false,
    telefono: false,
    codigoArea: false,
    seleccionTurno: false,
    asunto:false
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
        case "asunto":
        validarCampo(expresiones.asunto, e.target, "asunto");
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
    input.addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput
});

// Botón Cancelar
document.getElementById("cancelar").addEventListener("click", () => {
    //enconde el calendario
    calendario.style.display = "none";
    //elimina el turno, si pone boton cancelar
    let botonAceptar =  document.getElementById('botonAceptar');
    botonAceptar.disabled = false;  

    let nuevaHora = document.getElementById("textoTurno");
    nuevaHora.innerHTML = " ";
    //elimina iconos , y mensaje de error,
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

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    console.log(textoTurno.value);
    if (textoTurno.value == "true") {
        campos["seleccionTurno"] = true;
        console.log(textoTurno.value);
    } else {
    }

    if (
        campos.nombre &&
        campos.apellido &&
        campos.dni &&
        campos.telefono &&
        campos.codigoArea &&
        campos.seleccionTurno  &&
        campos.asunto
    ) {
        Swal.fire({
            position: "top-center",
            color: "#000",
            icon: "success",
            background: "#fff",
            backdrop: `
			rgba(100, 83, 153, 0.6)  `,
            title: '<h4 class="text-dark">El Formulario se envio exitosamente.  <br> Cualquier consulta, no dudes en contactarte con nosotros.<br> Muchas Gracias &#128512; !!!</h4> ',
            showConfirmButton: false,
            timer: 8000,
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
        document
            .getElementById("formulario__mensaje")
            .classList.add("formulario__mensaje-activo");
        setTimeout(() => {
            document
                .getElementById("formulario__mensaje")
                .classList.remove("formulario__mensaje-activo");
        }, 4000);
    }
});
