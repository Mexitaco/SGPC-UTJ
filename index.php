<?php
include 'loginSecurity.php';
include 'Modelo/Alumno.php';
include_once 'Modelo/Profesor.php';

$alumno = new Alumno();

?>
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <title>Menú</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="font-awesome/css/all.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/misEstilos.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="css/buttons.bootstrap4.css">
  <link rel="stylesheet" href="css/select.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.dataTables.css"/>
  <link href="img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
</head>
<body>

  <!-- 
    Modal para el cambio de contraseña
  -->
  <div class="modal" tabindex="-1" role="dialog" id="modal_pass">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cambio de contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
          <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label class="form-control-label">Usuario:</label>
                  <input class="form-control" placeholder="Nombre de Usuario" id="userName">
                </div>
              </div>
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label class="form-control-label">Nueva Contraseña:</label>
                  <input class="form-control" placeholder="Ingrese contraseña nueva" id="passNew">
                </div>
              </div>
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label class="form-control-label">Repetir Contraseña:</label>
                  <input class="form-control" placeholder="Repita contraseña nueva" id="passRep">
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="guardarPass()">Guardar</button>
        </div>
      </div>
    </div>
  </div>

<!--
  Creación y validación para el menú lateral de los distintos tipos de usuario
-->

<?php

  include 'Vista/Navegador.php';
  $nav = new Navegador();

  if ($_SESSION['admin']=='1') {
    $nav->navAdmin();

  }

  if ($_SESSION['alum'] == '1') {
    $profesor = new Profesor();
    $nav->navAlumnos();
  }

  if ($_SESSION['tipoUsuario'] == 'ProfesorEje') {
    $profesor = new Profesor();
    $nav->navProfEje($profesor);
    $contGrupo = $profesor->getCont();
    $contEquipos = $profesor->getContEquipos();
    $contFin =$profesor->getContEva();
  }

  if ($_SESSION['tipoUsuario'] == 'Profesor') {
    $profesor = new Profesor();
    $cont2 = 0;
    $nav->navProf($profesor);
    $contGrupo = $profesor->getCont();
    $contEquipos = $profesor->getContEquipos();
  }

?>

</body>
<script src=" js/jquery-3.3.1.js" ></script>
<script src="js/bootstrap.min.js" ></script>
<script src="js/jquery.dataTables.js" ></script>
<script src="js/dataTables.bootstrap4.js" ></script>
<script type="text/javascript" src="js/dataTables.responsive.js"></script>
<script src="js/dataTables.buttons.js" ></script>
<script src="js/buttons.bootstrap4.js" ></script>
<script type="text/javascript" src="js/buttons.html5.js"></script>
<script type="text/javascript" src="js/vfs_fonts.js"></script>
<script type="text/javascript" src="js/buttons.print.js"></script>
<script src="js/pdfmake.js" ></script>
<script src="js/jszip.js" ></script>
<script src="js/popper.min.js" ></script>

<!--
  Esta función sirve para activar el menú lateral desplegable
-->

<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>

<!--
  Este método sirve para crear los input para los distintos tipos de integrantes que
  pueda haber
-->

<script type="text/javascript">
  a = 0;
  function reiniciar(number) {
    var num = number;
    a = num;
  }

  function addCancion(){
    a++;
    if (a < 6) {
      var div = document.createElement('div');
      div.setAttribute('class', 'form-group row"');
      div.innerHTML = '<div style="clear:both" class="cancion_'+a+' col-md-8 my-2"><label for="integrante'
      +a+'" class="col-md-4 my-2 col-form-label">Integrante '+a+'</label><select  name="integrante'+a+
      '" id="integrante'+a+'" class="form-control"><?php  echo $alumno->alumnosGrupo();?></select></div>';
      document.getElementById('inte').appendChild(div);
    }
  }
</script>

<!--
  Este método funciona para cargar los datables según el tipo de usuario y sus permisos
-->

