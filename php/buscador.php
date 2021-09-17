<?php
   session_start();
   if ($_POST['filtros'] !="0") {
      $_SESSION['filtros'] = $_POST['filtros'];
   }else{
      unset($_SESSION['filtros']);
   }

   if ($_POST['stringBuscar'] !="") {
      $_SESSION['stringBuscar'] = $_POST['stringBuscar'];
   }else{
      $_SESSION['stringBuscar'] = "";
   } 
   header("location:../emprendimientos.php");

?> 