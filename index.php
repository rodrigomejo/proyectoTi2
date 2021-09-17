<?php 
    include('componentes/header.php');
    include('./php/conexion.php'); 
    $empPublicados = "SELECT * FROM emprendimientos WHERE estado = 'PUBLICADO'";
    $datosEmpPublicados = $conexion->query($empPublicados);
?>
<div class="contenedorPrincipal" id="contenedorPrincipal">
    <div class="cover">
        <div class="contenedorPresentacion">
            <div class="containerInfo">
                <h1>PUBLICA TU</h1>
                <h2>EMPRENDIMIENTO</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus molestias cumque at, impedit eum corrupti libero ipsam placeat, nulla, maiores totam qui ea distinctio. Velit, distinctio. Iste iusto deserunt esse?</p>
                <a href="./inicioRegistro.php">PUBLICA  AQUI</a>
            </div>
            <div class="containerImg">
                <img src="img/Tv97tjE.png" alt="">
            </div>
        </div>
    </div>
    <div class="cuerpoPagina">
        <?php 
            if ($datosEmpPublicados->num_rows > 0) {
                echo'<h1>EMPRENDIMIENTOS QUE CONFIAN EN NOSOTROS</h1>';
            }
        ?>
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
                        echo'  <h2>'.$row['nombre'].'</h2>
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
                }
            ?>
        </div>
</div>
<?php include('componentes/footer.php') ?>