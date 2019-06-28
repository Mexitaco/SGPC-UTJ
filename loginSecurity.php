<?php

/*
  Comprueba que exista una sesion con los datos correctos, para asi 
  acceder a la información, comprueba que el usuario este autentificado y
  si no existe, reedirecciona a la página de autentificacion
*/

session_start();

if ($_SESSION['valido'] != '1') {
 
 header('Location: inicio.php');
 
 exit();
}

?>
