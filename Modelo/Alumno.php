<?php

  include_once 'Conexion.php';

  class Alumno{

    private $matricula;
    private $nombres;
    private $apellidos;
    private $statusAlumno;
    private $fechaGrupo;
    private $numEquipo;
    private $problematica;
    private $hora;
    private $nombreEquipo;
    private $fechaProyecto;

    public function getNombreEquipo(){
      return $this->nombreEquipo;
    }

    public function setNombreEquipo($nombreEquipo){
      $this->nombreEquipo = $nombreEquipo;
    }

    public function getNumEquipo(){
		  return $this->numEquipo;
  	}

  	public function setNumEquipo($numEquipo){
  		$this->numEquipo = $numEquipo;
  	}

  	public function getProblematica(){
  		return $this->problematica;
  	}

  	public function setProblematica($problematica){
  		$this->problematica = $problematica;
  	}

    public function getFechaGrupo(){
      return $this->fechaGrupo;
    }

    public function setFechaGrupo($fechaGrupo){
      $this->fechaGrupo = $fechaGrupo;
    }

    public function getFechaProyecto(){
      return $this->fechaProyecto;
    }

    public function setFechaProyecto($fechaProyecto){
      $this->fechaProyecto = $fechaProyecto;
    }

  	public function getHora(){
  		return $this->hora;
  	}

  	public function setHora($hora){
  		$this->hora = $hora;
  	}

    public function getMatricula(){
  		return $this->matricula;
  	}

  	public function setMatricula($matricula){
  		$this->matricula = $matricula;
  	}

  	public function getNombres(){
  		return $this->nombres;
  	}

  	public function setNombres($nombres){
  		$this->nombres = $nombres;
  	}

  	public function getApellidos(){
  		return $this->apellidos;
  	}

  	public function setApellidos($apellidos){
  		$this->apellidos = $apellidos;
  	}

  	public function getStatusAlumno(){
  		return $this->statusAlumno;
  	}

  	public function setStatusAlumno($statusAlumno){
  		$this->statusAlumno = $statusAlumno;
  	}


  /**
   * Este método sirve para visualizar los nombres de los alumnos por grupo, para
   * poder visualizarlos en un input y crear un nuevo equipo
   */

  public function alumnosGrupo(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT DISTINCT a.matricula,a.nombres,a.apellidos FROM
      Grupo_Alumno ga INNER JOIN Alumno a INNER JOIN Profesor_Materia pm INNER JOIN
      Alumno_Proyecto ap ON ga.matricula = a.matricula AND ga.grado = pm.grado WHERE
      Not a.matricula In (Select matricula From Alumno_Proyecto ap) 
      AND pm.codigoProfesor = '".$_SESSION['nombreUsu']."'  AND pm.profesorEje = 1 ");

    $query->execute();
    $resultado = $query->fetchAll();

    if ($resultado == null) {
      $query2 = $pdo->prepare("SELECT DISTINCT a.matricula,a.nombres,a.apellidos FROM
      Alumno a INNER JOIN Profesor_Materia pm INNER JOIN Grupo_Alumno ga ON 
      ga.grado = pm.grado AND ga.matricula = a.matricula WHERE pm.codigoProfesor =
      '".$_SESSION['nombreUsu']."' AND pm.profesorEje = 1");

      $query2->execute();
      $resultado = $query2->fetchAll();
    }

    $cont = 0;
    echo '<option selected>Sin seleccionar...</option>';
    foreach ($resultado as $row) {
      $cont++;
      $this->setMatricula($row['matricula']);
      $this->setNombres($row['nombres']);
      $this->setApellidos($row['apellidos']);
      echo '<option id="alumno'.$cont.'" value="'.$this->getMatricula().'">
      '.$this->getNombres().' '.$this->getApellidos().'</option>';
    }
  }

/**
 * Este método sirve para obtener la fecha de exposición de un grupo
 *  y asignarla a un nuevo equipo de proyecto
 */

  public function fechaG(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT DISTINCT fp.IdFecha,fp.fecha,fp.grado FROM Fecha_Proyecto fp
    INNER JOIN Grupo_Alumno ga INNER JOIN Profesor_Materia pm INNER JOIN Profesor p ON
    fp.grado=ga.grado AND pm.codigoProfesor = p.codigoProfesor AND ga.grado = pm.grado 
    WHERE pm.codigoProfesor = '".$_SESSION['nombreUsu']."' and pm.profesorEje = 1");

    $query->execute();
    $resultado = $query->fetchAll();
    foreach ($resultado as $row) {
      $this->setFechaGrupo($row['IdFecha']);
    }
  }


  public function crearProyecto(){
    try{
      $pdo = new Conexion();
      $query = $pdo->prepare("INSERT INTO Proyecto VALUES(null,".$this->getNumEquipo().",
      '".$this->getNombreEquipo()."','".$this->getProblematica()."');");
      $query->execute();
    }catch(PDOException $e){
      echo $query . "<br>" . $e->getMessage();
    }
     $pdo = null;
  }

  public function asignarProyecto($mat){
    try{
      $pdo = new Conexion();
      
      $query = $pdo->prepare("INSERT INTO Alumno_Proyecto VALUES(
      ".$mat.",(select IdProyecto from Proyecto order by IdProyecto desc limit 1),
      '".$this->getFechaProyecto()."','".$this->getHora()."');");

      $query->execute();
  }catch(PDOException $e){
         echo $query . "<br>" . $e->getMessage();
     }

     $pdo = null;

  }

  public function alumnoCalificacion(){
    $pdo = new Conexion();

    $query = $pdo->prepare("SELECT DISTINCT a.nombres,a.apellidos,pr.numEquipo,pr.nombreEquipo,
    pr.problematica,pc.calificacionFinal FROM Alumno a JOIN Alumno_Proyecto ap JOIN 
    Proyecto_Calificacion pc JOIN Proyecto pr ON ap.IdProyecto = pr.IdProyecto AND
    ap.IdProyecto=pc.IdProyecto WHERE a.matricula = '".$_SESSION['nombreUsu']."' ");

    $query->execute();
    $resultado=$query->fetchAll();

    foreach ($resultado as $key => $value) {
      $calAlumno[$key]=array(
        $value['nombres'],
        $value['apellidos'],
        $value['numEquipo'],
        $value['nombreEquipo'],
        $value['problematica'],
        $value['calificacionFinal']
        );
    }
    return $calAlumno;

  }

}
?>
