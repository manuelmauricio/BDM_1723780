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
  <link rel="stylesheet" href="CSS files/tables.css">  
	<link rel="icon" href="imagenes/icon1.ico">
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugins/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

     <!-- js del proyecto -->
 <script type="text/javascript" src="JS files/Sidebar.js"></script>

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
  <h2>Editor de Noticias</h2>
  <p>Noticias que los reporteros han enviado y aún estan pendientes de su publicación.</p>

  <div class="row justify-content-center justify-content-md-center">



<div class="container">
  <div class="row">
    <div class="col-12">
    <table class="table table-image">
      <thead>
        <tr>
        
          <th scope="col">Noticia</th>
          <th scope="col">Autor</th>
          <th scope="col">Publicar noticia</th>
          <th scope="col">Leer noticia</th>
          <th scope="col">Eliminar noticia</th>
        </tr>
      </thead>
      <tbody>
      
<?php
$sql = "CALL sp_waiting()";
 if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){   
 
echo '  
        <tr>
          <td>' . $row['titulov'] . '</td>
          <td>' . $row['autorv'] . '</td>
          <td><a href="AdminPublicar.php?user=' . $iduserx . '&written=' . $row['idnoticia'] . '" class="btn btnbackend"> <i class="fa fa-check fa-fw"></td>
          <td><a href="AdminLeerNoticia.php?user=' . $iduserx . '&written=' . $row['idnoticia'] . '" class="btn btnbackend"> <i class="fa fa-eye fa-fw"></td>
          <td><a href="AdminRechazar.php?user=' . $iduserx . '&written=' . $row['idnoticia'] . '" class="btn btndeleted"> <i class="fa fa-trash fa-fw"></td>
        </tr>';

}
                            mysqli_next_result($link);
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }     
?> 


      </tbody>
    </table>   
    </div>
  </div>
</div>
    </div>



</div>

  </body>
</html>