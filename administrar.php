<?php 
include('componentes/header.php');
include('./php/conexion.php'); 
if ( $_SESSION['tipoUsuario'] == 'User') {
   header("Location:./perfilUsuario.php");
}
$id = $_SESSION['id'];
$usuRegistrados = "SELECT id,nombreCompleto,correo,telefono,usuario,tipoUsuario FROM usuario WHERE id <> $id  ";
$empPendientes = "SELECT id,nombre,direccion, telefono ,id_user FROM emprendimientos WHERE id_user <> $id AND estado = 'PENDIENTE'";
$empPublicados = "SELECT id,nombre,direccion, telefono ,id_user FROM emprendimientos WHERE id_user <> $id AND estado = 'PUBLICADO'";
$response = $conexion->query($usuRegistrados);
$datosEmpPendientes = $conexion->query($empPendientes);
$datosEmpPublicados = $conexion->query($empPublicados);

?>
<div id="menu">
	<ul>
		<li onclick=" myFunction('liUsuarios')" id="liUsuarios" class="navAdministrar">Usuarios
    </li>
		<li onclick="myFunction('liEmprendimientos')" id="liEmprendimientos"class="navAdministrar">
    Emprendimientos
    </li>
		<li onclick="myFunction('liPendientes')"id="liPendientes"class="navAdministrar">
      Pendientes
    </li>
	</ul>
</div>
<div class="cuerpoPagina">
  <div id="divUsuarios" class="divUsuarios">
    <h2>Usuarios Registrados</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col">Telefono</th>
          <th scope="col">Usuario</th>
          <th scope="col">Tipo usuario</th>
          <th scope="col">Accion</th>
        </tr>
      </thead>
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
                     <form action="AdminUsu.php" method="get">
                        <input type="hidden" value="'.$row["id"].'" name="id">
                        <button type="submit" class="btnEditar">EDITAR</button>
                     </form>
                     <form id="deleteForm'.$row["id"].'" action="validations/confirm-delete.php" method="post">
                        <input name="id" type="hidden" value="'.$row["id"].'">
                     <button type="submit" id="delete'.$row["id"].'" onclick="clickHandler(event)" class="btnEliminar">ELIMINAR</button>
                     </form>
                  </td> 
                  </tr>';              
          }
          } else {
              printf('No record found.<br />');
          }
        ?>
      </tbody>
    </table>
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
                     <form action="AdminUsu.php" method="get">
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
                     <form action="AdminUsu.php" method="get">
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
</div>
<?php include('componentes/footer.php') ?>