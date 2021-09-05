<?php
include 'conexion.php';

   //Alta de usuarios 
   $nombreCompleto = $_POST['nombreCompleto'];
   $correo = $_POST['email'];
   $usuario = $_POST['usuario'];
   $password = password_hash($_POST['passwordRegistro'],PASSWORD_DEFAULT,['cost'=> 10]) ;
   $telefono = $_POST['telefono'];
   $tipoUsuario = 'User';
   //verificar si el correo y el telefono ya existen 
   $verificarCorreo = mysqli_num_rows( mysqli_query($conexion, "SELECT * FROM usuario WHERE correo = '$correo'")) == 0 ? 0 :"errorCorreo";

   $verificarTelefono = mysqli_num_rows( mysqli_query($conexion, "SELECT * FROM usuario WHERE telefono = '$telefono'")) == 0 ? 0 :"errorTelefono";

   $verificarUsuario = mysqli_num_rows( mysqli_query($conexion,  "SELECT * FROM usuario WHERE usuario = '$usuario'"))== 0 ? 0 :"errorUsuario";
   //Insertar usuario
   $insertUsuario = "INSERT INTO usuario(nombreCompleto, usuario, correo, password, telefono, tipoUsuario) 
                     VALUES ('$nombreCompleto','$usuario', '$correo', '$password', '$telefono', '$tipoUsuario')";
   if ($verificarUsuario == 0 && $verificarCorreo== 0 && $verificarTelefono == 0 ) {
       $altaUsuario = mysqli_query($conexion, $insertUsuario);
       if ($altaUsuario){
         echo $altaUsuario ;
       }else{
         echo $altaUsuario;
         }
   }else{
      echo $verificarUsuario." ".$verificarCorreo." ".$verificarTelefono ;
   }
  
?>