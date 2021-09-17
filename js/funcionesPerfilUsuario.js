const emprendimientos=[];
//Funcion capturar el valor del select Categorias
document.getElementById('btnAgregar').addEventListener('click', ()=>{
   var select = document.getElementById('selectCategorias');
   var divcategorias = document.getElementsByClassName('divCategoriasP');
   if (select.value != 0) {
      let pcategorias = document.createElement('p');
      pcategorias.classList.add('categoriaP');
      pcategorias.innerText=select.options[select.selectedIndex].text;
      divcategorias[0].appendChild(pcategorias);
      
      select.removeChild(select.options[select.selectedIndex])
   }
})
document.getElementById('btnAgregarMod').addEventListener('click', ()=>{
   var formMod = document.getElementsByClassName('modificarEmprendimiento')[0]
   var select = document.getElementById('selectCategoriasMod');
   var divcategorias = formMod.getElementsByClassName('divCategoriasP');
   if (select.value != 0) {
      let pcategorias = document.createElement('p');
      pcategorias.classList.add('categoriaP');
      pcategorias.innerText=select.options[select.selectedIndex].text;
      divcategorias[0].appendChild(pcategorias);
      select.removeChild(select.options[select.selectedIndex])
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
   console.log("what?")
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
function objemprendimiento(id,nombre,descripcion,categoria,imagenes,direccion,telefono){
   if (id === 0) {
      this.nombre=nombre;
      this.descripcion=descripcion;
      this.categoria=categoria;
      this.imagenes = imagenes
      this.direccion=direccion;
      this.telefono=telefono;
   }else{
      this.id = id;
      this.nombre=nombre;
      this.descripcion=descripcion;
      this.categoria=categoria;
      this.imagenes = imagenes
      this.direccion=direccion;
      this.telefono=telefono;
   }
  
}
//Quitar class error
function quitarClassError() {
   //Formulario Agregar emprendimientos
   let inputAgrEmprendimiento =document.getElementsByClassName('agregarEmprendimiento')[0].querySelectorAll('[type="text"]')
   let textAgrEmprendimiento = document.getElementsByClassName('agregarEmprendimiento')[0].querySelector('textarea')
   let divMsgDatosVacios = document.getElementsByClassName('msgDatosVacios')[0]
   inputAgrEmprendimiento.forEach(element =>{
      element.addEventListener('change', ()=>{
         if (element.className = "inputDatoError") {
            element.classList.remove('inputDatoError')
            element.classList.add('inputDato');
            divMsgDatosVacios.style.display = 'none';
         }
      })
   })
   textAgrEmprendimiento.addEventListener('change',()=>{
     if (textAgrEmprendimiento.className==="textareaDatoError") {
         textAgrEmprendimiento.classList.remove('textareaDatoError')
         textAgrEmprendimiento.classList.add('textareaDato');
         divMsgDatosVacios.style.display = 'none';
      } 
   })
    //Formulario Modificar emprendimientos
    let formModificar = document.getElementsByClassName('modificarEmprendimiento')[0]
    let inputModEmprendimiento = formModificar.querySelectorAll('[type="text"]')
    let textModEmprendimiento = formModificar.querySelector('textarea')
    let divMsgDatosModVacios = formModificar.getElementsByClassName('msgDatosVacios')[0]
    inputModEmprendimiento.forEach(elementMod =>{
       elementMod.addEventListener('change', ()=>{
         
          if (elementMod.className = "inputDatoModError") {
             elementMod.classList.remove('inputDatoModError')
             elementMod.classList.add('inputDatoMod');
             divMsgDatosModVacios.style.display = 'none';
          }
       })
    })
    textModEmprendimiento.addEventListener('change',()=>{
      if (textModEmprendimiento.className==="textareaDatoModError") {
          textModEmprendimiento.classList.remove('textareaDatoModError')
          textModEmprendimiento.classList.add('textareaModDato');
          divMsgDatosModVacios.style.display = 'none';
       } 
    })

   
}
quitarClassError()
//Capturar los datos del emprendimiento
document.getElementById("btnAgregarEmprendimiento").addEventListener('click', (e)=>{
   e.preventDefault();
   var categoriasp = document.getElementsByClassName('categoriaP');
   var categoria= [];
   for (let index = 0; index < categoriasp.length; index++) {
      categoria[index] =categoriasp[index].textContent
   }
   let ImgEmprendimiento = document.getElementsByClassName('divImgEmprendimiento')[0].getElementsByTagName('img')
   var imagenes =[];
   if (ImgEmprendimiento.length !== 0) {
      for (let index = 0; index < ImgEmprendimiento.length; index++) {
         imagenes[index]= ImgEmprendimiento[index].src  
      }
   }
   var nombre, direccion, telefono, descripcion ;
   let inputDatos = document.getElementsByClassName('agregarEmprendimiento')[0].querySelectorAll('[type="text"]')
   inputDatos.forEach(element => {
      switch (element.name) {
         case "nombre":
            if (element.value !== "") {
               nombre = element.value
            }else {
               element.classList.remove('inputDato')
               element.classList.add('inputDatoError');
            }
         break;
         case "direccion":
            if (element.value !== "") {
               direccion = element.value
            }else {
               element.classList.remove('inputDato')
               element.classList.add('inputDatoError');
            }
         break;
         case "telefono":
            if (element.value !== "") {
               telefono = element.value
            }else {
               element.classList.remove('inputDato')
               element.classList.add('inputDatoError');
            }
         break;
      }
   });
   var textArea = document.getElementsByClassName('agregarEmprendimiento')[0].querySelector('textarea');
   if (textArea.value !=="") {
      descripcion = textArea.value
   }else{
   textArea.classList.remove('textareaDato')
   textArea.classList.add('textareaDatoError')
   }
   if (nombre && direccion && telefono && descripcion !== "") {
         if (categoria.length === 0) {
            categoria[0]= "OTROS"  
         }
         id = 0;
       nuevoEmprendimiento = new objemprendimiento(id,nombre,descripcion,categoria,imagenes,direccion,telefono);
       enviarEmprendimiento(nuevoEmprendimiento);
   }else{
      document.getElementsByClassName('msgDatosVacios')[0].style.display = 'block';
   }
})
function enviarEmprendimiento(dato) {
   console.log(dato)
  if (dato['id'] !== undefined){
   $.ajax({
      type: "POST",
      url: './php/altaEmprendimiento.php',
      data: {'modEmprendimiento': JSON.stringify(dato)},//capturo array     
      success: function(dato){
         console.log(dato)
         let check = document.getElementById('check-modalModificar') ;
         let aceptarModal = document.getElementById('lblAceptarModalModificar');
         let contenidoModal = document.getElementById('contenidoModalModificar')
         if (dato === "1") {
            check.checked = true;
            aceptarModal.addEventListener('click', ()=>{
            window.location.reload();
         })
         }else if (dato ==="") {
            contenidoModal.childNodes[1].classList =""
            contenidoModal.childNodes[1].classList ="validacionEstado fas fa-times-circle"
            contenidoModal.childNodes[1].style.color= "red"
            contenidoModal.childNodes[3].innerText= "NO SE PUDO MODIFICAR EL EMPRENDIMIENTO"
            check.checked = true;
            aceptarModal.addEventListener('click', ()=>{
               check.checked = false;
            contenidoModal.childNodes[1].classList =""
            contenidoModal.childNodes[1].classList ="validacionEstado fas fa-check-circle"
            contenidoModal.childNodes[1].style.color= "green"
            contenidoModal.childNodes[3].innerText= "EMPRENDIMIENTO MODIFICADO CON EXITO"
          })
         }
      }
   });
  }else{
      $.ajax({
         type: "POST",
         url: './php/altaEmprendimiento.php',
         data: {'nuevoEmprendimiento': JSON.stringify(dato)},//capturo array     
         success: function(dato){
            let check = document.getElementById('check-modalAgregar') ;
            let aceptarModal = document.getElementById('lblAceptarModalAgregar');
            let contenidoModal = document.getElementById('contenidoModalAgregar')
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
                  check.checked = false;
               contenidoModal.childNodes[1].classList =""
               contenidoModal.childNodes[1].classList ="validacionEstado fas fa-check-circle"
               contenidoModal.childNodes[1].style.color= "green"
               contenidoModal.childNodes[3].innerText= "EMPRENDIMIENTO REGISTRADO CON EXITO"
            })
            }
         }
      });
  }
}
//Desplegar div
function  desplegarDiv(idButton) {
   var divNotificaciones = document.getElementById('contenedorNotificaciones');
   var divEmprendimientos = document.getElementById('contenedorFormEmpre');
   var divDatosUsuario = document.getElementById('contenedorDatosUsuario');
   var checkEmprendimientos = document.getElementById("checkemprendimientos");
   var h1separador = document.getElementById("h1Separador");
   var emprendimientos = document.getElementById('emprendimientos');
   var divAgregarEmprendimientos = document.getElementById('agregarEmprendimiento');
   var divEditarEmprendimientos = document.getElementById('editarEmprendimiento');
   switch(idButton.id) {
      case "lblNotificaciones":
         divNotificaciones.style.display = 'block';
         divEmprendimientos.style.display = 'none';
         divDatosUsuario.style.display = 'none';
         checkEmprendimientos.checked = false;
         h1separador.innerText = "";
         h1separador.innerText = "NOTIFICACIONES";
      break;
      case "lblEmprendimientos":
         divNotificaciones.style.display = 'none';
         divEmprendimientos.style.display = 'block';
         divDatosUsuario.style.display = 'none';
         emprendimientos.style.display = 'block';
         divAgregarEmprendimientos.style.display = 'none';
         divEditarEmprendimientos.style.display = 'none';
         h1separador.innerText = "";
         h1separador.innerText = "EMPRENDIMIENTOS";
      break;
      case "lblDatosUsuario":
         divNotificaciones.style.display = 'none';
         divEmprendimientos.style.display = 'none';
         divDatosUsuario.style.display = 'block';
         checkEmprendimientos.checked = false;
         h1separador.innerText = "";
         h1separador.innerText = "DATOS DEL USUARIO";
      break;
   }
}
function capturarlabel(){
   var file = document.querySelectorAll('.divOpcioneslabel');
   file.forEach((accion) => {
      accion.addEventListener('click', ()=>{desplegarDiv(accion)});
   });
}
capturarlabel()
function  desplegarDivEmprendimiento(idButton) {
   var divAgregarEmprendimientos = document.getElementById('agregarEmprendimiento');
   var divEditarEmprendimientos = document.getElementById('editarEmprendimiento');
   var divEmprendimientos = document.getElementById('emprendimientos');
   switch(idButton.id) {
      case "liAgregar":
         divAgregarEmprendimientos.style.display = 'block';
         divEditarEmprendimientos.style.display = 'none';
         divEmprendimientos.style.display = 'none';

      break;
      case "liModificar":
         divAgregarEmprendimientos.style.display = 'none';
         divEditarEmprendimientos.style.display = 'block';
         divEmprendimientos.style.display = 'none';
      break;
   }
}
function capturarli(){
   var file = document.querySelectorAll('.liNavEmprendimiento');
   file.forEach((accion) => {
      accion.addEventListener('click', ()=>{desplegarDivEmprendimiento(accion)});
   });
}
capturarli()
//Eliminar Emprendimiento
function eliminarEmprendimiento(id) {
   let check = document.getElementById('check-modal') ;
   let confirmarModal = document.getElementById('lblConfirmarModal');
   let contenidoModal = document.getElementById('contenidoModal')
   let salirModal = document.getElementById('lblSalirModal')
   check.checked = true;
   confirmarModal.addEventListener('click', ()=>{
      $.ajax({
         type: "POST",
         url: './php/eliminarEmprendimiento.php',
         data: { id},    
         success: function(dato){
            setTimeout(function(){  
               check.checked = true;
               contenidoModal.childNodes[1].classList =""
               contenidoModal.childNodes[1].classList ="validacionEstado fas fa-check-circle"
               contenidoModal.childNodes[1].style.color= "green"
               contenidoModal.childNodes[3].innerText= "EMPRENDIMIENTO ELIMINADO CON EXITO"
               salirModal.textContent = "Aceptar"
               salirModal.style.backgroundColor = "green"
               confirmarModal.style.display = "none"
               salirModal.addEventListener('click',()=> {
                  window.location.reload();
               })}, 600);      
         }         
      })
   })
}
//Modificar emprendimiento 
function datosEmprendimientos(dato) {
   var ajax = new XMLHttpRequest( ); //Javascript y XML Asincronico
   ajax.open( 'POST', './php/editarEmprendimiento.php' );
   ajax.setRequestHeader( "content-type", "application/x-www-form-urlencoded" );
   ajax.onload = function( ){
      if( ajax.status == 200 ){ 
         var emprendimiento = JSON.parse(ajax.responseText);
         document.getElementById('divCategoriasPMod').innerHTML ="";
         document.querySelector('[name="nombreMod"]').value = emprendimiento['nombre'];
         document.querySelector('[name="telefonoMod"]').value = emprendimiento['telefono'];
         document.querySelector('[name="direccionMod"]').value = emprendimiento['direccion'];
         document.querySelector('[name="descripcionMod"]').textContent = emprendimiento['descripcion'];
         document.querySelector('[name="idEmpreMod"]').value = dato;
         for (let index = 0; index < emprendimiento['categoria'].length; index++) {
            document.getElementById('divCategoriasPMod').innerHTML +='<p class="categoriaP">'+emprendimiento['categoria'][index]+'</p>'
         }
         mostrarimg(emprendimiento['imagenes'])
      } 
   }
   ajax.send( 'idEmpre='+dato+'' );
}
//Mostrar imagenes traidas de la base 
function mostrarimg(dato) {
      var divportada = document.querySelectorAll(".modificarEmprendimiento .imgenEmprendimientoPortada")[0]
      var divImgCuerpo = document.querySelectorAll(".modificarEmprendimiento .imgenEmprendimiento")
      var etiquetasImg = document.querySelectorAll(".modificarEmprendimiento img")
      if (etiquetasImg.length> 0 ) {
         for (let index = 0; index < etiquetasImg.length; index++) {
               let divImg = etiquetasImg[index].parentNode
               divImg.removeChild( etiquetasImg[index])            
         } 
      }
   if (dato.length>0) {
      let imgemprendimiento = document.createElement('img');
      imgemprendimiento.setAttribute('src', dato[0]['ruta'] )
      divportada.appendChild(imgemprendimiento)
      if (dato.length>1) {
      for (let index =0 ; index < dato.length -1; index++) {
            let imgemprendimientocuerpo = document.createElement('img');
            imgemprendimientocuerpo.setAttribute('src', dato[index+1]['ruta'] )
            divImgCuerpo[index].appendChild(imgemprendimientocuerpo)
            }
         }
   }
      
}
//Select Modificar emprendimiento
var selectModEmprendimiento = document.getElementById('selectModEmprendimientos')
selectModEmprendimiento.addEventListener('change', (e)=>{
   if (selectModEmprendimiento.value !== "0") {
      datosEmprendimientos(selectModEmprendimiento.value)
   }
   
})
//Capturar los datos del emprendimiento a Modificar
document.getElementById("btnModificarEmprendimiento").addEventListener('click', (e)=>{
   e.preventDefault();
   let formMofidicar =document.getElementsByClassName('modificarEmprendimiento')[0]
   var categoriasp = formMofidicar.getElementsByClassName('categoriaP');
   var categoria= [];
   for (let index = 0; index < categoriasp.length; index++) {
      categoria[index] =categoriasp[index].textContent
   }
   let ImgEmprendimiento = formMofidicar.getElementsByClassName('divImgEmprendimiento')[0].getElementsByTagName('img')
   var imagenes =[];
   if (ImgEmprendimiento.length !== 0) {
      for (let index = 0; index < ImgEmprendimiento.length; index++) {
         imagenes[index]= ImgEmprendimiento[index].src  
      }
   }
   console.log()
   var nombre, direccion, telefono, descripcion ;
   let inputDatos = formMofidicar.querySelectorAll('[type="text"]')
   inputDatos.forEach(element => {
      switch (element.name) {
         case "nombreMod":
            if (element.value !== "") {
               nombre = element.value
            }else {
               element.classList.remove('inputDatoMod')
               element.classList.add('inputDatoModError');
            }
         break;
         case "direccionMod":
            if (element.value !== "") {
               direccion = element.value
            }else {
               element.classList.remove('inputDatoMod')
               element.classList.add('inputDatoModError');
            }
         break;
         case "telefonoMod":
            if (element.value !== "") {
               telefono = element.value
            }else {
               element.classList.remove('inputDatoMod')
               element.classList.add('inputDatoModError');
            }
         break;
      }
   });
   var textArea = formMofidicar.querySelector('textarea');
   if (textArea.value !=="") {
      descripcion = textArea.value
   }else{
   textArea.classList.remove('textareaDatoMod')
   textArea.classList.add('textareaDatoModError')
   }
   if (nombre && direccion && telefono && descripcion !== "") {
         if (categoria.length === 0) {
            categoria[0]= "OTROS"  
         }
         let id = formMofidicar.querySelectorAll('[name="idEmpreMod"]')[0].value
       modEmprendimiento = new objemprendimiento(id,nombre,descripcion,categoria,imagenes,direccion,telefono);
       enviarEmprendimiento( modEmprendimiento);
   }else{
      formMofidicar.getElementsByClassName('msgDatosVacios')[0].style.display = 'block';
   }
})
//Funcion eliminar categorias
function eliminarCategorias() {
   var divCategoriasP = document.getElementById('divCategoriasP');
   divCategoriasP.addEventListener('click', (e)=>{
      let selectCategorias = document.getElementById('selectCategorias')
      selectCategorias.innerHTML +='<option value="'+e.target.textContent+'">'+e.target.textContent+'</option>'
      divCategoriasP.removeChild(e.target)
   })
   var divCategoriasP = document.getElementById('divCategoriasPMod');
   divCategoriasP.addEventListener('click', (e)=>{
      let selectCategorias = document.getElementById('selectCategoriasMod')
      selectCategorias.innerHTML +='<option value="'+e.target.textContent+'">'+e.target.textContent+'</option>'
      divCategoriasP.removeChild(e.target)
   })
}
eliminarCategorias()
//Funcion form Editar datos Usuario
 var editarDatosUsu = document.getElementById('editarDatosUsu');
 editarDatosUsu.addEventListener('click',(e)=>{
   let btnGuardarDatos = document.getElementById('guardarDatosUsu')
   let inputdatoUsu = document.querySelectorAll('.inputDatoUsuario')
   let formUsuDatos = document.getElementById('formDatosUsu')
   inputdatoUsu.forEach((accion)=>{
      if (accion.disabled === false) {
         accion.disabled = true
         btnGuardarDatos.style.display ='none'
         e.target.value= 'EDITAR DATOS'
         document.getElementById('msgDatosUsuario').style.display ='none'
         e.target.style.background = '#359EF9'
         formUsuDatos.reset()
      }else{
         accion.disabled = false
         btnGuardarDatos.style.display= 'inline-flex'
         e.target.value= 'CANCELAR'
         e.target.style.background = 'red'
         
         
      }
    })

 })

 //Funcion Enviar datos del usuario
  var guardarDatosUsu = document.getElementById('guardarDatosUsu')
  guardarDatosUsu.addEventListener('click', function(e){    
    e.preventDefault()
    $.ajax({
       url: './php/editarDatosUsuario.php',
       type: 'POST',
       data: $('#formDatosUsu').serialize(),
       success: function(res){
           var msgDatosVacios = document.getElementById('msgDatosUsuario')
         if (res === "1") {
            msgDatosVacios.textContent = ""
            msgDatosVacios.textContent ="DATOS ACTUALIZADOS CON EXITO"
            msgDatosVacios.style.color ='chartreuse'
            msgDatosVacios.style.display = 'block';
            setTimeout(
            window.location.reload(),30000);
             
         }else if (res === "camposVacios") {
            msgDatosVacios.textContent = ""
            msgDatosVacios.textContent ="TODOS LOS CAMPOS DEBEN ESTAR COMPLETOS"
            msgDatosVacios.style.color ='#bb2929'
            msgDatosVacios.style.display = 'block';
         }else{

         }
       }
    })
 })