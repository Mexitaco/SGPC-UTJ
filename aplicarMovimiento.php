<?php
include 'loginSecurity.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Confirmación</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
  </head>
  <body>

  <!--
    Cada if se encarga de redireccionar los valores enviados de los formularios a su repectiva consulta,
    en general este archivo se encarga de validar y enviar la información de todas las
    altas del sistema
  -->

  <?php

  date_default_timezone_set("America/Mexico_City");
  header('Refresh: 1; URL=index.php');

  if(isset($_POST['altaCal'])){//Valida si se envía el formulario
  
    include 'Modelo/Calificacion.php';

    $calificacion = new Calificacion();
    $calificacion->setCodigoProfesor($_POST['codigoProfesor']);
    $calificacion->setIdProyecto($_POST['nombreProyecto']);
    $calificacion->setPuntu($_POST['puntu']);
    $calificacion->setPrePer($_POST['prePer']);
    $calificacion->setExpOral($_POST['expOral']);
    $calificacion->setOrgEquipo($_POST['orgEquipo']);
    $calificacion->setApVisual($_POST['apVisual']);
    $calificacion->setConTema($_POST['conTema']);
    $calificacion->setDomTem($_POST['domTem']);
    $calificacion->setRecomed($_POST['recomed']);
    $calificacion->altaEvaluacionProfesor();

    ?>

    <div class="container">
      <br>
      <center>
        <img class="rounded" height="25%" width="25%" src="img/ok.png" alt="">
        <div class="container">
          <p class="h3">Calificación enviada correctamente</p>
        </div>
      </center>
    </div>

  <?php
    }elseif (isset($_POST['altaEquipo'])){

      include 'Modelo/Alumno.php';

      $alumno = new Alumno();
      $matricula = "";
      $alumno->setNumEquipo($_POST['numProyecto']);
      $alumno->setNombreEquipo($_POST['nombreProyecto']);
      $alumno->setProblematica($_POST['problematica']);
      $alumno->crearProyecto();
      $alumno->setFechaProyecto($_POST['fechaGrupo']);
      $alumno->setHora($_POST['hora']);

      if (isset($_POST['integrante1'])) {
        $matricula = $_POST['integrante1'];
        $alumno->asignarProyecto($matricula);
      }

      if (isset($_POST['integrante2'])) {
        $matricula = $_POST['integrante2'];
        $alumno->asignarProyecto($matricula);
      }

      if (isset($_POST['integrante3'])) {
        $matricula = $_POST['integrante3'];
        $alumno->asignarProyecto($matricula);
      }
      
      if (isset($_POST['integrante4'])) {
        $matricula = $_POST['integrante4'];
        $alumno->asignarProyecto($matricula);
      }
      
      if (isset($_POST['integrante5'])) {
        $matricula = $_POST['integrante5'];
        $alumno->asignarProyecto($matricula);
      }

  ?>

    <div class="container">
      <br>
      <center>
        <img class="rounded" height="25%" width="25%" src="img/ok.png" alt="">
        <div class="container">
          <p class="h3">Equipo registrado correctamente</p>
        </div>
      </center>
    </div>

  <?php
    }elseif (isset($_POST['modificarFecha'])){

      include_once 'clases/grupo.php';

      $calificacion = new grupo();
      $calificacion->setHora($_POST['hora']);
      $calificacion->setFechaNueva($_POST['fecha']);
      $calificacion->setAuditorio($_POST['auditorio']);
      $calificacion->setFechaProyecto($_POST['fechaN']);
      $calificacion->setGrado($_POST['grado']);
      $calificacion->setLetra($_POST['letra']);
      $calificacion->actualizarEquipo();
      $calificacion->actualizarFecha();

  ?>
  
  <div class="container">
    <br>
    <center>
      <a href="areaConsulta.php?m=M" class="btn btn-default">Regresar</a>
      <a href="index.php" class="btn btn-default">Salir</a>
    </center>
    </div>
  <div class="container">
    <br>
    <center>
      <a href="areaConsulta.php?m=M" class="btn btn-default">Regresar</a>
      <a href="index.php" class="btn btn-default">Salir</a>
    </center>
  </div>

  <?php
    }elseif (isset($_POST['evaAlta'])){

    include_once 'Modelo/Calificacion.php';

    $calificacion = new Calificacion();
    $calificacion->setIdProyecto($_POST['proyecto']);
    $calificacion->evaluacionFinal();

  ?>
  
    <div class="container">
      <br>
      <center>
        <img class="rounded" height="25%" width="25%" src="img/ok.png" alt="">
        <div class="container">
          <p class="h3">Proyecto evaluado correctamente</p>
        </div>
      </center>
    </div>

  <?php
    }//fin de las validaciones de las altas
  ?>

  </body>
</html>
