<?php
//require('php/conexion.php');
require_once "php/conexion.php";

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



    if(isset($_GET["written"]) && !empty(trim($_GET["written"]))){
        // Get URL parameter
        $n_id =  trim($_GET["written"]);
        
        // Prepare a select statement
        $sql = "CALL sp_detail(?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_idn);
            
            // Set parameters
            $param_idn = $n_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $n_titulo = $row["titulov"];
                    $n_descripcion = $row["descripcionv"];
                    $n_fecha = $row["fechav"];
                    $n_foto = $row["fotov"];
                    $n_lugar = $row["lugarv"];
                    $n_publicacion = $row["publicacionv"];
                    $n_texto = $row["textov"];
                    $n_idseccion = $row["idsv"];
                    $n_seccion = $row["seccionv"];
                    $n_color = $row["colorv"];
                    $n_idautor = $row["idautorv"];
                    $n_autor = $row["autorv"];
                    $n_correo = $row["correov"];
                    $n_profesion = $row["profesionv"];
                    $n_autfoto = $row["perfilv"];

        mysqli_free_result($result);
                } else{
                    header("location: error.php");
                    exit();
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


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	 <title>Backend Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<!-- font-awesome CSS -->
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<!-- css del proyecto -->
  <link rel="stylesheet" href="CSS files/backend.css">  

	<link rel="icon" href="imagenes/icon1.ico">
	  <link rel="stylesheet" href="CSS files/new.css"> 
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugins/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

     <!-- js del proyecto -->
 <script type="text/javascript" src="JS files/Sidebar.js"></script>
<script type="text/javascript" src="JS files/lightbox.js"></script>

</head>
<body   style="background-color : #FFFFFF;">


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
 <?php echo  ' <a href="AdminListaAdmins.php?user=' . $iduserx . '"><i class="fa fa-user-circle fa-fw"></i>&nbsp;&nbsp;Lista de administradores</a>';  ?>
   <?php echo  ' <a href="AdminNuevoReportero.php?user=' . $iduserx . '"><i class="fa fa-user-plus fa-fw"></i>&nbsp;&nbsp;Nuevo rol</a>  ';  ?>
   <?php echo  ' <a href="AdminListaReporteros.php?user=' . $iduserx . '"><i class="fa fa-users fa-fw"></i>&nbsp;&nbsp;Lista de reporteros</a>';  ?>
  <?php echo  '  <a href="AdminNoticias.php?user=' . $iduserx . '"><i class="fa fa-edit fa-fw"></i>&nbsp;&nbsp;Editor de noticias</a>';  ?>
   <?php echo  ' <a href="AdminSecciones.php?user=' . $iduserx . '"><i class="fa fa-bookmark fa-fw"></i>&nbsp;&nbsp;Secciones</a>';  ?>
</div>



<nav class="navbar navbar-expand-lg"  style="background-color:  #111;">
  <span style="font-size:30px;color:#FFFFFF; cursor:pointer" onclick="openNav()">&#9776; Menú</span>

      <div class="offset-md-1"></div>
    <ul class="navbar-nav">
    <li class="nav-item ">
      <h1 style="color:#FFFFFF">Backend Administrador</h1>
      </li>
    </ul>


  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown navbar-right">
        <a class="nav-link dropdown-toggle" href="#"  style="color:  white;"id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php echo $u_nombre ?> <?php echo $u_apellido ?> <?php echo '(' ?>
           <?php echo $u_username ?>  <?php echo ')' ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
               <?php echo  '<a class="dropdown-item" href="LandingPage.php?user=' . $iduserx . '"><i class="fa fa-arrow-right fa-fw"></i> Volver al portal</a>';  ?>
          <a class="dropdown-item" href="Login.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
        </div>

    
      </li>
   <?php echo ' <a class="navbar-brand" href="#"><img src = "data:image/jpg;base64,'.base64_encode($u_foto).'"  width="45" height="45" ></a>' ?>
    </ul>
  
  
  </div>
</nav>


<div id="main">

  <?php
echo '
 <p style="font-size: 120%;">' . $n_seccion . '</p>

  <div class="col-xs-12" style="height:5px;"></div>



  <h2 style="font-size: 240%;">' . $n_titulo . '</h2>


 <p style="font-size: 120%;"> ' . $n_descripcion . '</p>
 <p style="font-size: 120%;"> ' . $n_lugar . ' . ' . $n_fecha . '</p>

   <div class="col-xs-12" style="height:25px;"></div>';

$sql = "CALL sp_video('$n_id')";
 if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){

 echo '
<div class="row justify-content-center">      
<video width="920" height="520" controls>
<source src="data:video/mp4;base64,'.base64_encode($row["ruta"]).'" type="video/mp4">
<source src="movie.ogg" type="video/ogg">
Your browser does not support the video tag.
</video>
</div>
';
 }
                                              mysqli_free_result($result);

                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

 echo '<p style="font-size: 110%;">' . $n_texto . '</p>



';
  mysqli_next_result($link);

  ?>


<div class="container">
  <div class="row">
    <div class="row">

<?php echo '
 <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="' . $n_titulo . '"
                   data-image="data:image/jpg;base64,'.base64_encode($n_foto).'"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="data:image/jpg;base64,'.base64_encode($n_foto).'"
                         alt="Alt text">
                </a>
            </div>
' ;?>

 <?php 
$sql = "CALL sp_gallery('$n_id')";
 if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){
echo '          
 <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="' . $n_titulo . '"
                   data-image="data:image/jpg;base64,'.base64_encode($row["foto"]).'"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="data:image/jpg;base64,'.base64_encode($row["foto"]).'"
                         alt="Alt text">
                </a>
            </div>';




}
                            mysqli_free_result($result);
                                                        mysqli_next_result($link);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

?>

       








</div>


        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>






</div>

  </body>
</html>