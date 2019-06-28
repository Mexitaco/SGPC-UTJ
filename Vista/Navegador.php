<?php

class Navegador{

  public function navAdmin(){
    echo '<div class="d-flex" id="wrapper">
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading"><img src="UTJ/../img/utj-menu.png"  width="200px" class="">
        </div>
        <div class="list-group list-group-flush">
          <div  class="list-group panel">
            <a href="#menu1" class="list-group-item list-group-item-action bg-utj text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fas fa-chalkboard-teacher"></i> <span class="hidden-sm-down">  Profesor Eje</span> </a>
            <div class="collapse" id="menu1">
              <a href="#" onclick="crear('."'fechas'".');" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fa fa-calendar-check"></i>   Fechas</a>
            </div>
          </div>
          <div  class="list-group panel">
            <a href="#menu2" class="list-group-item list-group-item-action bg-secondary text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fas fa-users"></i></i><span class="hidden-sm-down">  Grupos y Calificaciones</span> </a>
            <div class="collapse" id="menu2">
            </div>
          </div>
          <div  class="list-group panel">
            <a href="#menu3" class="list-group-item list-group-item-action bg-primary text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-check-circle"></i> <span class="hidden-sm-down">  Calificar</span> </a>
            <div class="collapse" id="menu3">
            </div>
          </div>
          <div  class="list-group panel">
           <a href="#menu4" class="list-group-item list-group-item-action bg-info text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fas fa-cog"></i> <span class="hidden-sm-down">   Configuración</span> </a>
           <div class="collapse" id="menu4">
           <a href="#"  onclick="abrirModalPass();" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fas fa-key"></i>  Cambiar Contraseña</a>
           </div>
         </div>
        </div>
      </div>
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
          <div class="">
            <span id="menu-toggle" class="navbar-toggler-icon"></span>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item active">
                <a class="nav-link" target="_blank" href="http://agora.utj.edu.mx/Account/Login">Ágora<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" target="_blank" href="http://www.utj.edu.mx/">UTJ</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link"  href="loginCerrar.php">Cerrar Sesión</a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="container-fluid">
          <h4 class="mt-4"><strong>Bienvenido a SGPC (Sistema Gestor de Proyectos Cuatrimestrales)</strong></h4>
          <p class="h5 text-justify pl-2 pr-2 pb-2 mb-4">Este sistema le permitirá dar de alta a equipos de proyecto, consultar fechas de proyecto, evaluar proyectos, consultar a los alumnos de su grupo eje, calificaciones de proyecto y calificar equipos de proyectos.
          </br>
          Además de exportar la información en pdf u excel si es necesario.
          </p>
            <div id="contenido" class="container">
            </div>
          </div>
        </div>
        <!-- /#page-content-wrapper -->
      </div>';

}

/*<a href="#" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fa fa-calendar-plus"></i>   Nuevo</a>
<a href="#" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fa fa-calendar-check"></i>  Actualizar</a>*/

public function navProfEje($profesor){
//<a href="#" onclick="crear('."'evaluar'".');" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fa fa-minus-circle"></i>  Evaluar</a>

  echo '<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><img src="UTJ/../img/utj-menu.png"  width="200px" class="">
      </div>
      <div class="list-group list-group-flush">
        <div  class="list-group panel">
          <a href="#menu1" class="list-group-item list-group-item-action bg-utj text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fas fa-chalkboard-teacher"></i> <span class="hidden-sm-down">  Profesor Eje</span> </a>
          <div class="collapse" id="menu1">
            <a href="#"  onclick="crear('."'integrantes'".'); reiniciar('."'0'".');" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fas fa-user-plus"></i> Alta Equipo</a>
            <a href="#" onclick="crear('."'fechas'".');" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fa fa-calendar-check"></i>   Fechas</a>
              '.$profesor->equiposEvaluar().'
          </div>
        </div>
        <div  class="list-group panel">
          <a href="#menu2" class="list-group-item list-group-item-action bg-secondary text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fas fa-users"></i></i><span class="hidden-sm-down">  Grupos y Calificaciones</span> </a>
          <div class="collapse" id="menu2">
            '.$profesor->gruposProfesorEje().$profesor->gruposProfesor().'
          </div>
        </div>
        <div  class="list-group panel">
          <a href="#menu3" class="list-group-item list-group-item-action bg-primary text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-check-circle"></i> <span class="hidden-sm-down">  Calificar</span> </a>
          <div class="collapse" id="menu3">
            '.$profesor->gruposCalifEje().'
          </div>
        </div>
        <div  class="list-group panel">
         <a href="#menu4" class="list-group-item list-group-item-action bg-info text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fas fa-cog"></i> <span class="hidden-sm-down">   Configuración</span> </a>
         <div class="collapse" id="menu4">
         <a href="#"  onclick="abrirModalPass();" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fas fa-key"></i>  Cambiar Contraseña</a>
         </div>
       </div>
      </div>
    </div>
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="">
          <span id="menu-toggle" class="navbar-toggler-icon"></span>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" target="_blank" href="http://agora.utj.edu.mx/Account/Login">Ágora<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" target="_blank" href="http://www.utj.edu.mx/">UTJ</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link"  href="loginCerrar.php">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
        <h4 class="mt-4"><strong>Bienvenido a SGPC (Sistema Gestor de Proyectos Cuatrimestrales)</strong></h4>
        <p class="h5 text-justify pl-2 pr-2 pb-2 mb-4">Este sistema le permitirá dar de alta a equipos de proyecto, consultar fechas de proyecto, evaluar proyectos, consultar a los alumnos de su grupo eje, calificaciones de proyecto y calificar equipos de proyectos.
        </br>
        Además de exportar la información en pdf u excel si es necesario.
        </p>
          <div id="contenido" class="container">
          </div>
        </div>
      </div>
      <!-- /#page-content-wrapper -->
    </div>';
  }

