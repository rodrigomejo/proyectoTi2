<?php
include('conexion.php'); 
$idemp = $_POST['id'];
$q = "UPDATE comentarioempr SET notificacion= 0 WHERE id_empre = $idemp";
$res = $conexion->query($q);
if ($res) {
   header('Location: ../perfilUsuario.php');
}
?>