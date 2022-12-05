let myModal = new bootstrap.Modal(document.getElementById("myModal"));

let botonAnda = document.getElementById("tipoTurno");

botonAnda.addEventListener("change", () => {
    let turnos = [];

    let tipoTurno = document.getElementById("tipoTurno").value;

    $.ajax({
        type: "POST",
        url: "/turnos/mostrarTurno",
        data: {
            id: tipoTurno,
            _token: $('input[name="_token"]').val(),
        },
    }).done(function (res) {
        let arregloDatos = JSON.parse(res);

        let longitud = arregloDatos.length;

        for (let x = 0; x < longitud; x++) {
            turnos[x] = {
                id: arregloDatos[x].id,
                title: arregloDatos[x].title,
                start: arregloDatos[x].start,
                navLinks: false,
                editable: false,
                /*  height: 100,
                 width: 400 ,  */
                color: "purple",
                /*   backgroundColor: '#ffffff',
                 textColor:'#000000' */
            };
            /*      console.log(turnos[x].start+" tipo start " + typeof(turnos[x].start));
        console.log(turnos[x].end+" tipo end " + typeof(turnos[x].end));     */
        }

        let calendarEl = document.getElementById("agenda");
        calendarEl.style.display = "block";
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "timeGridWeek",
            locale: "es",

            headerToolbar: {
                left: "prev,next", // izquieda anterior y siguiente
                center: "title", //titulo en el centro
                /*  right: 'today,dayGridMonth,timeGridWeek',  */
                right: "timeGridWeek", //derecha hoy , mes, semana
            },
            eventClick: function (info) {
                /*     info.el.style.borderColor = 'red'; */

                let tituloTipo = document.getElementById("tituloTipo");
                let tipoHora = document.getElementById("turnoHora");
                let textoTurno = document.getElementById("textoTurno"); //verifica si tiene algo o no el turno

                let auxHora;
                let fechaFormato;

                if (info.event.start.getMinutes() < 10) {
                    //para agregar el cero que falta cuando lo muetras en pantalla
                    auxHora =
                        info.event.start.getHours() +
                        ":" +
                        "0" +
                        info.event.start.getMinutes();
                } else {
                    auxHora =
                        info.event.start.getHours() +
                        ":" +
                        info.event.start.getMinutes();
                }
                //una vez que le dio formato a la hora, lo vamos a imprimir en el formulario

                /*      tipoHora.innerHTML=`<input type="radio" id="${info.event.id}" name="horario" class="mp-2" value='${info.event.start.getHours()+":"+info.event.start.getMinutes()}'>Usted ha
                  seleccionado el turno del día ${info.event.start.getDate()+' /'+(info.event.start.getMonth()+1)+' /'+info.event.start.getFullYear()} a las ${auxHora} <br> <strong>¿Confirma los datos? </strong>` 
                  tituloTipo.innerHTML= `${info.event.title}`; 
                    //modal, guarda la turno y mostrar en el formulario  */

                fechaFormato =
                    info.event.start.getDate() +
                    " /" +
                    (info.event.start.getMonth() + 1) +
                    " /" +
                    info.event.start.getFullYear();

                tipoHora.innerHTML = `<input type="hidden" id="${
                    info.event.id
                }" name="horario"  class="horario mp-2" value='${
                    info.event.start.getHours() +
                    ":" +
                    info.event.start.getMinutes()
                }'>
                    <p> Usted ha
                    seleccionado el turno del día <span class="text-info"> ${
                        info.event.start.getDate() +
                        " /" +
                        (info.event.start.getMonth() + 1) +
                        " /" +
                        info.event.start.getFullYear()
                    }</span> a las <br> <span class="text-info">${auxHora}</span> <br> <strong>¿Confirma los datos? </strong>
                    </p>
                    `;
                tituloTipo.innerHTML = `${info.event.title}`;

                let guardarModal = document.getElementById("guardarModal");

                guardarModal.addEventListener("click", () => {
                    //se enconde el calendario le cambiamos el comportamiento
                    calendarEl.style.display = "none";

                    /*    textoTurno.innerHTML = `<label for="exampleFormControlInput1">Horario Seleccionado</label><input type="text" class="form-control " name="horarioSeleccion" value='${info.event.start.getHours()+":"+info.event.start.getMinutes()} 'input readonly onmousedown="return false;" /></div>  */
                    textoTurno.innerHTML = `<label for="diaHora" class="formulario__label">Día y Horario Seleccionado</label><input type="text" class="form-control horarioSeleccion text-center" name="horarioSeleccion" value='${fechaFormato} a las ${auxHora}'input readonly onmousedown="return false;" /> </div>
                      <input type="hidden" name="idTurno" value='${info.event.id} '/><div class="contenedorNuevo"><i class="fas fa-check-circle"></i> </div> 
                      `;
                    textoTurno.value = "true";
                    console.log(textoTurno.value);
                });

                myModal.show();
            },
            views: {
                timeGridWeek: {
                    type: "timeGridWeek",
                    duration: { days: 3 },
                    buttonText: "Semana",
                    display: "inverse-background",
                },
            },
            events: turnos,
        });

        calendar.render();
    });
});
