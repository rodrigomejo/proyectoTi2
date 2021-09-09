<?php
include('componentes/header.php');
if (null == ( isset( $_SESSION['id']))) {     
   header("Location:./inicioRegistro.php");
}
?>
   <div class="contenedorPerfil">
      <div class="barraLateralUsuario">
         <nav class="navUsuario">
            <div class="divImgUsuario">
               <img src="./img/8a8d3f62663f719adc1b4402d1ce9d8f.jpg" alt="">
               <h3><?php  echo strtoupper( $_SESSION['nombreCompleto']);?></h3>
            </div>
            
            <label>DATOS USUARIO</label>
            <ul id="ulnavUsuario"> </ul>
            <input type="checkbox" id="checkemprendimientos">
            <label for="checkemprendimientos">EMPRENDIMIENTOS</label>
            <ul id="ulnavEmprendimiento">
               
               <li>AGERGAR</li>
               <li>MODIFICAR</li>

            </ul>
            <ul>
               <label><a href="./php/logout.php">Salir</a></label>
            </ul>
        </nav>
      </div>
      <div class="contenedorInformacion">
         <div class="serparador"></div>
         <form>

            <fieldset>
          
               <legend>DATOS DEL EMPRENDIMIENTO</legend>
               <div class="divDatosEmprendimientos">
                  <div class="divinput">
                     <p class="pInput"> NOMBRE: <input type="text" name="nombre"></p>
                     <p class="pInput">DIRECCION: <input type="text" name="direccion"></p>
                  </div>
                  <div class="divinput">
                     <p class="pInput"> TELEFONO: <input type="text" name="telefono" ></p>
                     <p class="pInput"> CATEGORIAS: 
                        <select id="selectCategorias"name="Categorias">
                        </select>
                     <button type="button" id="btnAgregar" class="btnAgregar">+</button>
                     </p>
                  </div>
                  <div class="divCategoriasP">
                  </div>
                  <div class="divinput">
                     <p class="pInput"> DESCRIPCION:<br>
                        <textarea name="descripcion"></textarea>           
                     </p>
                  </div>
               </div>
            </fieldset>
          
            <fieldset>
              <legend>IMAGENES</legend>
              
              <div class="divImgEmprendimiento">
               <p>AGREGA FOTOS PARA QUE LA GENTE CONOZCA TU EMPRENDIMIENTO<br></p>
                 <div class="imgenEmprendimientoPortada">
                  <input type="file" id="imgenEmprendimientoPortada" name="imagencuerpoEmprendimiento1" >
                 </div>
                  <div class="imagencuerpoEmprendimiento">
                     <div class="imgenEmprendimiento">
                        <input type="file" name="imagencuerpoEmprendimiento2" >
                     </div>
                     <div class="imgenEmprendimiento">
                        <input type="file" name="imagencuerpoEmprendimiento3">
                     </div>
                     <div class="imgenEmprendimiento">
                        <input type="file" name="imagencuerpoEmprendimiento4">
                     </div>
                     <div class="imgenEmprendimiento">
                        <input type="file" name="imagencuerpoEmprendimiento5">
                     </div>
                  </div>
              </div>
               <input  class="btnAgregarEmprendimiento" id="btnAgregarEmprendimiento" type="button" value="AGREGAR EMPRENDIMIENTO ">
            </fieldset>
            <div class="contenedorModal">
                  <input type="checkbox" id="check-modal">
                  <div class="modal">
                     <div class="contenedor">
                        <div id="contenidoModal" class="contenido">
                           <i class="validacionEstado fas fa-check-circle"></i>
                           <p>EMPRENDIMIENTO  REGISTRADO CON EXITO</p>
                           <label for="check-modal" id="lblAceptarModal">Aceptar</label>
                        </div>
                     </div>
                  </div>
                </div>
          </form>
      </div>
   </div>
<?php include('componentes/footer.php') ?>