<script type="text/javascript">
  function crear(contenido) {

    <?php include 'Vista/Tabla.php'; include 'Vista/Formulario.php';
    $alumno->fechaG();
    $idf = $alumno->getFechaGrupo();
    ?>

    var crearCon = contenido;
    var con = document.getElementById("contenido");
    if (crearCon == 'integrantes') {
      var fot= '<?php  $form = new Formulario(); $form->equipoAlta($idf); ?>';
      var resultado = con.innerHTML = fot;
    }

    <?php
      if ($_SESSION['tipoUsuario'] == 'ProfesorEje') {
    ?>

      if (crearCon == 'eje') {
        var eje= '<?php  $tabla = new Tabla(); $tabla->alumnosEje(); ?>';
        var resultado = con.innerHTML=eje;
        var arregloDT = <?php echo json_encode($profesor->alumnosInfoEje()); ?>;
        $(document).ready(function(){
          var t = 'Alumnos';
          $('#eje').DataTable( {
            language: {
              "decimal": "",
              "emptyTable": "No hay información",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
              "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
              "infoFiltered": "(Filtrado de _MAX_ total entradas)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ Entradas",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscar:",
              "zeroRecords": "Sin resultados",
              "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
              }},
              "data": arregloDT,
              "order": [[ 0, "asc" ]],
              responsive: true,
              dom: '<"col-12">lBfrtip',
              buttons:[
              {
                extend: 'print',
                title: t
              },

              {
                extend: 'pdf',
                title: t
              },

              {
                extend: 'excel',
                title: t
              }
              ]
            });
          });
        }

      <?php
      $cont = 0;
      $cad = $profesor->grupos();
        for ($i=0; $i < $contGrupo; $i++) {
          $cont++;
      ?>
        if (crearCon == <?php echo $cont; ?>){
          var profe= '<?php   $tabla = new Tabla(); $tabla->alumnos($cont); ?>';
          var resultado = con.innerHTML=profe;
          var arregloDT<?php echo $cont; ?> = <?php  echo json_encode($profesor->alumnosInfo($cad[$cont])); ?>;
          $(document).ready(function(){
            var t = 'AlumnoSSs';
            $('#<?php echo 'tb'.$cont; ?>').DataTable( {
              language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados",
                "paginate": {
                  "first": "Primero",
                  "last": "Último",
                  "next": "Siguiente",
                  "previous": "Anterior"
                }},
                "data": arregloDT<?php echo $cont; ?>,
                "order": [[ 0, "asc" ]],
                responsive: true,
                dom: '<"col-12">lBfrtip',
                buttons:[
                {
                  extend: 'print',
                  title: t
                },

                {
                  extend: 'pdf',
                  title: t
                },

                {
                  extend: 'excel',
                  title: t
                }
                ]
              });
            });
          }

<?php }//fin for datatables de eje ?>

<?php
$contG = 0;
for ($i = 0; $i <= $contEquipos ; $i++) {
  $contG++;
?>

if (crearCon == 'equipo<?php echo $contG; ?>') {
  var titulo<?php echo $contG; ?> = document.getElementById('equipo<?php echo $contG; ?>').innerHTML;
  var formEquipo = '<div class="page-header"><h3 style="text-align: center"><p>'+titulo<?php echo $contG; ?>
  +'</p></h3></div><?php  $form2 = new Formulario(); $form2->calificacionDeEquipo($contG); ?>'
  +idEquipo<?php echo $contG; ?>+'</form>';
  var resultado = con.innerHTML = formEquipo;
}

<?php }//fin del contador de equipos ?>

if (crearCon == 'fechas') {
  var fecha = '<?php   $tabla = new Tabla(); $tabla->fechas(); ?>';
  var resultado = con.innerHTML = fecha;
  var arregloDTFecha = <?php  echo json_encode($profesor->fechas()); ?>;
  $(document).ready(function(){
    var t = 'Fechas';
    $('#fecha').DataTable( {
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        }},
        "data": arregloDTFecha,
        "order": [[ 0, "asc" ]],
        responsive: true,
        dom: '<"col-12">lBfrtip',
        buttons:[
        {
          extend: 'print',
          title: t
        },

        {
          extend: 'pdf',
          title: t
        },

        {
          extend: 'excel',
          title: t
        }
        ]
      });
    });
}

