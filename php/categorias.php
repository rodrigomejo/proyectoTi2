<?php
   include 'conexion.php';
   $categoria = strtoupper($_POST['categoria']);
   $idCategoria = $_POST['id'];
   echo $idCategoria;
   echo $categoria;
   if ($idCategoria != "") {
      $query = "UPDATE categorias SET categoria = '$categoria' WHERE id = $idCategoria";
   }else{
      $query = "INSERT INTO categorias(categoria) 
      VALUES ( '$categoria')";
   }
   $conexion->query($query);
   header("location:../administrar.php");
?>