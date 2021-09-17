<?php
   include 'conexion.php';
   $idemp = $_POST['id'];
   $conexion->query( "DELETE FROM imagenesemp WHERE id_empre = $idemp; DELETE FROM categoriasemp WHERE id_empre = $idemp,DELETE FROM comentarioempr WHERE id_empre = $idemp ");
   $conexion->query( "DELETE FROM emprendimientos WHERE id = $idemp");
?>