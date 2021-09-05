<?php
include('componentes/header.php');
if ( true == ( isset( $_SESSION['id']))) {
   header("Location:./perfilUsuario.php");
}

?>
   <div class="cuerpoPagina">

      <div class="contenedorPrincipal">
         <div class="cajaTrasera">
            
          <div class="cajaTraseraLogin">
             <h3>¿Ya tiene una cuenta?</h3>
             <p>Inicia sesion para entrar a la pagina</p>
             <button id="btnLogin">Iniciar Sesion</button>
          </div>
 
          <div class="cajaTraseraRegistro">
             <h3>¿Aun no tienes cuenta ?</h3>
             <p>Registrate para que puedas iniciar sesion</p>
             <button id="btnRegistro">Registrarse</button>
          </div>
 
         </div>
          <div class="contenedorLogin_Registro">
             
             <form action="" method="POST" id="formLogin"class="formLogin">
                <h2>Iniciar sesion</h2>
                <input type="text" class="formLoginInput" name="usuarioCorreo" placeholder="Usuario o Correo Electronico">
                <input type="password" class="formLoginInput" name="passwordLogin" placeholder="Contraseña">
                <button id="btnInicioForm">Entrar</button>
             </form>
             <form action="" method="POST" id="formRegistro" class="formRegistro">
                <h2>Registrarse</h2>
                <div class="divRegistroInput">
                  <input type="text" class="formRegistroinputnombreCompleto" name="nombreCompleto" placeholder="Nombre y Apellido">
                  <i class="registroValidacionEstado fas fa-times-circle"></i>
               </div>
               <div class="divRegistroInput">
                  <input type="text" class="formRegistroinputusuario" name="usuario" placeholder="Usuario">
                  <i class="registroValidacionEstado fas fa-times-circle"></i>
               </div>
               <p class="errorUsuario"><i class="fas fa-times-circle"></i> EL USUARIO YA ESTA REGISTRADO</p>
               <div class="divRegistroInput">
                  <input type="text" class="formRegistroinputemail" name="email" placeholder="Correo Electronico">
                  <i class="registroValidacionEstado fas fa-times-circle"></i>
               </div>
               <p class="errorCorreo"><i class="fas fa-times-circle"></i> EL CORREO YA ESTA REGISTRADO</p>
               <div class="divRegistroInput">
                  <input type="text" class="formRegistroinputtelefono"name="telefono" placeholder="Telefono">
                  <i class="registroValidacionEstado fas fa-times-circle"></i>
               </div>
               <p class="errorTelefono"><i class="fas fa-times-circle"></i> EL TELEFONO YA ESTA REGISTRADO</p>
               <div class="divRegistroInput">
                  <input type="password"class="formRegistroinputpasswordRegistro" name="passwordRegistro" placeholder="Contraseña">
                  <i class="registroValidacionEstado fas fa-times-circle"></i>
               </div>
               <p class="errorRegistro"><i class="fas fa-times-circle"></i> DEBE COMPLETAR TODOS LOS CAMPOS CORRECTAMENTE</p>
                <button id="btnRegistroForm">Registrarse</button>
             </form>
             <div class="contenedorModal">
                  <input type="checkbox" id="check-modal">
                  <div class="modal">
                     <div class="contenedor">
                        <div id="contenidoModal" class="contenido">
                           <i class="validacionEstado fas fa-check-circle"></i>
                           <p>USUARIO REGISTRADO CON EXITO</p>
                           <label for="check-modal" id="lblAceptarModal">Aceptar</label>
                        </div>
                     </div>
                  </div>
                </div>
          </div>
       </div> 
   </div>
<?php include('componentes/footer.php') ?>