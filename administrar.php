<?php 
  include('componentes/header.php');
  include('./php/conexion.php'); 
  if ( $_SESSION['tipoUsuario'] == 'User') {
    header("Location:./perfilUsuario.php");
  }
  if ($_SESSION['tipoUsuario'] == 'root') {
    $usuRegistrados = "SELECT id,nombreCompleto,correo,telefono,usuario,tipoUsuario FROM usuario  ";
    $empPendientes = "SELECT id,nombre,direccion, telefono ,id_user FROM emprendimientos WHERE estado = 'PENDIENTE'";
    $empPublicados = "SELECT id,nombre,direccion, telefono ,id_user FROM emprendimientos WHERE estado = 'PUBLICADO'";
    $categorias = "SELECT * FROM categorias";
  }else{
    $id = $_SESSION['id'];
    $usuRegistrados = "SELECT id,nombreCompleto,correo,telefono,usuario,tipoUsuario FROM usuario WHERE id <> $id  ";
    $empPendientes = "SELECT id,nombre,direccion, telefono ,id_user FROM emprendimientos WHERE id_user <> $id AND estado = 'PENDIENTE'";
    $empPublicados = "SELECT id,nombre,direccion, telefono ,id_user FROM emprendimientos WHERE id_user <> $id AND estado = 'PUBLICADO'";
    $categorias = "SELECT * FROM categorias";
  }
  $response = $conexion->query($usuRegistrados);
  $datosEmpPendientes = $conexion->query($empPendientes);
  $datosEmpPublicados = $conexion->query($empPublicados);
  $categoriasRes = $conexion->query($categorias);
?>
<div id="menu">
	<ul>
		<li id="liUsuarios" class="navAdministrar">Usuarios
    </li>
    <?php 
      if ($_SESSION['tipoUsuario'] != 'root') {
        echo'<li id="liEmprendimientos"class="navAdministrar">
              Emprendimientos
              </li>
              <li id="liPendientes" class="navAdministrar">
                Pendientes
              </li>
              <li id="liCategorias" class="navAdministrar">
                Categorias
              </li>';
      }else{
        echo'<li class="navAdministrar">
                <a href="./php/logout.php">Salir</a>
              </li>';
      }
    ?>
	</ul>
