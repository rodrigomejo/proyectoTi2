<?php 
  include('componentes/header.php');
  include('./php/conexion.php'); 
  $idempre = $_POST['id'];
  $emprendimiento = "SELECT * FROM emprendimientos WHERE id = $idempre";
  $emprendimientoImg = "SELECT num, ruta FROM imagenesemp WHERE id_empre = $idempre";
  $emprendimientocat = "SELECT categoria FROM categoriasemp WHERE id_empre = $idempre";
  $emprendimientoImgResul = $conexion->query($emprendimientoImg);
  $emprendimientoResul = $conexion->query($emprendimiento);
  if ($emprendimientoResul->num_rows > 0) {
      while($row = $emprendimientoResul->fetch_assoc()) {
        $nombreEmp = $row['nombre'];
        $telefonoEmp= $row['telefono'];
        $descripcionEmp = $row['descripcion'];
        $direccionEmp =$row['direccion'];    
        $usuario =$row['id_user'];   
        $estado = $row['estado'];   
      }
  }
?>
<div class="cuerpoPagina">
  <div class="separador">
    <a class="btnAtras" href="./php/back.php">ATRAS</a>
  </div>
  <h1><?php echo $nombreEmp;?></h1>
  <div class="contenedorCarusel">
  <div class="caruselBtn caruselBtnAdelante" id="caruselBtnAdelante" >&#62</div>
    <div class="carusel" id="carusel">
      <?php
        if ($emprendimientoImgResul->num_rows > 0) {
          while($row = $emprendimientoImgResul->fetch_assoc()) {
                echo'<div class="caruselItem">
                        <img class="caruselImg" src="'.$row['ruta'].'" alt="">
                      </div>';
          }
        }
      ?>
    </div>
    <div class="caruselBtn caruselBtnAtras" id="caruselBtnAtras">&#60</div>
  </div>
  <div>
    <fieldset>
      <legend>SOBRE EL EMPRENDIMIENTO</legend>
      <form action="./php/altaEmprendimiento.php" method="post" enctype="multipart/form-data">
        <div class="divEstilo">
          <div class="divDatos">
            <input type="hidden" name="id" value="<?php echo $idempre;?>">
            <label for="username" class="">PUBLICADO POR:</label>
            <P>
              <?php 
                $nombre = "SELECT nombreCompleto FROM usuario WHERE id = '$usuario'";
                $datonombreRes = $conexion->query($nombre);
                while($nombreRes = $datonombreRes->fetch_assoc()) {
                  $nom = $nombreRes['nombreCompleto'];
                }
                echo $nom;
              ?>
            </P>
          </div>
          <div class="divDatos">
            <label for="" class="">DIRECCION:</label>
            <P><?php echo $direccionEmp;?></P>
          </div>
        </div>
        <div class="divEstilo">
          <div class="divDatos" >
            <label for="" class="">TELEFONO:</label>
            <P><?php echo $telefonoEmp;?></P>
          </div>
          <div class="divDatos" >
            <label for="" class="">DESCRIPCION:</label>
            <P><?php echo $descripcionEmp;?></P>
          </div>
        </div>
        <?php
          if ($_SESSION['tipoUsuario'] == "Admin") {
              echo '<div class="divDatos">
                    <label for="selectEstadosEmpre" class="">ESTADO DEL EMPRENDIMIENTO:</label>
                    <select id="selectEstadoEmpre" class="selectEstadoEmpre" name="selectEstadoEmpre">
                      <option value=" '.$estado.'"selected>'.$estado.'</option> ';
              if ($estado != "PENDIENTE") {
                  echo '  <option value="PENDIENTE" >PENDIENTE</option>
                          <option value="NO PUBLICADO" >NO PUBLICADO</option>
                        </select>';
              } else{
                  echo '  <option value="PUBLICADO" >PUBLICADO</option>
                          <option value="NO PUBLICADO" >NO PUBLICADO</option>
                        </select>';
              }
              echo'   <div id="msgEstadoEmpre" class="msgEstadoEmpre">
                        <textarea class="textMsgEstado" name="textMsgEstado"></textarea>
                      </div>
                    </div>
                    <div class="divDatos">
                      <button type="submit" class="btn">Guardar</button>
                    </div>';
          }
        ?>
      </form>
    </fieldset>
  </div>
<?php include('componentes/footer.php') ?>