<?php 
  include('componentes/header.php');
  include('./php/conexion.php'); 
  $id = $_SESSION['id'];
  if (isset($_SESSION['filtros'])&& isset($_SESSION['stringBuscar']) && $_SESSION['stringBuscar']!= "") {
    $filtros = $_SESSION['filtros'];
    $stringBuscar = $_SESSION['stringBuscar'];
    if ($filtros == "1") {
      $empPublicados = "SELECT emprendimientos.id, emprendimientos.nombre, 
      emprendimientos.descripcion,emprendimientos.telefono, emprendimientos.direccion, emprendimientos.id_user,emprendimientos.estado FROM emprendimientos INNER JOIN usuario on usuario.id = emprendimientos.id_user WHERE usuario.nombreCompleto LIKE '% $stringBuscar%' AND emprendimientos.estado = 'PUBLICADO';";
    }else if ($filtros == "2") {
      $empPublicados = "SELECT * FROM emprendimientos INNER JOIN categoriasemp on emprendimientos.id = categoriasemp.id_empre WHERE categoriasemp.categoria LIKE  '%$stringBuscar%' AND emprendimientos.estado = 'PUBLICADO'";
    }
  }else{
    $empPublicados = "SELECT * FROM emprendimientos WHERE estado = 'PUBLICADO'";
    $stringBuscar = "BUSCAR";
    $filtros = "0";
  }
  $datosEmpPublicados = $conexion->query($empPublicados);
?>
  <div class="cuerpoPagina">
    <div class="contenedorCategoriasBuscar">
      <form class="formBuscar" action="./php/buscador.php" method="POST">
        <select class="selectFiltro" name="filtros">
          <?php 
            if ($filtros == "0") {
              echo'<option value="0"selected>FILTROS</option>
                    <option value="1">AUTOR</option>
                    <option value="2">CATEGORIA</option>';
            }elseif ($filtros == "1"){
              echo'<option value="0">FILTROS</option>
              <option value="1" selected>AUTOR</option>
              <option value="2">CATEGORIA</option>';
            }else{
              echo'<option value="0">FILTROS</option>
              <option value="1">AUTOR</option>
              <option value="2"selected>CATEGORIA</option>';
            }
          
          ?>
        </select>
          <div class="contenedorBuscar">
            <input type="search" id="search" name="stringBuscar" placeholder="<?php echo $stringBuscar ?>">
            <button type="submit" class="icon">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </div>
      </form>
      <form action="./php/buscador.php">
            <input type="hidden"  name="stringBuscar">
            <input type="hidden" name="filtros" >
            <button type="submit" class="iconMod">
              <i class="far fa-trash-alt"></i>
            </button>
      </form>
    </div>
    <div class="filtroActivo">
        <?php 
          if ($filtros != "0" && $stringBuscar !="BUSCAR") {
            if ($filtros != "1") {
              echo'<h3>RESULTADO AUTOR:'.$stringBuscar.'</h3>';
            }else{
              echo'<h3>RESULTADO CATEGORIAS:<p>"'.$stringBuscar.'" </p></h3>';
            }
          }
        ?>
      </div>
    <div class="contenedorCardPrincipal" id="contenedorCardPrincipal">
      <?php
        if ($datosEmpPublicados->num_rows > 0) {
          while($row = $datosEmpPublicados->fetch_assoc()) {
            $idusu = $row['id_user'];
            $idEmpr = $row['id'];
            $nombre = "SELECT nombreCompleto FROM usuario WHERE id = '$idusu'";
            $datosnombreRes = $conexion->query($nombre);
            while($nombreRes = $datosnombreRes->fetch_assoc()) {
              $nom = $nombreRes['nombreCompleto'];
            }
            echo'<div class="contenedorCard">
                      <div class="card">
                          <div class="cardFront">
                              <div class="cuerpoCardFront">';
            $imgEmpre = "SELECT ruta FROM imagenesemp WHERE id_empre = $idEmpr";
            $imgEmpreResul = $conexion->query($imgEmpre);
            if ($imgEmpreResul->num_rows > 0) {
              $datosImagenes =  mysqli_fetch_array($imgEmpreResul);
                  echo '<img src="'.$datosImagenes['ruta'].'" alt="">';
            }
                  echo'<h2>'.$row['nombre'].'</h2>
                              </div>
                          </div>
                          <div class="cardBack">
                            <div class="cuerpoCardBack">
                              <h4>PUBLICADO POR:</h4>
                              <h2>'.$nom.'</h2>
                              <h4>CATEGORIAS:</h4>';
            $categoria = "SELECT categoria FROM categoriasemp WHERE id_empre = '$idEmpr'";
            $datosCategoriaRes = $conexion->query($categoria);
            if ($datosCategoriaRes->num_rows > 0) {
                  echo'<div class="">';
                  while($categoriaRes = $datosCategoriaRes->fetch_assoc()) {
                                  echo' <p>'.$categoriaRes['categoria'].'</p>';
                                  }
                  echo'</div>';                
            }                       
                  echo'<h4>DESCRIPCION:</h4>
                      <p>'.$row['descripcion'].'</p>
                      <td style="display:flex">
                        <form action="emprendimiento.php" method="post">
                            <input type="hidden" value="'.$row["id"].'" name="id">
                            <button type="submit" class="btnEditar">LEER MÁS</button>
                        </form>
                    </div>
                </div>
              </div>
            </div>';
          }
        }else{
          echo'<h2 class="msgEmpre">TODAVIA NO HAY EMPRENDIMIENTOS PUBLICADOS</h2>';
        }
      ?>
    </div>
  </div>
<?php include('componentes/footer.php') ?>