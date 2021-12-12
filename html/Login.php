  <!DOCTYPE html>
  <html>
  <head>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

  

  
  </head>
  <!------ Include the above in your HEAD tag ---------->
  <body background="../images/mascotas.jpg" bgproperties="fixed">
    <form action="login.php" method="post"> 
      <div class="container">
        <div class="container">    
          <div id="loginbox" class="mainbox col-md-5 col-md-offset-4 col-sm-7 col-sm-offset-3">                    
            <div class="panel panel-primary" >
              <div class="panel-heading">
                <div class="panel-title text-center"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</div>   
              </div>     
              <div id="cuerpo_panel" class="panel-body" >             
                <?php if($this->error)
                {
                  ?>
                <div class="alert-danger form-group"><center>ERROR: Inicio de sesión incorrecto. Verifique su e-mail y contraseña.</center></div>
                  <?php
                }
                ?>
                <form id="loginform" class="form-horizontal" role="form">                                        
                  <div id="grupo1" class="input-group col-sm-offset-3 col-sm-7">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input  type="text" class="form-control" name="email" value="" placeholder="Ingresar Mail">
                  </div>
                  <div id="grupo2" class="input-group col-sm-offset-3 col-sm-7">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input  type="password" class="form-control" name="password" placeholder="Ingresar Contraseña">
                  </div>
                  <div align="center">
                    <button type="submit" class="btn btn-info">Ingresar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>


