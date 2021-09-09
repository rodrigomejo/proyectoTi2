<?php

include('./conexion.php');
$id = $_POST['id'];
$tipoUsuario = isset($_POST['TipoUsuario']);
$tipoUsuarioSelect = isset($_POST['TipoUsuarioSelect']);

if ($tipoUsuario !="" && $tipoUsuarioSelect!="") {
   if ($tipoUsuario == $tipoUsuarioSelect) {
      session_start();
      $_SESSION['idUsuAdmin'] = $id;
    header("location:../adminUsu.php");
   }else{
      $query = "UPDATE usuario SET tipoUsuario = '$tipoUsuarioSelect' WHERE id = $id";
      $conexion->query($query);
      header("location:../administrar.php");
   }
}else{
   $emprendimientosDelUsuario = $conexion->query("SELECT id FROM emprendimientos WHERE id_user = $id");
   if ($emprendimientosDelUsuario->num_rows > 0) {
      while($row = $emprendimientosDelUsuario->fetch_assoc()) {
         $idemp = $row['id'];
         $conexion->query( "DELETE FROM imagenesemp WHERE id_empre = $idemp; DELETE FROM categoriasemp WHERE id_empre = $idemp ");
      }
   }
   $conexion->query( "DELETE FROM emprendimientos WHERE id_user = $id");   
   $conexion->query("DELETE FROM usuario WHERE id = $id");
}









?>