</div>
<div class="cuerpoPagina">
  <div id="divUsuarios" class="divUsuarios">
    <h2>Usuarios Registrados</h2>
    <table class="table">
      <?php 
        if ($response->num_rows > 0) {  
          echo ' <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Tipo usuario</th>
                    <th scope="col">Accion</th>
                  </tr>
                </thead>';
        }
      ?>
      <tbody>
        <?php
          if ($response->num_rows > 0) {
            while($row = $response->fetch_assoc()) {
              echo '<tr id="'.$row["id"].'">
                  <td>'.$row["nombreCompleto"].'</td>
                  <td>'.$row["correo"].'</td>
                  <td>'.$row["telefono"].'</td>
                  <td>'.$row["usuario"].'</td>
                  <td>'.$row["tipoUsuario"].'</td>
                  <td style="display:flex">
                     <form action="adminUsu.php" method="post">
                        <input type="hidden" value="'.$row["id"].'" name="id">
                        <button type="submit" class="btnEditar">EDITAR</button>
                     </form>
                     <form id="deleteForm'.$row["id"].'">
                        <input name="id" type="hidden" value="'.$row["id"].'">
                     <button type="button" onclick="eliminarUsuario('.$row["id"].')" id="delete'.$row["id"].'" class="btnEliminar">ELIMINAR</button>
                     </form>
                  </td> 
                  </tr>';              
              }
          } else {
            echo' <P class="pEmprendimientos">No hay Usuarios registrados</P>';
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
            <p>QUIERES ELIMINAR  ESTE USUARIO?</p>
            <div class="divbutton">
            <label for="check-modal" id="lblConfirmarModal">CONFIRMAR</label>
            <label for="check-modal" id="lblSalirModal">SALIR</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="divEmprendimientos" class="divEmprendimientos">
    <h2>Emprendimientos Publicados</h2>
    <table class="table">
      <?php
        if ($datosEmpPublicados->num_rows > 0) {
            echo' <thead>
                    <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Accion</th>
                    </tr>
                  </thead>';
        }
      ?>  
      <tbody>
        <?php
          if ($datosEmpPublicados->num_rows > 0) {
            while($row = $datosEmpPublicados->fetch_assoc()) {
              $idusu = $row["id_user"];
              $nombre = "SELECT nombreCompleto FROM usuario WHERE id = '$idusu'";
              $datosnombreRes = $conexion->query($nombre);
              while($nombreRes = $datosnombreRes->fetch_assoc()) {
                $nom = $nombreRes['nombreCompleto'];
              }
              echo '<tr id="'.$row["id"].'">
                  <td>'.$row["nombre"].'</td>
                  <td>'.$row["direccion"].'</td>
                  <td>'.$row["telefono"].'</td>
                  <td>'.$nom.'</td>
                  <td style="display:flex">
                     <form action="emprendimiento.php" method="post">
                     <input type="hidden" value="PUBLICADO" name="estadoActual">
                        <input type="hidden" value="'.$row["id"].'" name="id">
                        <button type="submit" class="btnEditar">VER</button>
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
  </div>
  <div id="divPendientes" class="divPendientes">
    <h2>Emprendimientos Para Revision</h2>
    <table class="table">
    <?php
      if ($datosEmpPendientes->num_rows > 0) {
          echo' <thead>
                  <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Direccion</th>
                  <th scope="col">Telefono</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Accion</th>
                  </tr>
                </thead>';
      }
    ?>  
      
      <tbody>
        <?php
          if ($datosEmpPendientes->num_rows > 0) {
            while($row = $datosEmpPendientes->fetch_assoc()) {
              $idusu = $row["id_user"];
              $nombre = "SELECT nombreCompleto FROM usuario WHERE id = '$idusu'";
              $datosnombreRes = $conexion->query($nombre);
              while($nombreRes = $datosnombreRes->fetch_assoc()) {
                $nom = $nombreRes['nombreCompleto'];
              }
              
              echo '<tr id="'.$row["id"].'">
                  <td>'.$row["nombre"].'</td>
                  <td>'.$row["direccion"].'</td>
                  <td>'.$row["telefono"].'</td>
                  <td>'.$nom.'</td>

                  <td style="display:flex">
                     <form action="emprendimiento.php" method="post">
                        <input type="hidden" value="'.$row["id"].'" name="id">
                        <button type="submit" class="btnEditar">REVISION</button>
                     </form>
                  </td> 
                  </tr>';              
          }
          } else {
            echo' <P class="pEmprendimientos">No hay emprendimientos para revision</P>';
          }
        ?>
      </tbody>
    </table>
  </div>
  <div id="divCategorias" class="divCategorias">
    <h2>Categorias</h2>
    <div class="divSelect">
      <select id="selectCategorias"name="Categorias">
        <option value="0" selected>Elige una opción </option>
        <?php 
          if ($categoriasRes->num_rows > 0) {
              while($datosCategoria = $categoriasRes->fetch_assoc()) {
                echo'<option value="'.$datosCategoria['id'].'">'.$datosCategoria['categoria'].'</option> ';
              }
          }
        ?>
      </select>
      <form action="./php/categorias.php" method="POST">
        <input id="inputSelectMod" name="categoria" type="text">
        <input id="idCategoria" name="id" type="hidden" value="">
        <div class="divBtnCategorias">
        <button id="btnAgregar" type="submit" class="btnEditar">AGREGAR</button>
        <button id="btnModificar" type="submit" class="btnEliminar">MODIFICAR</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include('componentes/footer.php') ?>