<?php
include('componentes/header.php'); 
$id = isset($_GET["id"]) ? $_GET["id"] :0;
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
  <div class="serparador"></div>
  <fieldset>
    <legend>DATOS DEL USUARIO</legend>
    <form action="validations/crear-valid.php" method="post" class="row g-3" enctype="multipart/form-data">
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
        <select id="selectTipoUsuario"name="TipoUsuario">
          <option value="value1"selected><?php echo $tipoUsuario;?></option>
          <option value="value2" >Admin</option>
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