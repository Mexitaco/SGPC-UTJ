<?php

$respuesta = array();

  if (isset($_POST['accion'])) {


    $accion = $_POST['accion'];

    switch ($accion) {


        case 'actualiza' :

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "SGPC";

        $pass = $_POST['NewPass'];
        $usuario = $_POST['UserName'];


        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM Usuario WHERE nombreUsuario='$usuario'";

        $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {

                     $respuesta['obj']['status_busqueda']= TRUE;
                     $respuesta['obj']['msj_busqueda']= "usuario_correcto";

                            $sql = "UPDATE Usuario SET password='$pass' WHERE nombreUsuario='$usuario'";

                            if ($conn->query($sql) === TRUE) {
                                $respuesta['obj']['status_actualizacion']= TRUE;
                                $respuesta['obj']['msjmsj_actualizacion']= "Actualizado";
                            } else {
                                $respuesta['obj']['status_actualizacion']= FALSE;
                                $respuesta['obj']['msj_actualizacion'] = " al actualizar: " . $conn->error;
                            }

                } else {
                   $respuesta['obj']['status_busqueda']= FALSE;
                    $respuesta['obj']['msj_busqueda']= " usuario no se encontro en la base de datos: " . $conn->error;
                }

        $conn->close();

        break;

  }
  echo json_encode($respuesta);
}



?>
