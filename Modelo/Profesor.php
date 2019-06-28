  <?php

  include_once 'Conexion.php';

  class Profesor{

  private $codigoProfesor;
  private $nombreProfesor;
  private $apellidoProfesor;
  private $statusProfesor;
  private $grado;
  private $cont;
  private $contEquipos;
  private $equipos;
  private $contEva;

  public function getContEva(){
    return $this->contEva;
  }

  public function setContEva($contEva){
    $this->contEva = $contEva;
  }

  public function getCont(){
  return $this->cont;
  }

  public function setCont($cont){
  $this->cont = $cont;
  }

  public function getContEquipos(){
  return $this->contEquipos;
  }

  public function setContEquipos($contEquipos){
  $this->contEquipos = $contEquipos;
  }

  public function getEquipos(){
  return $this->equipos;
  }
  public function setEquipos($equipos){
  $this->equipos = $equipos;
  }

  public function getCodigoProfesor(){
  return $this->codigoProfesor;
  }

  public function setCodigoProfesor($codigoProfesor){
  $this->codigoProfesor = $codigoProfesor;
  }

  public function getGrado(){
  return $this->grado;
  }

  public function setGrado($grado){
  $this->grado = $grado;
  }

  public function getNombreProfesor(){
  return $this->nombreProfesor;
  }

  public function setNombreProfesor($nombreProfesor){
  $this->nombreProfesor = $nombreProfesor;
  }

  public function getApellidoProfesor(){
  return $this->apellidoProfesor;
  }

  public function setApellidoProfesor($apellidoProfesor){
  $this->apellidoProfesor = $apellidoProfesor;
  }

  public function getStatusProfesor(){
  return $this->statusProfesor;
  }

  public function setStatusProfesor($statusProfesor){
  $this->statusProfesor = $statusProfesor;
  }

  /**
   * Este método sirve para para generar los links a los grupos de cada profesor eje en el menú
   */

  public function gruposProfesorEje(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT p.codigoProfesor,pm.grado,pm.profesorEje FROM Profesor_Materia pm JOIN
    Profesor p ON p.codigoProfesor = pm.codigoProfesor WHERE p.codigoProfesor = '".$_SESSION['nombreUsu']."' ;");

    $query->execute();
    $resultado = $query->fetchAll();
    foreach ($resultado as $value ) {
      $this->setGrado($value['grado']);
      $this->setStatusProfesor($value['profesorEje']);
      if ($value['profesorEje'] == '1') {
        $uno = '<a href="#" onclick="crear('."'eje'".');"  class="list-group-item list-group-item-action bg-light"
        data-parent="#menu1sub1sub1"><i class="fas fa-star"></i>  <strong>Grupo Eje: </strong>   '.$this->getGrado().'</a>';
      }
    }

    $arg=array($uno);
    $cad = implode($arg);
    return $uno;
  }

   /**
   * Este método sirve para para generar los links a los grupos de cada profesor en el menú
   */

  public function gruposProfesor(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT DISTINCT ga.grado FROM Grupo_Alumno ga INNER JOIN Profesor_Materia pm
    INNER JOIN Profesor p ON ga.grado = pm.grado AND pm.codigoProfesor = p.codigoProfesor WHERE p.codigoProfesor = 
    '".$_SESSION['nombreUsu']."'; ");
    
    $query->execute();
    $cont = 0;
    $resultado = $query->fetchAll();
    $lista = array();
    foreach ($resultado as $value ) {
      $cont++;
      $this->setGrado($value['grado']);
      $uno = '<a href="#" onclick="crear('."$cont".');" id="'.$cont.'" 
      class="list-group-item list-group-item-action bg-light" ><i class="fas fa-user-friends">
      </i> '.$this->getGrado().'</a>';
      array_push($lista, $uno);
    }
    $this->setCont($cont);
    $cad = implode($lista);
  
    return $cad;
  }

   /**
   * Este método sirve para para generar los links a los grupos de cada profesor
   * 
   */

  public function gruposCalif(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT pm.grado FROM Profesor_Materia pm JOIN Profesor p ON p.codigoProfesor = 
    pm.codigoProfesor WHERE p.codigoProfesor = '".$_SESSION['nombreUsu']."' AND  pm.profesorEje = 0 ;");

    $query->execute();
    $resultado = $query->fetchAll();
    $cont = 0;
    $lista = array();
    $var = [];

    foreach ($resultado as $value ) {
      $cont++;
      $this->setGrado($value['grado']);
      $var[$cont] =$this->califEquipos($value['grado']);

      $uno = '<a href="#sub'.$cont.'" class="list-group-item list-group-item-action bg-light" 
        data-toggle="collapse" aria-expanded="false">
        <i class="fa fa-plus-circle"></i>  '.$this->getGrado().'</a>';

      $dos = '<div class="collapse" id="sub'.$cont.'">'.$var[$cont].'</div>';
      array_push($lista,$uno,$dos);

    }

      $this->setCont($cont);
      $this->setContEquipos($cont);
      $cad = implode($lista);
      return $cad;
  }

  public function gruposCalifEje(){
    $pdo = new Conexion();
    
    $query = $pdo->prepare("SELECT pm.grado FROM Profesor_Materia pm JOIN Profesor p ON p.codigoProfesor = 
    pm.codigoProfesor WHERE p.codigoProfesor = '".$_SESSION['nombreUsu']."';");

    $query->execute();
    $resultado = $query->fetchAll();
    $cont = 0;
    $lista = array();
    $var = [];
    foreach ($resultado as $value ) {
      $cont++;
      $this->setGrado($value['grado']);
      $var[$cont] =$this->califEquipos($value['grado']);

      $uno = '<a href="#sub'.$cont.'" class="list-group-item list-group-item-action
      bg-light" data-toggle="collapse" aria-expanded="false">
      <i class="fa fa-plus-circle"></i>  '.$this->getGrado().'</a>';

      $dos = '<div class="collapse" id="sub'.$cont.'">'.$var[$cont].'</div>';
      array_push($lista,$uno,$dos);

      }
      
    $this->setContEquipos($cont);
    $cad = implode($lista);

    return $cad;
  }


 /**
   * Este método sirve para para generar los links a los grupos de cada profesor para poder
   * calificar en el menú
   */

  public function califEquipos($grado){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT DISTINCT p.IdProyecto,p.numEquipo,p.nombreEquipo,p.problematica 
    FROM Proyecto p INNER JOIN Alumno_Proyecto ap INNER JOIN Grupo_Alumno ga ON ga.matricula=ap.matricula 
    AND p.IdProyecto=ap.IdProyecto WHERE ga.grado='".$grado."' ");
    
    $query->execute();
    $resultado = $query->fetchAll();
    $lista = array();
    $cont = $this->getContEquipos();
    $iniC = "'";
    $finC = "'";
    foreach ($resultado as $value) {
      $cont++;
      $gr = "'equipo".$cont."'";

      $dos = '<a href="#" onclick="crear('.$gr.');" id="equipo'.$cont.'"  class="list-group-item list-group-item-action
      bg-light"><i class="fas fa-user-check"></i>   '.$value['nombreEquipo'].'</a>';

      $idPro ='<script>var idEquipo'.$cont.'= '.$iniC.'<input value="'.$value['IdProyecto'].'"id="nombreProyecto'.$cont.'"
      name="nombreProyecto" type="text" class="form-control" 
      style="display:none">'.$finC.';</script>';

      array_push($lista,$dos,$idPro);
      $this->setContEquipos($cont);
    }
    $cad = implode($lista);
    return $cad;
  }

  public function alumnosInfoEje(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT a.matricula,a.nombres,a.apellidos,ga.grado from Alumno a join Grupo_Alumno ga join
    Profesor_Materia pm on a.matricula = ga.matricula AND ga.grado = pm.grado WHERE pm.codigoProfesor = 
    '".$_SESSION['nombreUsu']."' AND pm.profesorEje = 1");

    $query->execute();
    $resultado = $query->fetchAll();
    foreach ($resultado as $key => $value) {
      $alumInfoEje[$key] = array(
      $value['matricula'],
      $value['nombres'],
      $value['apellidos']
      );
    }
    return $alumInfoEje;
  }

public function grupos(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT DISTINCT ga.grado FROM Grupo_Alumno ga INNER JOIN Profesor_Materia pm 
    INNER JOIN Profesor p ON ga.grado = pm.grado AND pm.codigoProfesor = p.codigoProfesor WHERE p.codigoProfesor = 
    '".$_SESSION['nombreUsu']."'; ");

    $query->execute();
    $resultado = $query->fetchAll();
    $cont = 0;
    $lista = [];
    foreach ($resultado as $value) {
      $cont++;
      $lista[$cont]=$value['grado'];
    }

    return  $lista;
  }

  public function alumnosInfo($grado){
    $pdo = new Conexion();
    $query = $pdo->prepare("SELECT a.matricula,a.nombres,a.apellidos,pc.calificacionFinal FROM Alumno a JOIN
    Alumno_Proyecto ap JOIN Grupo_Alumno ga JOIN Fecha_Proyecto fp JOIN Proyecto_Calificacion pc ON ga.grado = fp.grado
    AND a.matricula = ga.matricula AND ap.matricula = a.matricula AND ap.IdProyecto = pc.IdProyecto 
    WHERE ga.grado = '".$grado."';");
   
    $query->execute();
    $resultado = $query->fetchAll();
    foreach ($resultado as $key => $value) {

      $alumInfo[$key] = array(
      $value['matricula'],
      $value['nombres'],
      $value['apellidos'],
      $value['calificacionFinal']
      );
    }

    if ($resultado == null) {

      $vacio = array(
        "nombresProfesor"=>"vacio",
        "apellidosProfesor"=>"vacio",
        "puntualidad"=>"vacio",
        "presentacionPersonal"=>"vacio",
        "expresionOral"=>"vacio",
        "organizacionEquipo"=>"vacio",
        "apoyosVisuales"=>"vacio",
        "contenidoTematico"=>"vacio",
        "dominioTema"=>"vacio",
        "recomendaciones"=>"vacio");

      return $vacio;

    }else{

    return $alumInfo;
  }
}

  public function fechas(){
    $pdo = new Conexion();
    $query = $pdo->prepare("SELECT grado,fecha,auditorio FROM Fecha_Proyecto");
    $query->execute();
    $resultado = $query->fetchAll();
    foreach ($resultado as $key => $value) {

      $fechas[$key] = array(
      $value['grado'],
      $value['fecha'],
      $value['auditorio']
      );
    }

    return $fechas;
  }


  public function equiposEvaluar(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT pm.grado FROM Profesor_Materia pm JOIN Profesor p ON 
    p.codigoProfesor = pm.codigoProfesor WHERE p.codigoProfesor ='".$_SESSION['nombreUsu']."'
    AND pm.profesorEje = 1;");

    $query->execute();
    $resultado = $query->fetchAll();
    $lista = array();
    $var = [];
    $cont = 0;
    $uno = '<a href="#subE" class="list-group-item list-group-item-action bg-light" data-toggle="collapse" aria-expanded="false">
      <i class="fas fa-tasks"></i>  Evaluación Final</a>';
    foreach ($resultado as $value ) {
      $cont++;
      $var[$cont] =$this->nombreDeEquipo($value['grado']);
      $this->setGrado($value['grado']);

        $dos = '<div class="collapse" id="subE">'.$var[$cont].'</div>';
        array_push($lista,$uno,$dos);
      }

      $cad = implode($lista);
      return $cad;
  }

  public function nombreDeEquipo($grado){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT DISTINCT p.IdProyecto,p.numEquipo,p.nombreEquipo,p.problematica FROM
    Proyecto p INNER JOIN Alumno_Proyecto ap INNER JOIN Grupo_Alumno ga ON ga.matricula = ap.matricula AND
     p.IdProyecto = ap.IdProyecto WHERE ga.grado = '".$grado."' ");
    
    $query->execute();
    $resultado = $query->fetchAll();
    $lista = array();
    $iniC = "'";
    $finC ="'";
    
    $cont = 0;
    foreach ($resultado as $value) {
      $cont++;
      $dos= '<a onclick="crear(\'evaluar'.$cont.'\');" id="evaluar'.$cont.'" 
      class="list-group-item list-group-item-action bg-light"><i class="fas fa-sort-numeric-up"></i>
      '.$value['nombreEquipo'].'</a>';
      array_push($lista,$dos);
      $this->setContEva($cont);

    }
    $cad = implode($lista);

    return $cad;
  }

  public function califProfesores(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT DISTINCT p.IdProyecto,p.numEquipo,p.nombreEquipo,p.problematica FROM
    Proyecto p INNER JOIN Alumno_Proyecto ap INNER JOIN Grupo_Alumno ga INNER JOIN Profesor_Materia pm ON
    ga.matricula = ap.matricula AND p.IdProyecto = ap.IdProyecto AND ga.grado = pm.grado WHERE 
    pm.codigoProfesor = '".$_SESSION['nombreUsu']."' AND pm.profesorEje = 1 ");

    $query->execute();
    $resultado = $query->fetchAll();
    $cont=0;
    $lista = [];
    foreach ($resultado as $value) {
      $cont++;
      $lista[$cont]=$value['IdProyecto'];

    }

    return  $lista;
  }

  public function consultaCalificaciones($proyecto){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT p.nombresProfesor,p.apellidosProfesor,c.puntualidad,c.presentacionPersonal,
    c.expresionOral,c.organizacionEquipo,c.apoyosVisuales,c.contenidoTematico,c.dominioTema,c.recomendaciones FROM
    Calificacion c INNER JOIN Profesor p ON c.codigoProfesor = p.codigoProfesor WHERE c.IdProyecto = '".$proyecto."' ");

    $query->execute();
    $resultado = $query->fetchAll();
    foreach ($resultado as $key => $value) {
      $evaInfo[$key] = array(
      $value['nombresProfesor'],
      $value['apellidosProfesor'],
      $value['puntualidad'],
      $value['presentacionPersonal'],
      $value['expresionOral'],
      $value['organizacionEquipo'],
      $value['apoyosVisuales'],
      $value['contenidoTematico'],
      $value['dominioTema'],
      $value['recomendaciones']
      );
    }

    if ($resultado == null) {
      $vacio = array(
        "nombresProfesor"=>"vacio",
        "apellidosProfesor"=>"vacio",
        "puntualidad"=>"vacio",
        "presentacionPersonal"=>"vacio",
        "expresionOral"=>"vacio",
        "organizacionEquipo"=>"vacio",
        "apoyosVisuales"=>"vacio",
        "contenidoTematico"=>"vacio",
        "dominioTema"=>"vacio",
        "recomendaciones"=>"vacio");

      return $vacio;

    }else{

    return $evaInfo;
  }

  }

}//fin de la clase

?>
