<?php
$paginaActual = basename($_SERVER['PHP_SELF']);
switch ($paginaActual) {
   case "index.php":
      $titulo = "Inicio";
      $estilo = array(' <link rel="stylesheet" href="css/index.css">', 
                      ' <link rel="stylesheet" href="css/estiloscard.css">');
      $script = array();
      $selectIndex = 'class="select"';
      break;
   case "inicioRegistro.php":
      $titulo = "Inicio";
      $estilo = array(' <link rel="stylesheet" href="./css/estiloInicioRegistro.css">', 
                      ' <link rel="stylesheet" href="./css/estiloModal.css">');
      $script = array('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>','<script src="./js/funcionInicioRegistro.js"></script>');
      $selectPerfilSes = 'class="select"';
      break;
   case "perfilUsuario.php":
      $titulo = "Perfil";
      $estilo = array(' <link rel="stylesheet" href="./css/estilosPerfil.css">', 
                      ' <link rel="stylesheet" href="./css/estiloModal.css">');
      $script = array('<script src="./js/funcionesPerfilUsuario.js"></script>','<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>', 
                      ' <link rel="stylesheet" href="./css/estiloModal.css">');
      $selectPerfilSes = 'class="select"';
      break;
   case "emprendimiento.php":
      $titulo = "Emprendimiento";
      $estilo = array(' <link rel="stylesheet" href="css/estilosEmprendimiento.css">');
      $script = array('<script src="./js/funcionesEmprendimiento.js"></script>');
      $selectEmps = 'class="select"';
      break;
   case "emprendimientos.php":
      $titulo = "Emprendimientos";
      $estilo = array(' <link rel="stylesheet" href="./css/estilosEmprendimientos.css">', 
                      ' <link rel="stylesheet" href="./css/estiloscard.css">');
      $script = array();
      $selectEmps = 'class="select"';
      break;
   case "administrar.php":
         $titulo = "Administrar";
         $estilo = array(' <link rel="stylesheet" href="./css/estilosAdministrar.css">', 
                        ' <link rel="stylesheet" href="./css/estiloModal.css">');
         $script = array('<script src="./js/funcionesAdministrar.js"></script>','<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>');
         $selectAdmin= 'class="select">ADMINISTRAR</a>';
         break;
   case "adminUsu.php":
         $titulo = "administrar";
         $estilo = array(' <link rel="stylesheet" href="./css/estilosAdminUsu.css">', 
                         ' <link rel="stylesheet" href="./css/estiloModal.css">');
         $script = array('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>');
         $selectAdmin= 'class="select">ADMINISTRAR</a>';
         break;
}
session_start();
if (null == ( isset( $_SESSION['id']))) {     
   $perfilsesion = "INICIAR SESION";
} else{
   $perfilsesion = "PERFIL";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $titulo?></title>
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/footer.css">
   <?php for ($i=0; $i < count($estilo) ; $i++) { 
          echo $estilo[$i];
         }
    ?>
   <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>
<body>
<header id="header">
   <div class="contenedorHeader">
      <div class="logo">
         <img src="./img/2103622.png">
      </div>
      <div class="contenedorNav">
         <nav id="nav">
            <ul>
               <li><a href="index.php" 
                  <?php if (true == isset($selectIndex)){echo $selectIndex;}?> >INICIO</a>
               </li>
               <li><a href="emprendimientos.php"
                  <?php if (true == isset($selectEmps)){echo $selectEmps;}?> >EMPRENDIMIENTOS</a>
               </li>
               <li><a href="inicioRegistro.php"
               <?php if (true == isset($selectPerfilSes)){echo $selectPerfilSes;}?>><?php echo $perfilsesion?></a>
               </li>
               <?php if (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == "Admin") {
                        echo "<li>";
      	               echo "<a href='administrar.php'";
                        if (true == isset($selectAdmin)) {
                           echo $selectAdmin;
                           }else{
                              echo ">ADMINISTRAR</a>";
                           }
                        echo "</li>";
                     }
               ?>
            </ul>
         </nav>
      </div>
   </div>
</header>