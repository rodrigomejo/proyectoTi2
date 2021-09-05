<?php

include 'conexion.php';

   $usuarioCorreo = $_POST['usuarioCorreo'];
   $password = $_POST['passwordLogin'];
   if (filter_var($usuarioCorreo, FILTER_VALIDATE_EMAIL)) {
      $verificarUsuario = "SELECT * FROM usuario WHERE correo = '$usuarioCorreo'";
   }else{
      $verificarUsuario = "SELECT * FROM usuario WHERE usuario = '$usuarioCorreo'";
   }
  
   
   $verificarUsuarioRes = mysqli_query($conexion, $verificarUsuario);
   $nr = mysqli_num_rows($verificarUsuarioRes);
   $datosUsuarios =  mysqli_fetch_array($verificarUsuarioRes);


   if (($nr == 1) && (password_verify($password, $datosUsuarios['password']))){
      session_start();
      $_SESSION['nombreCompleto'] = $datosUsuarios['nombreCompleto'];
      $_SESSION['id'] = $datosUsuarios['id'];
      $_SESSION['tipoUsuario'] = $datosUsuarios['tipoUsuario'];
      echo $datosUsuarios['nombreCompleto'];
   } else {
      echo "0";
   }

?>