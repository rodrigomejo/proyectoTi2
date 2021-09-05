<?php
include 'conexion.php';
session_start();

$data = json_decode($_POST['nuevoEmprendimiento'], true);
//print_r($data);
echo $data['imagenes'][0];
die();
//Alta Emprendimiento 
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$descripcion = $_POST['descripcion'];
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
      
echo "Ultimo ID : ".$idem; 
}else{
      echo $altaEmprendimiento;
}

?>