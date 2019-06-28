<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/misEstilos.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="font-awesome/css/all.css" rel="stylesheet" type="text/css">
    <link href="img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <title>SGPC.utj</title>
  </head>
  <body>
    <br>
    <div class="container">
      <div id="principal">
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="align-items-center ">
              <header class="">
                <center><h1 class="">Ingreso a SGPC</h1></center>
              </header>
              <div class="modal-header">
                <img class="img-fluid"  src="img/logo_utj.png" alt="">
              </div>
              <br>
              <form class="form-horizontal" action="loginValidar.php" method="post" >
                <div class="form-group">
                  <div class="input-group col-md-12">
                    <div class="input-group-prepend">
                      <span class="input-group-text" for="nombreUsuario"  id="basic-addon1">&nbsp;<center><i class="fa fa-user"></i>&nbsp;</center></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" id="nombreUsuario" name="nombreUsuario" placeholder="Usuario" aria-label="Usuario" aria-describedby="basic-addon1" required>
                  </div>
                </div>
              </br>
              <div class="form-group">
                <div class="input-group col-md-12">
                  <div class="input-group-prepend">
                    <span class="input-group-text" for="password"  id="basic-addon1">&nbsp;<center><i class="fa fa-unlock-alt"></i>&nbsp;</center></span>
                  </div>
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Contraseña" aria-label="password" aria-describedby="basic-addon1" required>
                </div>
              </div>
              <div class="modal-footer">
                <button   type="submit" class="btn btn-primary btn-lg">Listo</button>
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include 'Vista/Footer.php';
  $footer = new Footer();
  $footer->footerLogin();
  ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.3.1.js" ></script>
  <script src="js/bootstrap.js" ></script>
</body>
</html>
