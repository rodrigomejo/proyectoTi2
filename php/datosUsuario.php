<?php
session_start();
$id = $_SESSION['id'];
include 'conexion.php';

$verificarUsuario = "SELECT nombreCompleto, correo, telefono, id FROM usuario WHERE id = '$id'";
$verificarUsuarioRes = mysqli_query($conexion, $verificarUsuario);
$datosUsuarios =  mysqli_fetch_array($verificarUsuarioRes);
$usuario = [
   "nombreCompleto" => $datosUsuarios['nombreCompleto'],
   "correo" => $datosUsuarios['correo'],
   "telefono" => $datosUsuarios['telefono'],
   "id" => $datosUsuarios['id'],
];

 echo json_encode($usuario);
?>