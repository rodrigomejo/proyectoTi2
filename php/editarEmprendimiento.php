<?php
   $idEmpre = $_POST['idEmpre'];
   include('conexion.php'); 
   //Traigo los datos del emprendimiento
   $query = "SELECT * FROM emprendimientos WHERE id = $idEmpre";
   $datosEmprendimientoRes = $conexion->query($query);
   $datosEmprendimiento =  mysqli_fetch_array($datosEmprendimientoRes);
   //Traigo las imagenes del emprendimiento 
   $datosImagenes =[];
   $imagenes = "SELECT num, ruta FROM imagenesemp WHERE id_empre = $idEmpre";
   $imagenesRes = $conexion->query($imagenes);
   if ($imagenesRes->num_rows > 0) {
      while($row = $imagenesRes->fetch_assoc()) {
         $ImagenesArray =array( "num" => $row['num'], "ruta" =>$row['ruta']);
         array_push($datosImagenes, $ImagenesArray);
      }
   }
   //traigo las categorias del emprendimiento
   $datosCategoria =[];
   $categoria = "SELECT categoria FROM categoriasemp WHERE id_empre = $idEmpre";
   $categoriaRes = $conexion->query($categoria);
   if ($categoriaRes->num_rows > 0) {
      while($row = $categoriaRes->fetch_assoc()) {
         array_push($datosCategoria, $row['categoria']);
      }
   }
   //Creo el objeto y lo mando como json
   $emprendimiento = [
      "id" => $datosEmprendimiento['id'],
      "nombre" => $datosEmprendimiento['nombre'],
      "descripcion" => $datosEmprendimiento['descripcion'],
      "telefono" => $datosEmprendimiento['telefono'],
      "direccion" => $datosEmprendimiento['direccion'],
      "estado" => $datosEmprendimiento['estado'],
      "imagenes" => $datosImagenes,
      "categoria" => $datosCategoria,
   ];
   echo json_encode($emprendimiento);
?>



