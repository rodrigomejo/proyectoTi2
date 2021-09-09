<?php
include 'conexion.php';
session_start();

$data = json_decode($_POST['nuevoEmprendimiento'], true);
//Alta Emprendimiento 
$nombre = $data['nombre'];
$direccion = $data['direccion'];
$telefono = $data['telefono'];
$descripcion = $data['descripcion'];
$id = $_SESSION['id'];
$estado = "PENDIENTE";

$insertEmprendimiento = "INSERT INTO emprendimientos(nombre, descripcion, telefono, direccion, id_user, estado) VALUES ('$nombre','$descripcion', '$telefono', '$direccion', '$id', '$estado')";

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

?>