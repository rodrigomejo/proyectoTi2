<?php
   include('componentes/header.php');
   if (null == ( isset( $_SESSION['id']))) {     
      header("Location:./inicioRegistro.php");
   }
   include('./php/conexion.php'); 
   $categorias = "SELECT categoria FROM categorias"; 
   $categoriasRes = $conexion->query($categorias);
   $id = $_SESSION['id'];
   $q = "SELECT id,nombreCompleto,correo,telefono,usuario, tipoUsuario FROM usuario  WHERE id = '$id'"; 
   $datosUsuario = $conexion->query($q);
   if ($datosUsuario->num_rows > 0) {
      while($datosUsuarioRes = $datosUsuario->fetch_assoc()) {
      $username = $datosUsuarioRes['usuario'];
      $nombre = $datosUsuarioRes['nombreCompleto'];
      $mail = $datosUsuarioRes['correo'];
      $telefono =$datosUsuarioRes['telefono'];     
      }
   }
   $empDelusuario = "SELECT id, nombre,direccion, telefono, estado FROM emprendimientos WHERE id_user = $id ";
   $empDelusuarioRes = $conexion->query($empDelusuario);
?>
   <div class="contenedorPerfil">
      <div class="barraLateralUsuario">
         <nav class="navUsuario">
            <div class="divImgUsuario">
               <img src="./img/8a8d3f62663f719adc1b4402d1ce9d8f.jpg" alt="">
               <h3><?php  echo strtoupper( $nombre);?></h3>
            </div>
            <div class="divOpciones">
               <label class="divOpcioneslabel" id="lblNotificaciones">NOTIFICACIONES</label>
               <label class="divOpcioneslabel" id="lblDatosUsuario">DATOS USUARIO</label>
               <ul id="ulnavUsuario"> </ul>
               <input type="checkbox" id="checkemprendimientos">
               <label class="divOpcioneslabel" id="lblEmprendimientos" for="checkemprendimientos">EMPRENDIMIENTOS</label>
               <ul id="ulnavEmprendimiento">   
                  <li id="liAgregar" class="liNavEmprendimiento">AGERGAR</li>
                  <li id="liModificar" class="liNavEmprendimiento">MODIFICAR</li>
               </ul>
               <label for=""><a href="./php/logout.php">SALIR</a></label> 
            </div>
         </nav>
      </div>
      <div class="contenedorInformacion">
         <div class="serparador">
            <h1 id="h1Separador">NOTIFICACIONES</h1>
         </div>
         <div  id="contenedorNotificaciones">
            <fieldset class="separadorNotificaciones">
               <legend>NUEVAS NOTIFICACIONES</legend>
               <div class="divNuevasNotificaciones">
                     <?php
                        $nuevaNotificacion = "SELECT * FROM comentarioempr  WHERE id_user = '$id' AND notificacion = 1"; 
                        $nuevaNotificacionres = $conexion->query($nuevaNotificacion);
                        if ($nuevaNotificacionres->num_rows > 0) {
                           while($notificacion = $nuevaNotificacionres->fetch_assoc()) {
                              $idempre = $notificacion['id_empre'];
                              $empre = "SELECT nombre, estado FROM emprendimientos  WHERE id = '$idempre'";
                              $empreRes = $conexion->query($empre);
                              while($datosempre = $empreRes->fetch_assoc()) {
                                echo'<div class="divNotificacion">
                                       <fieldset class="nuevaNotificacion">
                                          <div>
                                             <p class="pNotificacion"> NOMBRE DEL EMPRENDIMIENTO:</p><p> '.$datosempre['nombre'].'</p>
                                          </div>
                                          <div>
                                             <p class="pNotificacion">ESTADO DEL EMPRENDIMIENTO:</p><p> '.$datosempre['estado'].'</p>
                                          </div>';    
                              }
                                    echo'<div>
                                          <p class="pNotificacion"> COMENTARIO:</p><p> '.$notificacion['comentario'].'</p>
                                         </div>
                                         <form action="./php/notificacion.php" method="post">
                                             <input type="hidden" value="PUBLICADO" name="estadoActual">
                                             <input type="hidden" value="'.$idempre.'" name="id">
                                             <button type="submit" class="btnEditar">MARCAR COMO LEIDA</button>
                                          </form>
                                       </fieldset>   
                                    </div>';   
                           }
                        }else{
                           echo' <P class="pMsg">No Hay Notificaciones Nuevas</P>';
                        }
                     ?>
               </div>
            </fieldset>
            <fieldset class="separadorNotificaciones">
               <legend> NOTIFICACIONES LEIDAS</legend>
               <div class="divNotificacionesLeidas">
                  <?php
                     $nuevaNotificacion = "SELECT * FROM comentarioempr  WHERE id_user = '$id' AND notificacion = 0"; 
                     $nuevaNotificacionres = $conexion->query($nuevaNotificacion);
                     if ($nuevaNotificacionres->num_rows > 0) {
                        while($notificacion = $nuevaNotificacionres->fetch_assoc()) {
                           $idempre = $notificacion['id_empre'];
                           $empre = "SELECT nombre, estado FROM emprendimientos  WHERE id = '$idempre'";
                           $empreRes = $conexion->query($empre);
                           while($datosempre = $empreRes->fetch_assoc()) {
                              echo'<div class="divNotificacion">
                                    <fieldset class="notificacionLeida">
                                       <div>
                                          <p class="pNotificacion"> NOMBRE DEL EMPRENDIMIENTO:</p><p> '.$datosempre['nombre'].'</p>
                                       </div>
                                       <div>
                                          <p class="pNotificacion">ESTADO DEL EMPRENDIMIENTO:</p><p> '.$datosempre['estado'].'</p>
                                       </div>';    
                              }
                                 echo'<div>
                                       <p class="pNotificacion"> COMENTARIO:</p><p> '.$notificacion['comentario'].'</p>
                                       </div>
                                       
                                    </fieldset>   
                                 </div>'
                                 ;   
                           }
                        }else{
                           echo' <P class="pMsg">No Hay Notificaciones Leidas</P>';
                        }
                  ?>
               </div>
            </fieldset>
         </div>
         <div  id="contenedorFormEmpre">
            <div id="emprendimientos">
               <table class="table">
                  <?php
                     if ($empDelusuarioRes->num_rows > 0) {
                           echo' <thead>
                                 <tr>
                                 <th scope="col">Nombre</th>
                                 <th scope="col">Direccion</th>
                                 <th scope="col">Telefono</th>
                                 <th scope="col">Estado</th>
                                 <th scope="col">Accion</th>
                                 </tr>
                                 </thead>';
                     }
                  ?>  
                  <tbody>
                     <?php
                        if ($empDelusuarioRes->num_rows > 0) {
                           while($row = $empDelusuarioRes->fetch_assoc()) {
                           echo '<tr id="'.$row["id"].'">
                                 <td>'.$row["nombre"].'</td>
                                 <td>'.$row["direccion"].'</td>
                                 <td>'.$row["telefono"].'</td>
                                 <td>'.$row["estado"].'</td>
                                 <td style="display:flex;align-items: baseline;">
                                    <form class="formEmprendimientos" action="emprendimiento.php" method="post">
                                    <input type="hidden" value="PUBLICADO" name="estadoActual">
                                       <input type="hidden" value="'.$row["id"].'" name="id">
                                       <button type="submit" class="btnEditar">VER</button>
                                    </form>
                                    </form>
                                    <form id="deleteForm'.$row["id"].'">
                                       <input name="id" type="hidden" value="'.$row["id"].'">
                                    <button type="button" onclick="eliminarEmprendimiento('.$row["id"].')" id="delete'.$row["id"].'" class="btnEliminar">ELIMINAR</button>
                                    </form>
                                 </td> 
                                 </tr>';              
                           }
                        } else {
                           echo' <P class="pEmprendimientos">No hay emprendimientos publicados</P>';
                        }
                     ?>
                  </tbody>
               </table>
               <div class="contenedorModal">
                  <input type="checkbox" id="check-modal">
                  <div class="modal">
                     <div class="contenedor">
                        <div id="contenidoModal" class="contenido">
                           <i class="validacionEstado fas fa-exclamation-triangle"></i>
                           <p>QUIERES ELIMINAR  ESTE EMPRENDIMIENTO?</p>
                           <div class="divbutton">
                              <label for="check-modal" id="lblConfirmarModal">CONFIRMAR</label>
                              <label for="check-modal" id="lblSalirModal">SALIR</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="agregarEmprendimiento">
               <form class="agregarEmprendimiento">
                  <fieldset>
                     <legend>DATOS DEL EMPRENDIMIENTO</legend>
                     <div class="divDatosEmprendimientos">
                        <div class="divinput">
                           <p class="pInput"> NOMBRE: <input class="inputDato" type="text" name="nombre"></p>
                           <p class="pInput">DIRECCION: <input class="inputDato" type="text" name="direccion"></p>
                        </div>
                        <div class="divinput">
                           <p class="pInput"> TELEFONO: <input class="inputDato" type="text" name="telefono" ></p>
                           <p class="pInput"> CATEGORIAS: 
                              <select id="selectCategorias"name="Categorias">
                                 <option value="0" selected>Elige una opción </option>
                                 <?php
                                    if ($categoriasRes->num_rows > 0) {
                                       while($row = $categoriasRes->fetch_assoc()) {
                                          echo'<option value="'.$row['categoria'].'">'.$row['categoria'].'</option> ';
                                       }
                                    }
                                 ?>
                              </select>
                              <button type="button" id="btnAgregar" class="btnAgregar">+</button>
                           </p>
                        </div>
                        <div id="divCategoriasP" class="divCategoriasP">
                        </div>
                        <div class="divinput">
                           <p class="pInput"> DESCRIPCION:<br>
                              <textarea class="textareaDato" name="descripcion"></textarea>           
                           </p>
                        </div>
                     </div>
                     <div class="msgDatosVacios">
                        <h3>TODOS LOS DATOS DEBEN ESTAR COMPLETOS</h3>
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
                     <input type="checkbox" id="check-modalAgregar">
                     <div class="modal">
                        <div class="contenedor">
                           <div id="contenidoModalAgregar" class="contenido">
                              <i class="validacionEstado fas fa-check-circle"></i>
                              <p>EMPRENDIMIENTO  REGISTRADO CON EXITO</p>
                              <label for="check-modal" id="lblAceptarModalAgregar">Aceptar</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div id="editarEmprendimiento">
               <select id="selectModEmprendimientos"name="Emprendimientos">
                  <option value="0" selected>Elige una opción </option>
                  <?php
                     $empDelusuario = "SELECT id, nombre FROM emprendimientos WHERE id_user = $id ";
                     $empDelusuarioRes = $conexion->query($empDelusuario);
                     if ($empDelusuarioRes->num_rows > 0) {
                        echo' <p>chauuuuuu</p>';
                        while($datos = $empDelusuarioRes->fetch_assoc()) {
                                 echo'<option value="'.$datos['id'].'">'.$datos['nombre'].'</option> ';
                        }
                     }
                  ?>
               </select>
               <div>
               <form class="modificarEmprendimiento">
                  <fieldset>
                     <legend>DATOS DEL EMPRENDIMIENTO</legend>
                     <div class="divDatosEmprendimientos">
                        <div class="divinput">
                        <input type="hidden" name="idEmpreMod">
                           <p class="pInput"> NOMBRE: <input class="inputDatoMod" type="text" name="nombreMod"></p>
                           <p class="pInput">DIRECCION: <input class="inputDatoMod" type="text" name="direccionMod"></p>
                        </div>
                        <div class="divinput">
                           <p class="pInput"> TELEFONO: <input class="inputDatoMod" type="text" name="telefonoMod" ></p>
                           <p class="pInput"> CATEGORIAS: 
                              <select id="selectCategoriasMod"name="Categorias">
                                 <option value="0" selected>Elige una opción </option>
                                 <?php
                                    $categorias = "SELECT categoria FROM categorias"; 
                                    $categoriasRes = $conexion->query($categorias);
                                    if ($categoriasRes->num_rows > 0) {
                                       while($row = $categoriasRes->fetch_assoc()) {
                                          echo'<option value="'.$row['categoria'].'">'.$row['categoria'].'</option> ';
                                       }
                                    }
                                 ?>
                              </select>
                              <button type="button" id="btnAgregarMod" class="btnAgregar">+</button>
                           </p>
                        </div>
                        <div id="divCategoriasPMod" class="divCategoriasP">
                        </div>
                        <div class="divinput">
                           <p class="pInput"> DESCRIPCION:<br>
                              <textarea class="textareaDatoMod" name="descripcionMod"></textarea>           
                           </p>
                        </div>
                        <div class="msgDatosVacios">
                        <h3>TODOS LOS DATOS DEBEN ESTAR COMPLETOS</h3>
                     </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <legend>IMAGENES</legend>
                     <div class="divImgEmprendimiento">
                        <p>AGREGA FOTOS PARA QUE LA GENTE CONOZCA TU EMPRENDIMIENTO<br></p>
                        <div class="imgenEmprendimientoPortada">
                           <input  type="file" id="imgenEmprendimientoPortadaMod" name="imagencuerpoEmprendimiento1" >
                        </div> 
                        <div class="imagencuerpoEmprendimiento">
                           <div class="imgenEmprendimiento">
                              <input  type="file" name="imagencuerpoEmprendimiento2" >
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
                     <input  class="btnAgregarEmprendimiento" id="btnModificarEmprendimiento" type="button" value="MODIFICAR EMPRENDIMIENTO ">
                  </fieldset>
                  <div class="contenedorModal">
                     <input type="checkbox" id="check-modalModificar">
                     <div class="modal">
                        <div class="contenedor">
                           <div id="contenidoModalModificar" class="contenido">
                              <i class="validacionEstado fas fa-check-circle"></i>
                              <p>EMPRENDIMIENTO  MODIFICADO CON EXITO</p>
                              <label for="check-modal" id="lblAceptarModalModificar">Aceptar</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
               </div>
            </div>
         </div>
         <div  id="contenedorDatosUsuario">
           <div>
           <fieldset class="separadorNotificaciones">
               <form id="formDatosUsu">
                  <div class="divEstilo">
                     <div class="divDatos">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <label  for="nombre" class="">NOMBRE COMPLETO:</label>
                        <input disabled="true" class="inputDatoUsuario" name="nombre" type="text" value="<?php echo $nombre;?>">
                        <P><?php echo $nombre;?></P> 
                     </div>
                     <div class="divDatos">
                        <label for="inputEmail4" class="">CORREO:</label>
                        <input disabled="true" class="inputDatoUsuario" name="email" type="text" value="<?php echo $mail;?>">
                        <P><?php echo $mail;?></P>
                     </div>
                  </div>
                  <div class="divEstilo">
                     <div class="divDatos" >
                        <label for="telefono" class="">TELEFONO:</label>
                        <input disabled="true"  class="inputDatoUsuario" name="telefono" type="text" value="<?php echo $telefono;?>">
                        <P><?php echo $telefono;?></P>
                     </div>
                     <div class="divDatos" >
                        <label  for="username" class="">USUARIO:</label>
                        <input disabled="true" class="inputDatoUsuario" name="username" type="text" value="<?php echo $username;?>">
                        <P><?php echo $username;?></P>
                        </div>
                     </div>
                  </div>
                  <fieldset class="separadorNotificaciones">
                     <div id="msgDatosUsuario" class="msgDatosUsuario"></div>
                     <button id="guardarDatosUsu" class="btnGuardarDatos">GUARDAR DATOS</button>
                     <input id="editarDatosUsu" type="button" class="btnAgregarEmprendimiento" value="EDITAR DATOS">
                    
                  </fieldset>
                  
               </form>
            </fieldset>
           </div>
         </div>
   </div>
<?php include('componentes/footer.php') ?>