<?php

  class Tabla{

    public function mostrar(){
      echo '<form><div class="form-group"><label for="exampleInputEmail1">Email address</label><input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"><small id="emailHelp" class="form-text text-muted">Well never share your email with anyone else.</small></div><div class="form-group"><label for="exampleInputPassword1">Password</label><input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"></div><div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1"><label class="form-check-label" for="exampleCheck1">Check me out</label></div><button type="submit" class="btn btn-primary">Submit</button></form>';
    }

    public function alumnosEje(){
      echo '<div class="container-fluid"><div class="page-header"><h3 style="text-align: center"><p>Grupo Eje</p></h3></div><table id="eje" class="table table-hover table-bordered" style="width: 100%;"><thead><tr><th>Matrícula</th><th>Nombres</th><th>Apellidos</th></tr></thead><tfoot><tr><th>Matrícula</th><th>Nombres</th><th>Apellidos</th></tr></tfoot></table></div>';
    }

    public function alumnos($cont){
      echo '<div class="container-fluid"><div class="page-header"><h3 style="text-align: center"><p>Alumnos</p></h3></div><table id="tb'.$cont.'" class="table table-hover table-bordered" style="width: 100%;"><thead><tr><th>Matrícula</th><th>Nombres</th><th>Apellidos</th><th>Calificación</th></tr></thead><tfoot><tr><th>Matrícula</th><th>Nombres</th><th>Apellidos</th><th>Calificación</th></tr></tfoot></table></div>';
    }

    public function fechas(){
      echo '<div class="container-fluid"><div class="page-header"><h3 style="text-align: center"><p>Fechas de Proyecto</p></h3></div><table id="fecha" class="table table-hover table-bordered" style="width: 100%;"><thead><tr><th>Grupo</th><th>Fecha</th><th>Auditorio</th></tr></thead><tfoot><tr><th>Grupo</th><th>Fecha</th><th>Auditorio</th></tr></tfoot></table></div>';
    }

    public function califAlumno(){
      echo '<div class="container-fluid"><div class="page-header"><h3 style="text-align: center"><p>Calificaciones</p></h3></div><table id="cal" class="table table-hover table-bordered" style="width: 100%;"><thead><tr><th>Nombres</th><th>Apellidos</th><th>Número Equipo</th><th>Problemática</th><th>Calificación Final</th></tr></thead><tfoot><tr><th>Nombres</th><th>Apellidos</th><th>Número Equipo</th><th>Problemática</th><th>Calificación Final</th></tr></tfoot></table></div>';
    }

    public function eva($cont,$proyecto){
      echo '<div class="container-fluid"><div class="page-header"><h3 style="text-align: center"><p>Calificaciones</p></h3><form style="text-align: center"  method="post" action="aplicarMovimiento.php"><input value="'.$proyecto.'" name="proyecto" type="text" class="form-control" style="display:none"></br><button name="evaAlta" type="submit" class="btn btn-utj btn-lg"><i class="fas fa-clipboard-check"></i> Evaluar</button></br></form></div><table id="eva'.$cont.'" class="table table-sm table-hover table-bordered" style="width: 100%;"><thead><tr><th>Nombres</th><th>Apellidos</th><th>Puntualidad</th><th>Presentación Personal</th><th>Expresión Oral</th><th>Organización de Equipo</th><th>Apoyos Visuales</th><th>Contenido Temático</th><th>Dominio del tema</th><th>Recomendaciones</th></tr></thead><tfoot><tr><th>Nombres</th><th>Apellidos</th><th>Puntualidad</th><th>Presentación Personal</th><th>Expresión Oral</th><th>Organización de Equipo</th><th>Apoyos Visuales</th><th>Contenido Temático</th><th>Dominio del tema</th><th>Recomendaciones</th></tr></tfoot></table></div>';
    }

  }

?>