  public function navProf($profesor){


    echo '<div class="d-flex" id="wrapper">
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">SGPC
        </div>
        <div class="list-group list-group-flush">
          <div  class="list-group panel">
            <a href="#menu1" class="list-group-item list-group-item-action bg-utj text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fas fa-chalkboard-teacher"></i> <span class="hidden-sm-down">  Profesores</span> </a>
            <div class="collapse" id="menu1">
              <a href="#" onclick="crear('."'fechas'".');" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fa fa-calendar-check"></i>   Fechas</a>
            </div>
          </div>
          <div  class="list-group panel">
            <a href="#menu2" class="list-group-item list-group-item-action bg-secondary text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="far fa-calendar-alt"></i><span class="hidden-sm-down">  Calificaciones</span> </a>
            <div class="collapse" id="menu2">
              '.$profesor->gruposProfesor().'
            </div>
          </div>
          <div  class="list-group panel">
            <a href="#menu3" class="list-group-item list-group-item-action bg-primary text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-check-circle"></i> <span class="hidden-sm-down">  Calificar</span> </a>
            <div class="collapse" id="menu3">
              '.$profesor->gruposCalif().'
            </div>
          </div>
          <div  class="list-group panel">
           <a href="#menu4" class="list-group-item list-group-item-action bg-info text-white collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fas fa-cog"></i> <span class="hidden-sm-down">   Configuración</span> </a>
           <div class="collapse" id="menu4">
           <a href="#"  onclick="abrirModalPass();" class="list-group-item list-group-item-action bg-light" data-parent="#menu1sub1sub1"><i class="fas fa-key"></i>  Cambiar Contraseña</a>
           </div>
         </div>
        </div>
      </div>
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
          <div class="">
            <span id="menu-toggle" class="navbar-toggler-icon"></span>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item active">
                <a class="nav-link" target="_blank" href="http://agora.utj.edu.mx/Account/Login">Ágora<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" target="_blank" href="http://www.utj.edu.mx/">UTJ</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link"  href="loginCerrar.php">Cerrar Sesión</a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="container-fluid">
          <h4 class="mt-4"><strong>Bienvenido a SGPC (Sistema Gestor de Proyectos Cuatrimestrales)</strong></h4>
          <p class="h5 text-justify pl-2 pr-2 pb-2 mb-4">Este sistema le permitirá consultar fechas de proyecto, calificaciones, y calificar equipos de proyectos.</br>
          Además de exportar la información en pdf u excel si es necesario.
          </p>
            <div id="contenido" class="container">
            </div>
          </div>
        </div>
        <!-- /#page-content-wrapper -->
      </div>';
    }


    public function navAlumnos(){
      echo '<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link"  onclick="crear('."'calAlumno'".');" href="#">Calificaciones  <span class="sr-only">(current) </span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" onclick="crear('."'fechas'".');" href="#">Fechas de Proyecto  <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a href="#"  onclick="abrirModalPass();" class="nav-link"><i class="fas fa-key"></i>  Cambiar Contraseña</a>
          </li>
            <li class="nav-item active">
              <a class="nav-link" target="_blank" href="http://agora.utj.edu.mx/Account/Login">Ágora<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" target="_blank" href="http://www.utj.edu.mx/">UTJ</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link"  href="loginCerrar.php">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
      <h4 class="mt-4"><strong>Bienvenido a SGPC (Sistema Gestor de Proyectos Cuatrimestrales)</strong></h4>
      <p class="h5 text-justify pl-2 pr-2 pb-2 mb-4">Este sistema le permitirá consultar fechas de proyecto y calificaciones de tus proyectos cuatrimestrales.</br>
      Además de exportar la información en pdf u excel si es necesario.
      </p>
          <div id="contenido" class="container">
          </div>

        </div>';

      }


    }

    ?>
