//Expresiones para los datos del los inputs
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-\s]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^[\+\d]{7,14}$/ // 7 a 14 numeros.
}
//Funcion Validar datos del Input
const validarDatos = (e) => {
   document.getElementsByClassName('errorRegistro')[0].style.display = "none"
	switch (e.target.name) {
		case "usuario":
         if (e.target.value !== "") {
            validarCampo(expresiones.usuario, e.target, 'usuario');
            document.getElementsByClassName('errorUsuario')[0].style.display = "none"
         }else {
            e.target.parentElement.classList.remove('divRegistroInput-correcto')
            e.target.parentElement.classList.remove('divRegistroInput-incorrecto')
         }
		break;
		case "nombreCompleto":
         if (e.target.value !== "") {
            validarCampo(expresiones.nombre, e.target, 'nombreCompleto');
         }else {
            e.target.parentElement.classList.remove('divRegistroInput-correcto')
            e.target.parentElement.classList.remove('divRegistroInput-incorrecto')
         }
		break;
		case "passwordRegistro":
         if (e.target.value !== "") {
            validarCampo(expresiones.password, e.target, 'passwordRegistro');
         }else {
            e.target.parentElement.classList.remove('divRegistroInput-correcto')
            e.target.parentElement.classList.remove('divRegistroInput-incorrecto')
         }
		break;
		case "email":
         if (e.target.value !== "") {
            validarCampo(expresiones.correo, e.target, 'email');
            document.getElementsByClassName('errorCorreo')[0].style.display = "none"
         }else {
            e.target.parentElement.classList.remove('divRegistroInput-correcto')
            e.target.parentElement.classList.remove('divRegistroInput-incorrecto')
         }
		break;
		case "telefono":
         if (e.target.value !== "") {
            validarCampo(expresiones.telefono, e.target, 'telefono');
            document.getElementsByClassName('errorTelefono')[0].style.display = "none"
         }else {
            e.target.parentElement.classList.remove('divRegistroInput-correcto')
            e.target.parentElement.classList.remove('divRegistroInput-incorrecto')
         }
		break;
	}
}
//Funcion Validar el campo si los datos cumplen con los requisitos
const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementsByClassName(`formRegistroinput${campo}`)[0].parentElement.classList.remove('divRegistroInput-incorrecto');
     document.getElementsByClassName(`formRegistroinput${campo}`)[0].parentElement.classList.add('divRegistroInput-correcto');
		document.getElementsByClassName(`formRegistroinput${campo}`)[0].parentElement.children[1].classList.add('fa-check-circle');
		document.getElementsByClassName(`formRegistroinput${campo}`)[0].parentElement.children[1].classList.remove('fa-times-circle');
	} else {
		document.getElementsByClassName(`formRegistroinput${campo}`)[0].parentElement.classList.add('divRegistroInput-incorrecto');
		document.getElementsByClassName(`formRegistroinput${campo}`)[0].parentElement.classList.remove('divRegistroInput-correcto');
		document.getElementsByClassName(`formRegistroinput${campo}`)[0].parentElement.children[1].classList.add('fa-times-circle');
		document.getElementsByClassName(`formRegistroinput${campo}`)[0].parentElement.children[1].classList.remove('fa-check-circle');
	}
}
//Capturar el input que esta realizando el evento(Keyup y blur)
var inputRegistro = document.querySelectorAll('#formRegistro input')
inputRegistro.forEach((input) => {
	input.addEventListener('keyup', validarDatos);
	input.addEventListener('blur', validarDatos);
});
//Funcion marcar los campos que tiene datos duplicados
function datosDuplicados(dato){
   let datoDuplicado = dato.split(' '); 
   
   for (let index = 0; index < datoDuplicado.length; index++) {
      if (datoDuplicado[index]!== "0") {
         pdatosDuplicados = document.getElementsByClassName(''+datoDuplicado[index]+'')[0];
         pdatosDuplicados.style.display = "block";
         document.getElementsByClassName(''+datoDuplicado[index]+'')[0].previousElementSibling.classList.add('divRegistroInput-incorrecto');
         document.getElementsByClassName(''+datoDuplicado[index]+'')[0].previousElementSibling.classList.remove('divRegistroInput-correcto');
         document.getElementsByClassName(''+datoDuplicado[index]+'')[0].previousElementSibling.childNodes[3].classList.add('fa-times-circle');
         document.getElementsByClassName(''+datoDuplicado[index]+'')[0].previousElementSibling.childNodes[3].classList.remove('fa-check-circle');
      }
      
      
   }
}
//Funcion registrar usuario
function registroUsuario(dato){

   dato.addEventListener('click', function(e){    
      let divRegistroInput = document.querySelectorAll('.divRegistroInput-correcto')
      e.preventDefault()
      if (divRegistroInput.length === 5) {
         $.ajax({
            url: './php/registroUsuario.php',
            type: 'POST',
            data: $('#formRegistro').serialize(),
            success: function(res){
               let check = document.getElementById('check-modal') ;
               let aceptarModal = document.getElementById('lblAceptarModal');
               let contenidoModal = document.getElementById('contenidoModal')
               if (res === "1") {
               check.checked = true;
               aceptarModal.addEventListener('click', ()=>{
                  window.location.reload();
               })
               }else if (res ==="") {
               contenidoModal.childNodes[1].classList =""
               contenidoModal.childNodes[1].classList ="validacionEstado fas fa-times-circle"
               contenidoModal.childNodes[1].style.color= "red"
               contenidoModal.childNodes[3].innerText= "NO SE PUDO REGISTRAR EL USUARIO"
               check.checked = true;
               aceptarModal.addEventListener('click', ()=>{
                  contenidoModal.childNodes[1].classList =""
               contenidoModal.childNodes[1].classList ="validacionEstado fas fa-check-circle"
               contenidoModal.childNodes[1].style.color= "green"
               contenidoModal.childNodes[3].innerText= "USUARIO REGISTRADO CON EXITO"
                })
               } else { 
                  datosDuplicados(res);
               }
            }
         })
      }else{
         pError = document.getElementsByClassName('errorRegistro')[0]
         pError.style.display = "block"
         }
   })
}
//Funcion Respuesta inicio de sesion
function respuestaInicio(dato) {
   let check = document.getElementById('check-modal') ;
   let aceptarModal = document.getElementById('lblAceptarModal');
   let contenidoModal = document.getElementById('contenidoModal')
   if (dato === "0") {
      contenidoModal.childNodes[1].classList =""
      contenidoModal.childNodes[1].classList ="validacionEstado fas fa-times-circle"
      contenidoModal.childNodes[1].style.color= "red"
      contenidoModal.childNodes[3].innerText= "USUARIO Y/O CONTRASEÑA INCORRECTO"
      check.checked = true;
      aceptarModal.addEventListener('click', ()=>{
         contenidoModal.childNodes[1].classList =""
         contenidoModal.childNodes[1].classList ="validacionEstado fas fa-check-circle"
         contenidoModal.childNodes[1].style.color= "green"
         contenidoModal.childNodes[3].innerText= "USUARIO REGISTRADO CON EXITO"
      })
   }else if(dato === "root"){
      window.location.href = "./administrar.php"
   }else {
      contenidoModal.childNodes[3].innerText= "BIENVENIDO"+" "+ dato.toUpperCase();
      check.checked = true;
      aceptarModal.addEventListener('click', ()=>{
         contenidoModal.childNodes[1].classList =""
         contenidoModal.childNodes[1].classList ="validacionEstado fas fa-check-circle"
         contenidoModal.childNodes[1].style.color= "green"
         contenidoModal.childNodes[3].innerText= "USUARIO REGISTRADO CON EXITO"
         window.location.href = "./perfilUsuario.php"
      })
   }
   
}
//Funcion inicio de sesion 
btnInicioForm = document.getElementById('btnInicioForm')
btnInicioForm.addEventListener('click', function(e){    
   e.preventDefault()
   $.ajax({
      url: './php/inicioUsuario.php',
      type: 'POST',
      data: $('#formLogin').serialize(),
      success: function(res){
         respuestaInicio(res);
      }
   })
})

