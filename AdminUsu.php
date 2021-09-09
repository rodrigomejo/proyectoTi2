<?php
include('componentes/header.php'); 
if (isset($_POST["id"]) == false && isset($_SESSION['idUsuAdmin']) == false ) {
  header("location: ./administrar.php");
}
$id = isset($_POST["id"]) ? $_POST["id"] : $_SESSION['idUsuAdmin'];
$username = "";
$nombre = "";
$mail = "";
$phone = "";
$tipoUsuario = "";
include('./php/conexion.php'); 
    $q = "SELECT id,nombreCompleto,correo,telefono,usuario, tipoUsuario FROM usuario  WHERE id = '$id'"; 
    $response = $conexion->query($q);
    if ($response->num_rows > 0) {
      while($row = $response->fetch_assoc()) {
        $username = $row['usuario'];
        $nombre = $row['nombreCompleto'];
        $mail = $row['correo'];
        $phone =$row['telefono'];    
        $tipoUsuario =$row['tipoUsuario'];      
      }
  }
?>
<div class="cuerpoPagina">
  <div class="serparador">
  <a class="btnAtras" href="./php/back.php">ATRAS</a>
  </div>

  <fieldset>
    <legend>DATOS DEL USUARIO</legend>
    <form action="./php/editarUsuarioEliminar.php" method="post">
      <div class="divEstilo">
        <div class="divDatos">
          <input type="hidden" name="id" value="<?php echo $id;?>">
          <label for="nombre" class="form-label">NOMBRE COMPLETO:</label>
          <P><?php echo $nombre;?></P> 
        </div>
        <div class="divDatos">
          <label for="inputEmail4" class="form-label">CORREO:</label>
           <P><?php echo $mail;?></P>
        </div>
      </div>
      <div class="divEstilo">
        <div class="divDatos" >
          <label for="phone" class="form-label">TELEFONO:</label>
          <P><?php echo $phone;?></P>
        </div>
        <div class="divDatos" >
          <label for="username" class="form-label">USUARIO:</label>
          <P><?php echo $username;?></P>
        </div>
      </div>
      <div class="divDatos">
        <label for="inputTipoUsuario" class="form-label">TIPO USUARIO:</label>
        <input type="hidden" name="TipoUsuario" value="<?php echo $tipoUsuario;?>">
        <select id="selectTipoUsuario"name="TipoUsuarioSelect">
          <option value="<?php echo $tipoUsuario;?>"selected><?php echo $tipoUsuario;?></option>
          <?php 
            if ($tipoUsuario == "User") {
              echo ' <option value="Admin" >Admin</option>';
            } else{
              echo '<option value="User" >User</option>';
            }
          ?>
         
        </select>
      </div>
      <div class="divDatos">
        <button type="submit" class="btn">Guardar</button>
      </div>
    </form>
  </fieldset>
  <fieldset>        
  <legend>EMPRENDIMIENTOS DEL USUARIO</legend>
  <table class="table">
    <?php
      $emprendimientos = "SELECT id,nombre,telefono,direccion, estado FROM emprendimientos  WHERE id_user = '$id'"; 
      $datosEmprendimientos = $conexion->query($emprendimientos);
      if ($datosEmprendimientos->num_rows > 0) {
          echo' <thead>
                  <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Telefono</th>
                  <th scope="col">Direccion</th>
                  <th scope="col">Estado</th>
                  </tr>
                </thead>';
      }
    ?>
     
      <tbody>
        <?php
          if ($datosEmprendimientos->num_rows > 0) {
            while($row = $datosEmprendimientos->fetch_assoc()) {
              echo '<tr id="'.$row["id"].'">
                  <td>'.$row["nombre"].'</td>
                  <td>'.$row["telefono"].'</td>
                  <td>'.$row["direccion"].'</td>
                  <td>'.$row["estado"].'</td>
                  </tr>';              
          }
          } else {
              echo' <P class="pEmprendimientos">Este usuario no tiene emprendimientos registrados</P>';
          }
        ?>
      </tbody>
    </table>

  </fieldset>
</div>

<?php include('componentes/footer.php') ?>