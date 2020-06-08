<?php
require_once "php/conexion.php";
// If user pressed submit in one of the forms

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




if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //echo $_FILES['photo']['tmp_name'];
    //echo $_POST['password'];
    $idadmin = $_POST["idadmin"];
    // Validate name
    $input_nombres = trim($_POST["nombres"]);
        $nombres = $input_nombres;


    $input_apellidos = trim($_POST["apellidos"]);
        $apellidos = $input_apellidos;

    $input_correo = trim($_POST["correo"]);
        $correo = $input_correo;

    $input_username = trim($_POST["username"]);
        $username = $input_username;

    $input_contraseña = trim($_POST["contraseña"]);
        $contraseña = $input_contraseña;

    $input_telefono = trim($_POST["telefono"]);
        $telefono = $input_telefono;

    $input_profesion = trim($_POST["profesion"]);
        $profesion = $input_profesion;


    $input_roluser = trim($_POST["roluser"]);
        $roluser = $input_roluser;


        if (isset($_FILES['photo']))
        {
            @list(, , $imtype, ) = getimagesize($_FILES['photo']['tmp_name']);
            // Get image type.
            // We use @ to omit errors

            if ($imtype == 3) // cheking image type
                $ext="png";   // to use it later in HTTP headers
            elseif ($imtype == 2)
                $ext="jpeg";
            elseif ($imtype == 1)
                $ext="gif";
            else
                $msg = 'Error: unknown file format';

            if (!isset($msg)) // If there was no error
            {
                $data = file_get_contents($_FILES['photo']['tmp_name']);
                $data = mysqli_real_escape_string($link, $data);
                // Preparing data to be used in MySQL query
                //$query = "INSERT INTO {$table} SET ext='$ext', title='$title', data='$data'";
                //$query = "INSERT INTO {$table}(ext, title, data) VALUES('$ext', '$title', '$data')";
                //
                //mysql_query($query);
                $query = "CALL sp_usuario('I', 'null', '$nombres',  '$apellidos', '$correo', '$username', '$contraseña',
                '$telefono', '$profesion', '$data', '$ext', '$roluser');";

                
if($stmt =  mysqli_query($link, $query)){
            
                header("location: AdminListaReporteros.php?user=$idadmin");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
}
            
        }
    else
    {
//
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
  <h2>Agregar un nuevo rol a la página</h2>
  <p>Llene el formulario para dar de alta un nuevo miembro a la página. Importante especificar si se trata de un nuevo reportero o un administrador</p>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputName">Nombre(s);</label>
      <input  name="nombres" id="nombres" type="name" pattern=".{6,}" class="form-control" id="inputName" aria-describedby="namelHelp" placeholder="Nombre">
    </div>
  
    <div class="form-group col-md-4">
      <label for="inputName2">Apellido(s);</label>
      <input  name="apellidos" id="apellidos" type="name" pattern=".{6,}" class="form-control" id="inputName2" aria-describedby="nameHelp" placeholder="Apellido">
    </div>      

  

  <div class="form-group col-md-4">
      <label for="inputEmail">Correo electrónico:</label>
      <input name="correo" id="correo" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="inputemail" aria-describedby="emailHelp" placeholder="alguien@ejemplo.com">
    </div>    
</div>
   
    
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputUser">Clave de usuario:</label>
      <input name="username" id="username" type="user" pattern=".{6,}" class="form-control" id="inputUser" aria-describedby="userHelp" placeholder="usuarioejemplo123">
    </div>
  
    <div class="form-group col-md-6">
      <label for="inputPassword">Contraseña del usuario:</label>
      <input name="contraseña" id="contraseña" type="password" pattern=".{6,}" class="form-control" id="inputPassword" aria-describedby="PasswordHelp" placeholder="********">
    </div>

  </div>  
  
  
  <div class="form-row">
  
    <div class="form-group col-md-4">
      <label for="inputNumber">Teléfono:</label>
      <input name="telefono" id="telefono" type="number" pattern=".{6,}" class="form-control" id="inputNumber" aria-describedby="numHelp" placeholder="XX-XX-XX-XX">
    </div> 

     <div class="form-group col-md-4">
      <label for="inputName2">Estudios:</label>
      <input name="profesion" id="profesion" type="name" pattern=".{6,}" class="form-control" id="inputName23" aria-describedby="nameHelp" placeholder="Licenciatura en...">
    </div>      

                         <input type="hidden" name="idadmin" value="<?php echo $iduserx; ?>"/>

<div class="form-group col-md-4">
      <label for="inputName2">Rol:</label>
    <select class="form-control" name="roluser" id="roluser"">
      <option value="2">Reportero</option>
      <option value="3">Administrador</option>
    </select>
    <small id="nameHelp" class="form-text text-muted">*Importante</small>  
  </div>  

  </div>  
  
  
   <div class="form-row">
  <div class="form-group col-md-8">
  <label for="inputimage">Imágen de perfil:</label>
        <div class="input-group mb-3">
        <input type="file" class="form-control"   placeholder="Avatar" aria-label="Username" aria-describedby="basic-addon1" name="photo" id="photo">
        <small id="imagenHelp" class="form-text text-muted">*Cargra una imágen de perfil desde tu computadora</small>
      </div>
      </div>
    </div>
    

  <button class="btn btnbackend" type="submit"><i class="fa fa-check fa-fw"></i>&nbsp;&nbsp;Registrar</button>
</form>


</div>




  </body>
</html>