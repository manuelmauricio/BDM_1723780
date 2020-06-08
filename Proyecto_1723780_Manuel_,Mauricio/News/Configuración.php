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


$db_selectsection = 'S';



if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //echo $_FILES['photo']['tmp_name'];
    //echo $_POST['password'];
    
    // Validate name

    $input_clave = trim($_POST["clave"]);
        $clave = $input_clave;


    $input_nombres = trim($_POST["nombres"]);
        $nombres = $input_nombres;


    $input_apellidos = trim($_POST["apellidos"]);
        $apellidos = $input_apellidos;

    $input_correo = trim($_POST["correox"]);
        $correo = $input_correo;

    $input_username = trim($_POST["username"]);
        $username = $input_username;

    $input_contraseña = trim($_POST["txtPassword"]);
        $contraseña = $input_contraseña;

    $input_telefono = trim($_POST["telefono"]);
        $telefono = $input_telefono;


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
                $query = "CALL sp_updateuser('$clave', '$nombres',  '$apellidos', '$correo', '$username', '$contraseña',
                '$telefono','$data');";

                
if($stmt =  mysqli_query($link, $query)){
            
                header("location: Perfil.php?user=$clave");
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
	 <title>NewsPortal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<!-- font-awesome CSS -->
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<!-- css del proyecto -->
  <link rel="stylesheet" href="CSS files/navbar.css">  
  <link rel="stylesheet" href="CSS files/config.css">  
	<link rel="icon" href="imagenes/icon1.ico">
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugins/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

     <!-- js del proyecto -->
 <script type="text/javascript" src="JS files/registercard.js"></script>
<script type="text/javascript" src="JS files/eyepassword.js"></script>

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
    <a class="navbar-brand" href="Perfil.php?user=' . $iduserx . '"><img src="data:image/jpg;base64,'.base64_encode($u_foto).'" width="35" height="35" ></a>
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
  <h1 style="color:  #2f435e; font-size: 400%; font-weight: 300;" >Editar perfil</h1>

<div class="col-xs-12" style="height:25px;"></div>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Nombre(s):</label>
                            <input pattern=".{6,}" name="nombres" id="nombres" value="<?php echo $u_nombre; ?>" type="text" class="form-control" placeholder="Escribe tu nombre..." />
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Apellido(s):</label>
                            <input  pattern=".{6,}" name="apellidos" id="apellidos"  type="text" class="form-control" placeholder="Escribe tu apellido..." value="<?php echo $u_apellido; ?>" />
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Dirección de correo electrónico:</label>
                            <div class="input-container">
                            <i class="fa fa-envelope icon"></i>
                            <input  name="correox" id="correox"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="text" class="form-control" placeholder="alguien@ejemplo.com" value="<?php echo $u_correo; ?>" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Escribe una dirección de correo electrónico válida</small>
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Nombre de usuario:</label>
                            <div class="input-container">
                            <i class="fa fa-user icon"></i>
                            <input pattern=".{6,}" name="username" id="username"  type="text" class="form-control" placeholder="username" value="<?php echo $u_username; ?>" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Mínimo 6 carácteres, máximo 30.   &nbsp; Se admiten números y carácteres</small>
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Contraseña:</label>
                            <div class="input-container">
                            <i class="fa fa-lock icon"></i>

  <input pattern=".{6,}" type="password" id="password-field" class="form-control" placeholder="*******" name="txtPassword" value="<?php echo $u_contraseña; ?>" />
        <button type="button" id="btnToggle" class="toggle"><i id="pass-status" class="fa fa-eye" onClick="viewPassword()"></i></button>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Mínimo 6 carácteres, máximo 30.   &nbsp; Se admiten números y carácteres</small>
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Número de teléfono o celular:</label>
                            <div class="input-container">
                            <i class="fa fa-phone icon"></i>
                            <input name="telefono" id="telefono"  type="number" class="form-control" placeholder="(000)-000-00-00" value="<?php echo $u_telefono; ?>" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Opcional</small>
                            </div>

     <?php      echo '
<input name="clave" id="clave" type="hidden" value="' . $iduserx . '">

';?>


<div class="form-group col-md-12">
<div class="form-group form-groupx">
 <label class="labelform" for="inputAdress">Foto de perfil:</label>
        <div class="input-group">
           <i class="fa fa-folder icon"></i>
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">


                   Examinar.... <input type="file" name="photo" id="imgInp">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
         <small id="emailHelp" class="form-text text-muted">*Carga una imágen de perfil desde tu computadora</small>
         <?php echo '<img src="data:image/jpg;base64,'.base64_encode($u_foto).'"  id="img-upload"/>'; ?>
        <small id="emailHelp" class="form-text text-muted">*Si tu imagen es muy grande, es posible que se recorte para mostrarla en la barra de navegación</small>
    </div>
</div>



</div>

 

                        <div class="form-group">
                          <div class="col-md-12">
<div class="form-group form-groupy">
                            <input type="submit" class="btnSubmit" value="Guardar cambios" />
                            </div>
                        </div>


                    </form>
</div>


</div>

<div class="col-sm-3 fixed-side-column">
      <!-- I want this column to be fixed. -->
</div>


</div>
</div>





  </body>
</html>