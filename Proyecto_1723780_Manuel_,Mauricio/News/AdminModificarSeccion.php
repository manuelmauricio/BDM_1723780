<?php
//require('php/conexion.php');
require_once "php/conexion.php";

// Define variables and initialize with empty values
$nombrev = $colorv = $descv = "";

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


// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
                $idadmin = $_POST["idadmin"];
    // Validate name
    $input_nombre = trim($_POST["nombref"]);
        $nombrev = $input_nombre;
    
    
    // Validate address
    $input_color = trim($_POST["colorf"]);
        $colorv = $input_color;
    
    // Validate salary
    $input_desc = trim($_POST["descf"]);
        $descv = $input_desc;

        $sql = "CALL sp_seccion('U', ?, ?,'null',?,?,'null')";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isss", $param_id, $param_nombre, $param_color, $param_desc);
            
            // Set parameters
            $param_id = $id;
            $param_nombre = $nombrev;
            $param_color = $colorv;
            $param_desc = $descv;

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: AdminSecciones.php?user=$idadmin");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        // Prepare a select statement
        $sql = "CALL sp_seccion('Z', ?, 'null','null','null','null','null')";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nombrev = $row["nombre_seccion"];
                    $colorv = $row["color"];
                    $descv = $row["descripcion"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
       // mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
<script type="text/javascript" src="JS files/color.js"></script>
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
 <h2>Editar sección</h2>
  <p>Modificar los datos de esta sección</p>

  <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName">Nombre:</label>
      <input type="name" name="nombref" class="form-control" id="inputName" aria-describedby="namelHelp" value="<?php echo $nombrev; ?>">
    </div>
  
    <div class="form-group col-md-6">
      <label for="inputName2">Color:</label>
      <input type="name" name="colorf" pattern="[a-zA-Z0-9]{6,}" class="form-control jscolor" id="inputName2" aria-describedby="nameHelp" value="<?php echo $colorv; ?>">
    </div>      


</div>
   

 <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputUser">Descripción:</label>
      <input type="name" class="form-control" id="inputUser" name="descf" aria-describedby="userHelp"  placeholder="Descripción" value="<?php echo $descv; ?>">
    </div>
 </div>  
  
                           <input type="hidden" name="idadmin" value="<?php echo $iduserx; ?>"/>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
  <button class="btn btnbackend" type="submit"><i class="fa fa-check fa-fw"></i>&nbsp;&nbsp;Aplicar cambios</button>
</form>

</div>

  </body>
</html>