<?php

  $contEvaFin = 0;
  $prof = $profesor->califProfesores();
  for ($j=1; $j <= $contFin ; $j++) {
    $contEvaFin++;

 ?>

 if (crearCon == 'evaluar<?php echo $contEvaFin; ?>') {
   var evaT = '<?php   $tabla = new Tabla(); $tabla->eva($contEvaFin,$prof[$contEvaFin]); ?>';
   var resultado = con.innerHTML = evaT;
   var evaFin<?php echo $contEvaFin; ?>= <?php  
   echo json_encode($profesor->consultaCalificaciones($prof[$contEvaFin])); ?>;
   $(document).ready(function(){
     var t = 'eva<?php echo $contEvaFin; ?>';
     $('#eva<?php echo $contEvaFin; ?>').DataTable( {
       language: {
         "decimal": "",
         "emptyTable": "No hay información",
         "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
         "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
         "infoFiltered": "(Filtrado de _MAX_ total entradas)",
         "infoPostFix": "",
         "thousands": ",",
         "lengthMenu": "Mostrar _MENU_ Entradas",
         "loadingRecords": "Cargando...",
         "processing": "Procesando...",
         "search": "Buscar:",
         "zeroRecords": "Sin resultados",
         "paginate": {
           "first": "Primero",
           "last": "Último",
           "next": "Siguiente",
           "previous": "Anterior"
         }},
         "data": evaFin<?php echo $contEvaFin; ?>,
         "order": [[ 0, "asc" ]],
         responsive: true,
         dom: '<"col-12">lBfrtip',
         buttons:[
         {
           extend: 'print',
           title: t
         },

         {
           extend: 'pdf',
           title: t
         },

         {
           extend: 'excel',
           title: t
         }
         ]
       });
     });
 }

 <?php
}//fin del contador de evalución final
  ?>

<?php }//fin permisos de eje

  if ($_SESSION['tipoUsuario']=='Profesor') {

?>

<?php
$cont = 0;
$cad = $profesor->grupos();
  for ($i = 0; $i < $contGrupo; $i++) {
    $cont++;
  ?>
        if (crearCon == <?php echo $cont; ?>){
          var profe = '<?php   $tabla = new Tabla(); $tabla->alumnos($cont); ?>';
          var resultado = con.innerHTML = profe;
          var arregloDT<?php echo $cont; ?> = <?php  echo json_encode($profesor->alumnosInfo($cad[$cont])); ?>;
          $(document).ready(function(){
            var t = 'AlumnoSSs';
            $('#<?php echo 'tb'.$cont; ?>').DataTable( {
              language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados",
                "paginate": {
                  "first": "Primero",
                  "last": "Último",
                  "next": "Siguiente",
                  "previous": "Anterior"
                }},
                "data": arregloDT<?php echo $cont; ?>,
                "order": [[ 0, "asc" ]],
                responsive: true,
                dom: '<"col-12">lBfrtip',
                buttons:[
                {
                  extend: 'print',
                  title: t
                },

                {
                  extend: 'pdf',
                  title: t
                },

                {
                  extend: 'excel',
                  title: t
                }
                ]
              });
            });
          }

      <?php }//fin datatables profesor ?>

<?php

$contG = 0;
for ($i = 0; $i <= $contEquipos ; $i++) {
  $contG++;
?>

if (crearCon == 'equipo<?php echo $contG; ?>') {
  var titulo<?php echo $contG; ?> = document.getElementById('equipo
  <?php echo $contG; ?>').innerHTML;
  var formEquipo = '<div class="page-header"><h3 style="text-align: center"><p>'+titulo
  <?php echo $contG; ?>+'</p></h3></div><?php  $form2 = new Formulario(); 
  $form2->calificacionDeEquipo($contG); ?>'+idEquipo
  <?php echo $contG; ?>+'</form>';
  var resultado = con.innerHTML=formEquipo;
}

<?php }//fin del contador de equipos ?>

if (crearCon == 'fechas') {
  var fecha = '<?php   $tabla = new Tabla(); $tabla->fechas(); ?>';
  var resultado = con.innerHTML = fecha;
  var arregloDTFecha = <?php  echo json_encode($profesor->fechas()); ?>;
  $(document).ready(function(){
    var t = 'Fechas';
    $('#fecha').DataTable( {
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        }},
        "data": arregloDTFecha,
        "order": [[ 0, "asc" ]],
        responsive: true,
        dom: '<"col-12">lBfrtip',
        buttons:[
        {
          extend: 'print',
          title: t
        },

        {
          extend: 'pdf',
          title: t
        },

        {
          extend: 'excel',
          title: t
        }
        ]
      });
    });
}

