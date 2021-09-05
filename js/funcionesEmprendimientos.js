var categorias= ['Panaderia', 'Venta de ropa', 'Herreria']

//Construir Barra de busqueda
function constructorBarraBusqueda() {
   let header = document.getElementById('header');
   let divCategoriasBusqueda = document.createElement('div');
      divCategoriasBusqueda.classList.add('contenedorCategoriasBuscar');
   let inputCategorias = document.createElement('input');
      inputCategorias.setAttribute('type','checkbox');
      inputCategorias.setAttribute('id','check');
   let labelCategorias = document.createElement('label');
      labelCategorias.setAttribute('for','check');
      labelCategorias.classList.add('icon-menu');
      labelCategorias.innerText = 'CATEGORIAS'
   let divContenedorBuscar = document.createElement('div');
      divContenedorBuscar.classList.add('contenedorBuscar');
   let inputBuscar = document.createElement('input');
      inputBuscar.setAttribute('type','search');
      inputBuscar.setAttribute('id','search');
      inputBuscar.setAttribute('placeholder','BUSCAR');
   let btnBuscar = document.createElement('button');
      btnBuscar.classList.add('icon');
      btnBuscar.setAttribute('id','btnsearch');
   let iBuscar = document.createElement('i');
      iBuscar.classList.add('fa', 'fa-search')
   btnBuscar.appendChild(iBuscar);
   divContenedorBuscar.appendChild(inputBuscar);
   divContenedorBuscar.appendChild(btnBuscar);
   let nav = document.createElement('nav');
      nav.classList.add('categorias');
   let ulnav = document.createElement('ul');
      ulnav.setAttribute('id', 'ulnav')
   nav.appendChild(ulnav);

   divCategoriasBusqueda.appendChild(inputCategorias);
   divCategoriasBusqueda.appendChild(labelCategorias);
   divCategoriasBusqueda.appendChild(divContenedorBuscar);
   divCategoriasBusqueda.appendChild(nav);
   header.appendChild(divCategoriasBusqueda);
   categoria(categorias)

}
constructorBarraBusqueda()
//Cargar datos de las categorias
function categoria(categorias){
  
   categorias.forEach(element => {
      let ulNav = document.getElementById('ulnav');
      let linav = document.createElement('li');
      linav.innerText= element;
      ulNav.appendChild(linav);
   })
}
//Generador card emprendimientos 
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
     
          imgCuerpoCardFont.setAttribute('src', element.imagenes[0]);

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
//Funcion buscador 
function buscarEmprendimientos () {
   
   
}


