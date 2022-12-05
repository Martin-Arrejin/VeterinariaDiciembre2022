const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const expresiones = {
    descripcion: /^([a-zA-Z0-9_\s\.]){1,50}$/, // Letras y espacios, pueden llevar acentos.
    minimoStock: /^[0-9]{1,3}$/, // Validar Numero de codigo Solo Numeros y longitud 4
    codigo: /^[0-9]{1,8}$/, // Validar Numero de codigo Solo Numeros y longitud 8
    iva: /^[0-9]{1,2}$/, // 0 - 2 numeros
    precioEspecial: /^[0-9]{1,8}$/, // 0 - 9 numeros
    precioVenta: /^[0-9]{1,8}$/, // 0 - 8 numeros
    marca: /^([a-zA-Z0-9_\s\.]){1,20}$/, // Letras y espacios, pueden llevar acentos.
    alerta: /^[0-9]{1,3}$/, // Validar Numero de codigo Solo Numeros y longitud 3
};
const campos = {
    descripcion: false,
    minimoStock: false,
    codigo: false,
    iva: false,
    precioEspecial: false,
    seleccionTurno: false,
    precioVenta: false,
    marca: false,
    alerta: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "descripcion":
            validarCampo(expresiones.descripcion, e.target, "descripcion");
            break;
        case "minimoStock":
            validarCampo(expresiones.minimoStock, e.target, "minimoStock");
            break;
        case "iva":
            validarCampo(expresiones.iva, e.target, "iva");
            break;
        case "codigo":
            validarCampo(expresiones.codigo, e.target, "codigo");
            break;
        case "precioEspecial":
            validarCampo(
                expresiones.precioEspecial,
                e.target,
                "precioEspecial"
            );
            break;
        case "precioVenta":
            validarCampo(expresiones.precioVenta, e.target, "precioVenta");
            break;
        case "marca":
            validarCampo(expresiones.marca, e.target, "marca");
            break;
        case "alerta":
            validarCampo(expresiones.alerta, e.target, "alerta");
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
for (let i = 0; i < longitud; i++) {
    inputs[i].addEventListener("keyup", validarFormulario); //cuando se levante la tecla
    inputs[i].addEventListener("blur", validarFormulario); //cuando le de un click fuera del imput */ */
}

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    if (
        campos.descripcion &&
        campos.minimoStock &&
        campos.codigo &&
        campos.iva &&
        campos.precioEspecial &&
        campos.precioVenta &&
        campos.marca &&
        campos.alerta
    ) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Artículo Guardado",
            showConfirmButton: false,
            timer: 4000,
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

let descripcion = document.getElementsByName("descripcion");
let minimoStock = document.getElementsByName("minimoStock");
let iva = document.getElementsByName("iva");
let codigo = document.getElementsByName("codigo");
let precioEspecial = document.getElementsByName("precioEspecial");
let precioVenta = document.getElementsByName("precioVenta");
let marca = document.getElementsByName("marca");
let alerta = document.getElementsByName("alerta");
let formulario__mensaje = document.getElementById("formulario__mensaje");

validarCampo(expresiones.descripcion, descripcion[0], "descripcion");
validarCampo(expresiones.minimoStock, minimoStock[0], "minimoStock");
validarCampo(expresiones.iva, iva[0], "iva");
validarCampo(expresiones.codigo, codigo[0], "codigo");
validarCampo(expresiones.precioEspecial, precioEspecial[0], "precioEspecial");
validarCampo(expresiones.precioVenta, precioVenta[0], "precioVenta");
validarCampo(expresiones.marca, marca[0], "marca");
validarCampo(expresiones.alerta, alerta[0], "alerta");

formulario__mensaje.style.display = "none";