<?php }//fin permisos de profesor ?>

<?php if ($_SESSION['alum'] == "1") {?>

  if (crearCon == 'fechas') {
    var fecha = '<?php   $tabla = new Tabla(); $tabla->fechas(); ?>';
    var resultado = con.innerHTML = fecha;
    var arregloDTFecha = <?php  echo json_encode($profesor->fechas()); ?>;
    $(document).ready(function(){
      var t = 'Fechas';
      $('#fecha').DataTable( {
        language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados",
          "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
          }},
          "data": arregloDTFecha,
          "order": [[ 0, "asc" ]],
          responsive: true,
          dom: '<"col-12">lBfrtip',
          buttons:[
          {
            extend: 'print',
            title: t
          },

          {
            extend: 'pdf',
            title: t
          },

          {
            extend: 'excel',
            title: t
          }
          ]
        });
      });
  }

  if (crearCon == 'calAlumno') {
    var calA = '<?php   $tabla = new Tabla(); $tabla->califAlumno(); ?>';
    var resultado = con.innerHTML=calA;
    var arregloDTCal= <?php  echo json_encode($alumno->alumnoCalificacion()); ?>;
    $(document).ready(function(){
      var t = 'cal';
      $('#cal').DataTable( {
        language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados",
          "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
          }},
          "data": arregloDTCal,
          "order": [[ 0, "asc" ]],
          responsive: true,
          dom: '<"col-12">lBfrtip',
          buttons:[
          {
            extend: 'print',
            title: t
          },

          {
            extend: 'pdf',
            title: t
          },

          {
            extend: 'excel',
            title: t
          }
          ]
        });
      });
  }

<?php } ?>
        return resultado;
      }

    </script>
    
    <script>
    function abrirModalPass(){
      limpiarModalPass();
      $("#modal_pass").modal({backdrop:"static"});
    }

    function limpiarModalPass(){
      $("#passNew").val("");
      $("#passRep").val("");
      $("#userName").val("")
    }

    function guardarPass(){
      var NewPass = $("#passNew").val();
      var RepPass = $("#passRep").val();
      var UserName = $("#userName").val();
      var accion = "actualiza";

      if(NewPass != RepPass){

        Swal.fire(
          'Error!',
          'Las contraseñas no coinciden.',
          'error'
        )

      }else{
        Swal.fire({
          title: 'Modificar?',
          text: "Esta seguro de modificar su contraseña!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Aceptar'
        }).then((result) => {
          if (result.value) {

            var objForm = new FormData();
            objForm.append("accion", accion);
            objForm.append("NewPass", NewPass);
            objForm.append("RepPass", RepPass);
            objForm.append("UserName", UserName);

            $.ajax({
              method: "POST",
              contentType: false,
              data: objForm,
              processData: false,
              cache: false,
              url: "Modelo/CambiarPass.php",
              success: function(resp) {
                console.log(resp);

                r = JSON.parse(resp);
                var respuesta = r.obj;
                console.log(respuesta);

                if (respuesta.status_busqueda == true) {

                  if (respuesta.status_actualizacion == true) {

                    Swal.fire(
                    'Modificado!',
                    'Su contraseña se ha modificado.',
                    'success'
                    )
                    $("#modal_pass").modal("hide");

                  }else{

                    Swal.fire(
                    'Modificado!',
                    respuesta.msj_actualizacion,
                    'success'
                    )

                  }

                } else {
                  Swal.fire(
                  'Error!',
                  respuesta.msj_busqueda,
                  'error'
                  )
                } //fin else swal

              } //fin success
            }); //fi
          }else{
            Swal.fire(
            'Cancelado!',
            'No se realizó ninguna modificación.',
            'error'
            )

          }

        })
      }
    }
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</html>
