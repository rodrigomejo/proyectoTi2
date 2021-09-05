var emprendimientos =[
];
//Funcion generador Card
function generadorCard(emprendimientos) {
   let contenedorCardPrincipal = document.getElementById("contenedorCardPrincipal");

   emprendimientos.forEach(element => {

       let divConCard = document.createElement('div');
       divConCard.className = 'contenedorCard';

      let divCard = document.createElement('div');
       divCard.className = 'card';

      let divcardFront = document.createElement('div');
       divcardFront.className = 'cardFront';

      let divCuerpoCardFront = document.createElement('div');
       divCuerpoCardFront.className = 'cuerpoCardFront';

      let imgCuerpoCardFont = document.createElement('img');
      let aleatorio = numeroRandom(element.imagenes.length);
          imgCuerpoCardFont.setAttribute('src', element.imagenes[aleatorio]);

       let H2cuerpoCardFront = document.createElement('h2');
       H2cuerpoCardFront.innerText = element.nombre;
       divCuerpoCardFront.appendChild(imgCuerpoCardFont);
       divCuerpoCardFront.appendChild(H2cuerpoCardFront);
       divcardFront.appendChild(divCuerpoCardFront);

       let divcardBack = document.createElement('div');
       divcardBack.className = 'cardBack';

      let divCuerpoCardBack = document.createElement('div');
      divCuerpoCardBack.className = 'cuerpoCardBack';

       let H2cuerpoCardBack = document.createElement('h2');
       H2cuerpoCardBack.innerText = element.nombre;

       let PcuerpoCardBack = document.createElement('p');
       PcuerpoCardBack.innerText = element.descripcion;

       let inputcuerpoCardBack = document.createElement('input')
         inputcuerpoCardBack.setAttribute('type', "button");
         inputcuerpoCardBack.setAttribute('value', "Leer Más");

         divCuerpoCardBack.appendChild(H2cuerpoCardBack);
         divCuerpoCardBack.appendChild(PcuerpoCardBack);
         divCuerpoCardBack.appendChild(inputcuerpoCardBack);
         divcardBack.appendChild(divCuerpoCardBack);

         divCard.appendChild(divcardFront);
         divCard.appendChild(divcardBack);

         divConCard.appendChild(divCard);
         contenedorCardPrincipal.appendChild(divConCard);
   });

}
function numeroRandom(dato){
   
   let aleatorio = Math.random() * (dato);
       aleatorio = Math.floor(aleatorio);
       return aleatorio;
}