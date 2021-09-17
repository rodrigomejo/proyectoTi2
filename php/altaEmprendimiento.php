<?php
      include 'conexion.php';
      session_start();
      if (isset($_POST['nuevoEmprendimiento'])) {
            $data = json_decode($_POST['nuevoEmprendimiento'], true);

            //Alta Emprendimiento 
            $nombre = $data['nombre'];
            $direccion = $data['direccion'];
            $telefono = $data['telefono'];
            $descripcion = $data['descripcion'];
            $id_user = $_SESSION['id'];
            $estado = "PENDIENTE";

            $insertEmprendimiento = "INSERT INTO emprendimientos(nombre, descripcion, telefono, direccion, id_user, estado) VALUES ('$nombre','$descripcion', '$telefono', '$direccion', '$id_user', '$estado')";

            $altaEmprendimiento = mysqli_query($conexion, $insertEmprendimiento);

            if ($altaEmprendimiento){
                  $query= "SELECT @@identity AS id";
                  $idempre = mysqli_query($conexion, $query);
                  if ($row = mysqli_fetch_row($idempre)) {
                        $idem = trim($row[0]);
                  }
                  //Insertar todas las imagenes subidas
                  for ($i=0; $i < count($data['imagenes']) ; $i++) {
                        $ruta = $data['imagenes'][$i];
                        $insertImgEmprendimiento = "INSERT INTO imagenesemp(id_empre,num, ruta) VALUES ('$idem', '$i', '$ruta')";
                        $altaimgEmprendimiento = mysqli_query($conexion, $insertImgEmprendimiento);
                  }
                  //Insertar todas las categorias 
                  for ($i=0; $i < count($data['categoria']) ; $i++) {
                        $categoria = $data['categoria'][$i];
                        $insertCatEmprendimiento = "INSERT INTO categoriasemp(id_empre,categoria) VALUES ('$idem', '$categoria')";
                        $altaCatEmprendimiento = mysqli_query($conexion, $insertCatEmprendimiento);
                  }
                  echo "$altaEmprendimiento"; 
            }else{
                  echo $altaEmprendimiento;
            }
      }else if (isset($_POST['modEmprendimiento'])) {
            $dataMod = json_decode($_POST['modEmprendimiento'], true);
            //Modificar Emprendimiento 
            $nombre = $dataMod['nombre'];
            $direccion = $dataMod['direccion'];
            $telefono = $dataMod['telefono'];
            $descripcion = $dataMod['descripcion'];
            $id = $dataMod['id'];
            $estado = "PENDIENTE";

            $updateEmprendimiento = "UPDATE emprendimientos SET nombre = '$nombre', descripcion = '$descripcion', telefono = '$telefono', direccion = '$direccion', estado = '$estado' WHERE id = $id";
            $updateEmprendimientoRes = mysqli_query($conexion, $updateEmprendimiento);
            
            if ($updateEmprendimientoRes){
                  $deleteImg = "DELETE FROM imagenesemp
                  WHERE id_empre = $id";
                  $deleteImgEmprendimiento = mysqli_query($conexion, $deleteImg);
                  if ($deleteImgEmprendimiento) {
                  //Insertar todas las imagenes subidas
                        for ($i=0; $i < count($dataMod['imagenes']) ; $i++) {
                              $ruta = $dataMod['imagenes'][$i];
                              $insertImgEmprendimiento = "INSERT INTO imagenesemp(id_empre,num, ruta) VALUES ('$id', '$i', '$ruta')";
                              $altaimgEmprendimiento = mysqli_query($conexion, $insertImgEmprendimiento);
                        }
                  } 
            $deleteCategoria = "DELETE FROM categoriasemp WHERE id_empre = $id";
            $deleteCatEmprendimiento = mysqli_query($conexion, $deleteCategoria);
                  if ($deleteCatEmprendimiento) {
                        //Insertar todas las categorias 
                        for ($i=0; $i < count($dataMod['categoria']) ; $i++) {
                              $categoria = $dataMod['categoria'][$i];
                              $insertCatEmprendimiento = "INSERT INTO categoriasemp(id_empre,categoria) VALUES ('$id', '$categoria')";
                              $altaCatEmprendimiento = mysqli_query($conexion, $insertCatEmprendimiento);
                        }
                  }
                  echo "$updateEmprendimientoRes"; 
            }else{
                  echo $updateEmprendimientoRes;
            }
      }else{
            $idEmpre = $_POST['id'];
            $msgEstadoEmpr = $_POST['textMsgEstado'];
            $estadoEmpr = $_POST['selectEstadoEmpre'];
            $actEstadoEmpre = "UPDATE emprendimientos SET estado = '$estadoEmpr' WHERE id = $idEmpre";
            $conexion->query($actEstadoEmpre);
            if ($msgEstadoEmpr !="") {
                  $insertMsgEmprendimiento = "INSERT INTO comentarioempr(id_empre,comentario) VALUES ('$idEmpre', '$msgEstadoEmpr')";
                  $conexion->query($insertMsgEmprendimiento);
            }
            header("location:../administrar.php");
      }

?>