//Eventos 
document.getElementById("btnRegistro").addEventListener("click", registroForm);
document.getElementById("btnLogin").addEventListener("click", login);
//Variables
var contenedorLogin_Registro = document.querySelector(".contenedorLogin_Registro");
var formLogin = document.querySelector(".formLogin");
var formRegistro = document.querySelector(".formRegistro");
var cajaTraseraLogin = document.querySelector(".cajaTraseraLogin");
var cajaTraseraRegistro = document.querySelector(".cajaTraseraRegistro");
var contenedorLoginRegistroF = document.querySelector(".contenedorLogin_Registro form");
//Formulario inicio de sesion-Registro
function registroForm(){
   if (window.innerWidth > 850 ){
      formRegistro.style.display = "block";
      formLogin.style.display = "none";
      contenedorLogin_Registro.style.left = "410px";
      cajaTraseraRegistro.style.opacity = "0";
      cajaTraseraLogin.style.opacity = "1";
      registroUsuario(document.getElementById('btnRegistroForm'))
   } else {
      formRegistro.style.display = "block";
      formLogin.style.display = "none";
      contenedorLogin_Registro.style.left = "0px";
      cajaTraseraRegistro.style.display = "none";
      cajaTraseraLogin.style.display = "block";
      cajaTraseraLogin.style.opacity = "1";
   }
}
function login(){

   if (window.innerWidth >850){
      formRegistro.style.display = "none";
      formLogin.style.display = "block";
      contenedorLogin_Registro.style.left = "0px";
      cajaTraseraRegistro.style.opacity = "1";
      cajaTraseraLogin.style.opacity = "0";
   } else{
      formRegistro.style.display = "none";
      formLogin.style.display = "block";
      contenedorLogin_Registro.style.left = "0px";
      cajaTraseraRegistro.style.display = "block";
      cajaTraseraLogin.style.display = "none";
   }
}
 
