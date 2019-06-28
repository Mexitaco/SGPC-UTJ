<?php

include_once 'Conexion.php';

class Calificacion{

    private $clave;
    private $nombreProyecto;
    private $codigoProfesor;
    private $puntu;
    private $prePer;
    private $expOral;
    private $orgEquipo;
    private $apVisual;
    private $conTema;
    private $domTem;
    private $recomed;
    private $calificacion;
    private $idProyecto;
    private $grado;

    public function getGrado(){
    return $this->grado;
    }

    public function setGrado($grado){
    $this->grado = $grado;
    }

    public function getIdProyecto(){
    return $this->idProyecto;
    }

    public function setIdProyecto($idProyecto){
    $this->idProyecto = $idProyecto;
    }

    public function getCodigoProfesor(){
    return $this->codigoProfesor;
    }

    public function setCodigoProfesor($codigoProfesor){
    $this->codigoProfesor = $codigoProfesor;
    }

  	public function getPuntu(){
  		return $this->puntu;
  	}

  	public function setPuntu($puntu){
  		$this->puntu = $puntu;
  	}

  	public function getPrePer(){
  		return $this->prePer;
  	}

  	public function setPrePer($prePer){
  		$this->prePer = $prePer;
  	}

  	public function getExpOral(){
  		return $this->expOral;
  	}

  	public function setExpOral($expOral){
  		$this->expOral = $expOral;
  	}

  	public function getOrgEquipo(){
  		return $this->orgEquipo;
  	}

  	public function setOrgEquipo($orgEquipo){
  		$this->orgEquipo = $orgEquipo;
  	}

  	public function getApVisual(){
  		return $this->apVisual;
  	}

  	public function setApVisual($apVisual){
  		$this->apVisual = $apVisual;
  	}

  	public function getConTema(){
  		return $this->conTema;
  	}

  	public function setConTema($conTema){
  		$this->conTema = $conTema;
  	}

  	public function getDomTem(){
  		return $this->domTem;
  	}

  	public function setDomTem($domTem){
  		$this->domTem = $domTem;
  	}

  	public function getRecomed(){
  		return $this->recomed;
  	}

  	public function setRecomed($recomed){
  		$this->recomed = $recomed;
  	}

  	public function getCalificacion(){
  		return $this->calificacion;
  	}

  	public function setCalificacion($calificacion){
  		$this->calificacion = $calificacion;
  	}

  public function altaEvaluacionProfesor(){
    try{
      $pdo = new Conexion();
      $query = $pdo->prepare("INSERT INTO Calificacion VALUES(
        '".$this->getCodigoProfesor()."',
        '".$this->getIdProyecto()."',
        '".$this->getPuntu()."',
        '".$this->getPrePer()."',
        '".$this->getExpOral()."',
        '".$this->getOrgEquipo()."',
        '".$this->getApVisual()."',
        '".$this->getConTema()."',
        '".$this->getDomTem()."','".$this->getRecomed()."');");

    $query->execute();
  }catch(PDOException $e){
        echo $query . "<br>" . $e->getMessage();
    }
    $pdo = null;

  }

  public function evaluacionFinal(){
    try{
    $pdo = new Conexion();

    $query = $pdo->prepare("INSERT INTO Proyecto_Calificacion VALUES(
      (SELECT SUM(e.puntualidad +
        e.presentacionPersonal +
        e.expresionOral +
        e.organizacionEquipo +
        e.apoyosVisuales +
        e.contenidoTematico +
        e.dominioTema) / 7 / COUNT(e.IdProyecto) 
        FROM Calificacion e WHERE e.IdProyecto = '".$this->getIdProyecto()."'),
        '".$this->getIdProyecto()."');");

    $query->execute();
  }catch(PDOException $e){
        echo $query . "<br>" . $e->getMessage();
    }
    $pdo = null;
  }

} //fin de la clase

?>
