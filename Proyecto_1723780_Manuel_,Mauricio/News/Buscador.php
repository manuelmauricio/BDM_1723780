<?php
require('php/conexion.php');

  $iduserx = $u_id = $u_apellido = $u_correo = $u_username =  $u_contraseña =  $u_telefono = $u_profesion  = $u_foto = $u_rol  ="";
  // Check existence of id parameter before processing further
    if(isset($_GET["user"]) && !empty(trim($_GET["user"]))){
        // Get URL parameter
        $iduserx =  trim($_GET["user"]);
        
        // Prepare a select statement
        $sql = "CALL sp_datauser(?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $iduserx;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $u_id = $row["id_usuario"];
                    $u_nombre = $row["nombres"];
                    $u_apellido = $row["apellidos"];
                    $u_correo = $row["correo"];
                    $u_username = $row["username"];
                    $u_contraseña = $row["contraseña"];
                    $u_telefono = $row["telefono"];
                    $u_profesion = $row["profesion"];
                    $u_foto = $row["foto_perfil"];
                    $u_rol = $row["rol_usuario"];
        mysqli_free_result($result);
                } else{
                      $iduserx = 0;
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }




        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
   //     mysqli_close($link);

}


$db_selectsection = 'S';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    // Validate name
    $input_busc = trim($_POST["busc"]);
        $busc = $input_busc;


    $input_currentus = trim($_POST["currentus"]);
        $currentus = $input_currentus;







            
                header("location: Result.php?user=$currentus&search=$busc");
                exit();
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	 <title>NewsPortal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<!-- font-awesome CSS -->
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<!-- css del proyecto -->
  <link rel="stylesheet" href="CSS files/navbar.css">  
<link rel="stylesheet" href="CSS files/searcher.css">  
	<link rel="icon" href="imagenes/icon1.ico">
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugins/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

     <!-- js del proyecto -->

</head>
<body   style="background-color : #ECECEC;">
  

  
  
  <?php 
echo '<div class="navbar sticky-top navbar-light navbar-expand-md flex-row flex-wrap" style="background-color:#2F435E;">';

echo '  <div id="navbar" class="navbar-collapse collapse flex-row w-100 order-5 order-sm-5 order-md-1">

  <a class="navbar-brand" href="LandingPage.php?user=' . $iduserx . '"><img src = "imagenes/navlogo.png" width="100" height="35" ></a>


 <!-- Espacio derecho del navbar-->
  <ul class="navbar-nav ml-auto" >
     <li class="nav-item active" style="width:250px;">
    </li>
  </ul>



  <div class="col-sm-3 col-md-6">
        <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar noticias..." name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" style="background-color: #4b5e65; color:  #ffffff; " type="submit"><i class="fa fa-search fa-fw" ></i></button>
            </div>
        </div>
        </form>
  </div>
     
    

     <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
        <a class="nav-link" href="Buscador.php?user=' . $iduserx . '"   style="color:  #ffffff;" > <i class="fa fa-search-plus fa-fw"></i>Busqueda Avanzada<span class="sr-only">(current)</span></a>
      </li>
    <li class="nav-item dropdown navbar-right">
        <a class="nav-link dropdown-toggle" href="#"  style="color:  #ffffff;"id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user fa-fw"></i>';  echo $u_username;
       echo '</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="Perfil.php?user=' . $iduserx . '"><i class="fa fa-id-card fa-fw"></i> Mi Perfil</a>
          <a class="dropdown-item" href="MeGusta.php?user=' . $iduserx . '"><i class="fa fa-heart fa-fw"></i> Me Gusta</a>
          <a class="dropdown-item" href="Configuración.php?user=' . $iduserx . '"><i class="fa fa-cogs fa-fw"></i> Configuración</a>
          <hr class="menuhrx" style="border:  1px solid #C0C0C0;">';
          if ($u_rol ==2){
          echo '<a class="dropdown-item" href="ReporteroNoticias.php?user=' . $iduserx . '"><i class="fa fa-code fa-fw"></i> Ventana de Reportero</a>';
          }
          if ($u_rol ==3){
                  echo '<a class="dropdown-item" href="AdminNoticias.php?user=' . $iduserx . '"><i class="fa fa-code fa-fw"></i> Ventana de administrador</a>';
          }
           echo '<a class="dropdown-item" href="LandingPage.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>

        </div>
    
      </li>
    <a class="navbar-brand" href="Perfil.php?user=' . $iduserx . '"><img src="data:image/jpg;base64,'.base64_encode($u_foto).'"width="35" height="35" ></a>
    </ul>

  </div><!--/.nav-collapse -->';



echo '<div id="navbar" class="navbar-collapse collapse flex-row w-100 order-5 order-sm-5 order-md-1"> 
    <ul class="navbar-nav justify-content-center flex-grow-1">';






$sql = "CALL sp_seccion('$db_selectsection','null','null','null','null','null','null')";
 if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){
echo '<li class="nav-item active">
      <a class="nav-link" href="Categorias.php?user=' . $iduserx . '&section=' . $row['id_seccion'] . '"   style="color:  #FFFFFF; font-size: 110%; font-weight: 400; margin-top: -7px;  height: 120%; margin-bottom: -7px;  border-bottom:solid 4px' . $row['color'] . ';" >' . $row['nombre_seccion'] . '</a>
</li>';

}

                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 




echo    '</ul>  
</div><!--/.nav-collapse -->';



echo    '</div>';

?>  



<div class="col-xs-12" style="height:25px;"></div>

<div class="container-fluid">
  <div class="row">



<div class="col-sm-3 fixed-side-column">
      <!-- I want this column to be fixed. -->
</div> 



<div class="col-sm-6 fluid-middle-column">
 
<div class="text-center" >
  <h1 style="color:  #2f435e; font-size: 400%; font-weight: 300;" >Buscador</h1>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-row">



                            <div class="form-group col-md-12">
                            <label class="labelform" for="inputAdress">Buscar por texto en el título o descripción de la noticia:</label>
                            <div class="input-container">
                            <i class="fa fa-pencil icon"></i>
                            <input pattern=".{1,}" name="busc" id="busc" type="text" class="form-control" value="" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Escribe palabras del título o descripción de una noticia</small>
                            </div>

                              <div class="form-group col-md-12">
                            <label class="labelform" for="inputAdress">Buscar texto en las palabras clave de las noticias:</label>
                            <div class="input-container">
                            <i class="fa fa-key icon"></i>
                            <input type="text" class="form-control"  value="" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Escribe palabras claves de una noticia</small>
                            </div>


                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Buscar por rango de fechas. Del:</label>
                            <div class="input-container">
                            <i class="fa fa-table icon"></i>
                            <input type="text" class="form-control" value="" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Escribe un rango entre dos fechas</small>
                            </div>




                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Al:</label>
                            <div class="input-container">
                            <i class="fa fa-table icon"></i>
                            <input type="text" class="form-control"  value="" />
                            </div>
                            </div>
     <?php      echo '
<input name="currentus" id="currentus" type="hidden" value="' . $iduserx . '">

';?>



                            <button type="submit" class="btn btn-primary" style="background-color: #44566c; border-color : #44566c;"><i class="fa fa-search fa-fw"></i>&nbsp;Buscar</button>


</form>
</div>

<div class="col-sm-3 fixed-side-column">
      <!-- I want this column to be fixed. -->
</div>


</div>
</div>





  </body>
</html>