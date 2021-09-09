
function  desplegarDiv(idButton) {
   var producto1 = document.getElementById('divUsuarios');
   var producto2 = document.getElementById('divEmprendimientos');
   var producto3 = document.getElementById('divPendientes');
   switch(idButton.id) {
      case "liUsuarios":
         producto1.style.display = 'block';
         producto2.style.display = 'none';
         producto3.style.display = 'none';
      break;
      case "liEmprendimientos":
         producto1.style.display = 'none';
         producto2.style.display = 'block';
         producto3.style.display = 'none';
      break;
      case "liPendientes":
         producto1.style.display = 'none';
         producto2.style.display = 'none';
         producto3.style.display = 'block';
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
