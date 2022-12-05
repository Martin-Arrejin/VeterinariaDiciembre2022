
let calles = [
   
"25 De Junio",
"25 De Mayo",
"3 De Febrero",
"9 De Julio",
"Acceso Norte",
"Adolfo Alsina",
"Aldea Santa María",
"Alejandro Aguado",
"Almirante Guillermo Brown",
"Andrés Pazos",
"Antonio Crespo",
"Arturo Illia",
"Avenida Almafuerte",
"Bartolomé Mitre",
"Avenida Churruarin",
"Avenida Circunvalación José Hernández",
"Avenida De Las Américas",
"Avenida Don Bosco",
"Avenida Ejército",
"Avenida Jorge Newbery",
"Avenida Larramendi10",
"Avenida Laurencena",
"Avenida Mariano Moreno",
"Avenida Pedro Zanni",
"Avenida Racedo",
"Avenida Ramírez",
"Ayacucho",
"Blas Parera",
"Brasil",
"Buenos Aires",
"Carlos Gardel",
"Carlos Pellegrini",
"Casiano Calderón",
"Catamarca",
"Juan Carrigo",
"Cervantes",
"Chile",
"Cnel. Brandsen",
"Cnel. Juan Pirán",
"Cnel. Vicente Dupuy",
"Colón",
"Concordia",
"Córdoba",
"Corrientes",
"Courreges",
"Crisólogo Larralde",
"Cura Alvarez",
"Del Barco Centenera",
"Diamante",
"Díaz Vélez",
"División De Los Andes",
"Domínguez",
"Don Segundo Sombra",
"Ecuador",
"El Paracao",
"El Plumerillo",
"Enrique Carbo",
"Ernesto Bavio",
"España",
"Feliciano",
"Formosa",
"Francisco De Miranda",
"Francisco Soler",
"Fraternidad",
"Fray Mocho",
"Gabriela Mistral",
"Gdor. Basavilbaso",
"Gdor. Crespo",
"Gdor. Enrique Mihura",
"Gdor. Ramón Febre",
"Gdor. Tibiletti",
"Gral. Alvarado",
"Gral. Gervasio Artigas",
"Gral. José M. Galán",
"Gral. Justo José De Urquiza",
"Gral. Manuel Belgrano",
"Gral. Pedro Ferre",
"Gral. San Martín",
"Gran Chaco",
"Guillermo Bonaparte",
"Gutiérrez",
"Hernandarias",
"Hipólito Yrigoyen",
"Italia",
"Ituzaingó",
"Jorge Newbery",
"José Ruperto Pérez",
"Juan Báez",
"Juan Vucetich",
"La Paz",
"La Rioja",
"Las Garzas",
"Avenida Laurencena",
"Leandro N. Alem",
"Libertad",
"López",
"Los Alamos",
"Los Ceibos",
"Los Dragones De Entre Ríos",
"Los Naranjos",
"Los Tilos",
"Los Vascos",
"Maipú",
"Malvinas",
"Méjico",
"Mendoza",
"Miguel David",
"Misiones",
"Monseñor José Dobler",
"Monte Caseros",
"Montevideo",
"Nogoyá",
"O Brien",
"O Higgins",
"Ovidio Lagos",
"Pablo Lorentz",
"Padre Bartolomé Grella",
"Panamá",
"Paraguay",
"Salvador Caputto",
"Pascual Palma",
"Patagonia",
"Pcia. De Entre Ríos",
"Pcias. Unidas",
"Pedro Balcar",
"Pedro Echagüe",
"Perú",
"Pres. Juan Domingo Perón",
"Pronunciamiento",
"Raúl Zaccaro",
"Avenida Gualeguaychú",
"Río Negro",
"Rondeau",
"Rosario Del Tala26",
"S. Vázquez",
"Salta",
"Salustiano Zavalía",
"Salvador Macia",
"San Juan",
"San Lorenzo",
"San Luis",
"Santa Cruz",
"Santa Fe",
"Santiago De Liniers",
"Santiago Del Estero",
"Santos Vega",
"Selva De Montiel",
"Tomás De Rocamora",
"Torra",
"Tucumán",
"Uruguay",
"Victoria",
"Villaguay",
"Zapata",

       
  ];
 
  //Sort names in ascending order
  let sortedNames = calles.sort();
  //reference
  let input = document.getElementById("input");
  
  //Execute function on keyup
  input.addEventListener("keyup", (e) => {
    //loop through above array
    //Initially remove all elements ( so if user erases a letter or adds new letter then clean previous outputs)
   removeElements();
    for (let i of sortedNames) {
      //convert input to lowercase and compare with each string
  
      if (
        i.toLowerCase().startsWith(input.value.toLowerCase()) &&
        input.value != "") {
       //reate li element
        let listItem = document.createElement("li");
        //One common class name
        listItem.classList.add("list-items");
        listItem.style.cursor = "pointer";
        listItem.setAttribute("onclick", "displayNames('" + i + "')");
        //Display matched part in bold
        let word = "<b>" + i.substr(0, input.value.length) + "</b>";
       word += i.substr(input.value.length);
       //display the value in array
        listItem.innerHTML = word;
        document.querySelector(".list").appendChild(listItem);
      }
    }
  });
  function displayNames(value) {
   input.value = value;
   removeElements();
  }
  function removeElements() {
    //clear all the item
    let items = document.querySelectorAll(".list-items");
    items.forEach((item) => {
     item.remove();
   });
  }
  