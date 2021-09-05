<?php
session_start();
session_destroy();
echo '  <script type="text/javascript">
window.sesion = false;
</script>';
header('Location: ../index.php');
exit;
?>