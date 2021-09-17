function  desplegarDiv(idButton) {
   var divUsuarios = document.getElementById('divUsuarios');
   var divEmprendimientos = document.getElementById('divEmprendimientos');
   var divPendientes = document.getElementById('divPendientes');
   var divCategorias = document.getElementById('divCategorias');
   switch(idButton.id) {
      case "liUsuarios":
         divUsuarios.style.display = 'block';
         divEmprendimientos.style.display = 'none';
         divPendientes.style.display = 'none';
         divCategorias.style.display = 'none';
      break;
      case "liEmprendimientos":
         divUsuarios.style.display = 'none';
         divEmprendimientos.style.display = 'block';
         divPendientes.style.display = 'none';
         divCategorias.style.display = 'none';
      break;
      case "liPendientes":
         divUsuarios.style.display = 'none';
         divEmprendimientos.style.display = 'none';
         divPendientes.style.display = 'block';
         divCategorias.style.display = 'none';
      break;
      case "liCategorias":
         divUsuarios.style.display = 'none';
         divEmprendimientos.style.display = 'none';
         divPendientes.style.display = 'none';
         divCategorias.style.display = 'block';
      break;
   }
}
function capturarli(){
   var file = document.querySelectorAll('.navAdministrar');
   file.forEach((accion) => {
      accion.addEventListener('click', ()=>{desplegarDiv(accion)});
   });
}
capturarli()
function eliminarUsuario(id) {
   let check = document.getElementById('check-modal') ;
   let confirmarModal = document.getElementById('lblConfirmarModal');
   let contenidoModal = document.getElementById('contenidoModal')
   let salirModal = document.getElementById('lblSalirModal')
   check.checked = true;
   confirmarModal.addEventListener('click', ()=>{
      $.ajax({
         type: "POST",
         url: './php/editarUsuarioEliminar.php',
         data: { id},    
         success: function(dato){
            setTimeout(function(){  
               check.checked = true;
               contenidoModal.childNodes[1].classList =""
               contenidoModal.childNodes[1].classList ="validacionEstado fas fa-check-circle"
               contenidoModal.childNodes[1].style.color= "green"
               contenidoModal.childNodes[3].innerText= "USUARIO ELIMINADO CON EXITO"
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
document.getElementById('inputSelectMod').addEventListener('input',()=>categorias())
function categorias() {
      var selectElement = document.getElementById('selectCategorias');
   if (selectElement !== null) {
      var inputSelect = document.getElementById("inputSelectMod")
      var btnAgregar = document.getElementById('btnAgregar')
      var btnModificar = document.getElementById('btnModificar')
      if (inputSelect.value ==="") {
         btnAgregar.disabled = true;
         btnModificar.disabled  = true;
         selectElement.addEventListener('change', (event) => {
            var idCategoria = document.getElementById("idCategoria")
            idCategoria.value= "";
            if (event.target.value!== "0") {
               console.log(event.target.value)
               idCategoria.value = event.target.value;
               console.log( selectElement.options[selectElement.selectedIndex].text)
               inputSelect.value = selectElement.options[selectElement.selectedIndex].text;
               btnAgregar.disabled = true;
               btnModificar.disabled  = false;
            }else{
               inputSelect.value ="";
               idCategoria.value= "";
               btnAgregar.disabled = false;
               btnModificar.disabled  = true;
            }
         });
      }else{
         console.log("botno activado")
         btnAgregar.disabled = false;
         selectElement.addEventListener('change', (event) => {
            var idCategoria = document.getElementById("idCategoria")
            idCategoria.value= "";
            if (event.target.value!== "0") {
               console.log(event.target.value)
               idCategoria.value = event.target.value;
               console.log( selectElement.options[selectElement.selectedIndex].text)
               inputSelect.value = selectElement.options[selectElement.selectedIndex].text;
               btnAgregar.disabled = true;
               btnModificar.disabled  = false;
            }else{
                  inputSelect.value ="";
                  idCategoria.value= "";
                  btnAgregar.disabled = false;
                  btnModificar.disabled  = true;
            }
         });
      }
   }
}
categorias();