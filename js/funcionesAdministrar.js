
function  myFunction(idButton) {

   console.log(idButton)
   var producto1 = document.getElementById('divUsuarios');
   var producto2 = document.getElementById('divEmprendimientos');
   var producto3 = document.getElementById('divPendientes');
 
 
 
  switch(idButton) {
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
   accion.addEventListener('click', myFunction(accion));
});
}


