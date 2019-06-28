<?php
include_once 'Modelo/Conexion.php';
$pdo = new Conexion();
session_start();

/* Variables que pasamos del formulario de inicio
*/

if (isset($_POST['nombreUsuario']) || isset($_POST['password'])) {
  $usuario = $_POST['nombreUsuario'];
  $password = $_POST['password'];

}

//Conexion a base de datos
if($usuario == '' || $password == '') {
    header('location: inicio.php');
}else {
    try{
        $query=$pdo->prepare("SELECT DISTINCT "."u.*,p.statusProfesor,a.statusAlumno
        FROM Usuario u JOIN Alumno a JOIN Profesor p WHERE u.IdUsuario IN (SELECT DISTINCT 
        a.IdUsuario FROM Alumno WHERE a.statusAlumno <> 0) AND u.nombreUsuario = '".$usuario."'
        and u.password = '".$password."' OR u.IdUsuario IN (SELECT DISTINCT p.IdUsuario FROM
        Profesor WHERE p.statusProfesor <> 'Baja' AND p.statusProfesor = 'Profesor' OR
        p.statusProfesor = 'ProfesoEjeAuxiliar' OR p.statusProfesor = 'ProfesorEje')
        and u.nombreUsuario = '".$usuario."' and u.password = '".$password."' AND 
        u.nombreUsuario = p.codigoProfesor OR u.administrador = 1 AND u.nombreUsuario = 
        '".$usuario."' and u.password = '".$password."';");

        $query->execute();
        $resultado = $query->fetchAll();

        //Validacion y comparacion del usuario y contraseña

        foreach($resultado as $value){

            $BDpassword = $value['password'];
            $BDusuario = $value['nombreUsuario'];
            $admin = $value['administrador'];
            $privilegio = $value['statusProfesor'];
            $esalumno = $value['statusAlumno'];
            $clave = $value['nombreUsuario'];
            if ($esalumno == '1') {
              $privilegio = null;
            }

        }
        if($usuario==$BDusuario && $password==$BDpassword){
            $_SESSION['valido'] = 1;
            $_SESSION['admin'] = $admin;
            $_SESSION['nombreUsu'] = $clave;
            $_SESSION['tipoUsuario'] = $privilegio;
            $_SESSION['alum'] = $esalumno;

            header('Location: index.php');
        }else{
            echo '<script>alert("El usuario o contraseña son incorrectos. 
            Intente de nuevo.")</script>';
            echo '<script>location.href="inicio.php"</script>';
        }

    }catch(PDOException $ex){
        echo 'Error: '.$ex->getMessage();
    }
    
    $pdo = null;

}//cierre del else

?>