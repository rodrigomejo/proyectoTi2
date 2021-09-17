<?php
include 'conexion.php';
$idusu = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL);
$usuario = $_POST['username'];
$telefono = $_POST['telefono'];

$veriEmail = "SELECT * FROM usuario WHERE correo = '$correo' AND id <> $idusu ";
$veriUsername = "SELECT * FROM usuario WHERE usuario = '$usuario' AND id <> $idusu ";
$veriTelefono = "SELECT * FROM usuario WHERE telefono = '$telefono' AND id <> $idusu ";
if ($correo != "") {
   $veriEmailRes = $conexion->query($veriEmail);
   $veriUsernameRes = $conexion->query($veriUsername);
   $veriTelefonoRes = $conexion->query($veriTelefono);

   $veriEmailRes = $veriEmailRes->num_rows == 0 ? $veriEmailRes->num_rows : 'emailRepe';
   $veriUsernameRes = $veriUsernameRes->num_rows == 0 ? $veriUsernameRes->num_rows : 'userRepe';
   $veriTelefonoRes = $veriTelefonoRes->num_rows == 0 ? $veriTelefonoRes->num_rows : 'teleRepe';

   if ($veriEmailRes == 0 && $veriUsernameRes== 0 && $veriTelefonoRes == 0) {
      if ($nombre !=""&& $usuario !="" && $telefono !="") {
         $query = "UPDATE usuario SET telefono = '$telefono', nombreCompleto = '$nombre', usuario = '$usuario', correo = '$correo' WHERE id = $idusu";
         $resultado = $conexion->query( $query);
         if ($resultado) {
            echo $resultado;
         }
      }else{
         echo'camposVacios';
      }
      
   }else{
      echo $veriEmailRes.' '.$veriUsernameRes.''.$veriTelefonoRes;
   }
}else{
   echo "correoInvalido";
}

?>