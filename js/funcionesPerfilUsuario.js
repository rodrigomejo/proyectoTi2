const emprendimientos=[];
function datosUsuarios() {
   var xhr = new XMLHttpRequest();
   xhr.open('GET','./php/datosUsuario.php');
   xhr.onload = function () {
       if (xhr.status === 200) {
         var json = JSON.parse(xhr.responseText);
         console.log(json)
       }else {
          console.log("error")
       }
   }
   xhr.send();
}
datosUsuarios()
var categorias= ['Elige una opción ','Panaderia', 'Venta de ropa', 'Herreria']
//Construir select categorias
function construirSelectCategorias(datos){
   var select = document.getElementById('selectCategorias');
   for (let index = 0; index < datos.length; index++) {
      let option = document.createElement('option');
      option.setAttribute('value',index)
      option.innerText= datos[index];
      if (index=== 0) {
         option.setAttribute('selected','')
      }
      select.appendChild(option);
   }
}
construirSelectCategorias(categorias);
//Funcion capturar el valor del select 
document.getElementById('btnAgregar').addEventListener('click', ()=>{
   var select = document.getElementById('selectCategorias');
   var divcategorias = document.getElementsByClassName('divCategoriasP');
   if (select.value != 0) {
      let pcategorias = document.createElement('p');
      pcategorias.classList.add('categoriaP');
      pcategorias.innerText=select.children[select.value].textContent;
      divcategorias[0].appendChild(pcategorias);
      
      select.removeChild(select.children[select.value])
   }
})
//Capturar el input que realiza el evento change
function capturarInput(){
   var file =document.querySelectorAll('[type="file"]')
   file.forEach((accion) => {
      accion.addEventListener('change', pintarImg);
   });
}
capturarInput();
// pintar imagen 
function pintarImg(evt) {
   var files = evt.target.files;
   var reader = new FileReader();
   reader.onload = function(e) {
      var divImagen = evt.path[1];
      if (divImagen.getElementsByTagName('img').length === 0) {
         let imgemprendimiento = document.createElement('img');
         imgemprendimiento.setAttribute('src', e.target.result )
         divImagen.appendChild(imgemprendimiento);
         divImagen.style.background = 'none'; 
      }else{
         let imgemprendimiento = divImagen.getElementsByTagName('img')[0];
         imgemprendimiento.setAttribute('src', e.target.result)
      }
   };
   reader.readAsDataURL(files[0]);
}
//constructor de objeto de emprendimiento
function emprendimiento(nombre,descripcion,categoria,imagenes,direccion,telefono){
   this.nombre=nombre;
   this.descripcion=descripcion;
   this.categoria=categoria;
   this.imagenes = imagenes
   this.direccion=direccion;
   this.telefono=telefono;
}
//Capturar los datos del emprendimiento
document.getElementById("btnAgregarEmprendimiento").addEventListener('click', (e)=>{
   e.preventDefault();
   var categoriasp = document.getElementsByClassName('categoriaP');
   var nombre, direccion, telefono;
   var categoria= [];
    for (let index = 0; index < categoriasp.length; index++) {
         categoria[index] =categoriasp[index].textContent
      }
    let inputDatos = document.querySelectorAll('[type="text"]')
    inputDatos.forEach(element => {
      if (element.name=== 'nombre') {
         if (element.value !== '') {
               nombre=element.value
         } else { alert ("el nombre no puede estar vacio")}
      } else if (element.name=== 'direccion') {
         if (element.value !== '') {
               direccion= element.value
         } else { alert ("la direccion no puede estar vacia")}
      } else {
         if (element.value !== '') {
               telefono= element.value
         } else { alert ("El telefono no puede estar vacio")}  
      }
    });
     let ImgEmprendimiento = document.getElementsByClassName('divImgEmprendimiento')[0].getElementsByTagName('img')
     var imagenes =[];
      if (ImgEmprendimiento.length !== 0) {
         for (let index = 0; index < ImgEmprendimiento.length; index++) {
            imagenes[index]= ImgEmprendimiento[index].src  
         }
      }

    let descripcion = (document.querySelector('[name="descripcion"]').value !=='')? document.querySelector('[name="descripcion"]').value : alert ("El telefono no puede estar vacio")
   nuevoEmprendimiento = new emprendimiento(nombre,descripcion,categoria,imagenes,direccion,telefono);
   enviarEmprendimiento(nuevoEmprendimiento);
})

function enviarEmprendimiento(dato) {
   $.ajax({
      type: "POST",
      url: './php/altaEmprendimiento.php',
      data: {'nuevoEmprendimiento': JSON.stringify(dato)},//capturo array     
      success: function(dato){
         let check = document.getElementById('check-modal') ;
         let aceptarModal = document.getElementById('lblAceptarModal');
         let contenidoModal = document.getElementById('contenidoModal')
         if (dato === "1") {
            check.checked = true;
            aceptarModal.addEventListener('click', ()=>{
            window.location.reload();
         })
         }else if (dato ==="") {
            contenidoModal.childNodes[1].classList =""
            contenidoModal.childNodes[1].classList ="validacionEstado fas fa-times-circle"
            contenidoModal.childNodes[1].style.color= "red"
            contenidoModal.childNodes[3].innerText= "NO SE PUDO REGISTRAR EL EMPRENDIMIENTO"
            check.checked = true;
            aceptarModal.addEventListener('click', ()=>{
            contenidoModal.childNodes[1].classList =""
            contenidoModal.childNodes[1].classList ="validacionEstado fas fa-check-circle"
            contenidoModal.childNodes[1].style.color= "green"
            contenidoModal.childNodes[3].innerText= "EMPRENDIMIENTO REGISTRADO CON EXITO"
          })
         console.log(dato)
         }
      }
   });
}
