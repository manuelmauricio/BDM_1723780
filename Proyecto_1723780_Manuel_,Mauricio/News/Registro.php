<?php
require_once "php/conexion.php";
// If user pressed submit in one of the forms

//$nombres ="";

$db_selectsection = 'S';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //echo $_FILES['photo']['tmp_name'];
    //echo $_POST['password'];
    
    // Validate name
    $input_nombres = trim($_POST["nombres"]);
        $nombres = $input_nombres;


    $input_apellidos = trim($_POST["apellidos"]);
        $apellidos = $input_apellidos;

    $input_correo = trim($_POST["correo"]);
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
                $query = "CALL sp_registration('$nombres',  '$apellidos', '$correo', '$username', '$contraseña',
                '$telefono','$data', '$ext');";

                
if($stmt =  mysqli_query($link, $query)){
            
                header("location: Login.php");
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
  <link rel="stylesheet" href="CSS files/hr.css"> 
   <link rel="stylesheet" href="CSS files/registercard.css"> 
     <link rel="stylesheet" href="CSS files/navbar.css">
    <link rel="icon" href="imagenes/icon1.ico">
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugins/jQuery/jquery-3.3.1.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
     <!-- js del proyecto -->
 <script type="text/javascript" src="JS files/registercard.js"></script>
<script type="text/javascript" src="JS files/eyepassword.js"></script>
</head>





  <body   style="background-color : #ECECEC;">
  

  
  
<?php  
 echo '<div class="navbar sticky-top navbar-light navbar-expand-md flex-row flex-wrap" style="background-color:#2F435E;">';

echo ' <div id="navbar" class="navbar-collapse collapse flex-row w-100 order-5 order-sm-5 order-md-1">

  <a class="navbar-brand" href="LandingPage.php"><img src = "imagenes/navlogo.png" width="100" height="35" ></a>


 <!-- Espacio derecho del navbar-->
  <ul class="navbar-nav ml-auto" >
     <li class="nav-item active" style="width:120px;">
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
      <a href="Registro.php" style="color:  #FFFFFF; background-color: #201b22; border-color: #4b5e65;" class="btn align-middle btn-primary">Registrarse</a>
    </li>

<li class="nav-item active" style="width:5px;">
 </li>

 
<li class="nav-item active">
     <a href="Login.php" style="color:  #FFFFFF; background-color: #4b5e65; border-color: #4b5e65;" class="btn align-middle btn-primary">Ingresar</a>
 </li>
  </ul>

  </div><!--/.nav-collapse -->';



echo '<div id="navbar" class="navbar-collapse collapse flex-row w-100 order-5 order-sm-5 order-md-1"> 
    <ul class="navbar-nav justify-content-center flex-grow-1">';






$sql = "CALL sp_seccion('$db_selectsection','null','null','null','null','null','null')";
 if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){
echo '<li class="nav-item active">
      <a class="nav-link" href="Categorias.php?section=' . $row['id_seccion'] . '"   style="color:  #FFFFFF; font-size: 110%; font-weight: 400; margin-top: -7px;  height: 120%; margin-bottom: -7px;  border-bottom:solid 4px' . $row['color'] . ';" >' . $row['nombre_seccion'] . '</a>
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








<div class="col-sm-12 mt-4 mb-0">


<div class="text-center" >
  <h1 style="color:  #2f435e; font-size: 400%; font-weight: 300;" >Registro de Usuario</h1>
</div>
</div>

<div class="col-sm-12 mt-5 mb-5">
  <div class="container login-container">
            <div class="row">
                <div class="col-md-3 login-form-1">
                    <h3>¡Bienvenido!</h3>
                    <p>Si creas una cuenta en el protal ahora mismo, podrás:</p>
                    <ul>
                   <li>Personalizar los datos de tu perfil</li>
                   <li>Dar "Me gusta" a las noticias de tu preferencia</li>
                   <li>Comentar en cualquier noticia</li>
                   <li>Acceder a la búsqueda avanzada</li>
                    </ul>
                </div>


                <div class="col-md-9 login-form-2">
                
                   <img src="imagenes/icon.png" alt="logo"  width="55" height="50" >
                    <h3>Llena el formulario para crear tu cuenta</h3>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Nombre(s):</label>
                            <input pattern=".{6,}" name="nombres" id="nombres" type="text" class="form-control" placeholder="Escribe tu nombre..." value="" />
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Apellido(s):</label>
                            <input pattern=".{6,}" name="apellidos" id="apellidos" type="text" class="form-control" placeholder="Escribe tu apellido..." value="" />
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Dirección de correo electrónico:</label>
                            <div class="input-container">
                            <i class="fa fa-envelope icon"></i>
                            <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="correo" id="correo" type="text" class="form-control" placeholder="alguien@ejemplo.com" value="" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Escribe una dirección de correo electrónico válida</small>
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Nombre de usuario:</label>
                            <div class="input-container">
                            <i class="fa fa-user icon"></i>
                            <input pattern=".{6,}" name="username" id="username"  type="text" class="form-control" placeholder="username" value="" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Mínimo 6 carácteres, máximo 30.   &nbsp; Se admiten números y carácteres</small>
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Contraseña:</label>
                            <div class="input-container">
                            <i class="fa fa-lock icon"></i>

                                       <input pattern=".{6,}" type="password" id="password-field" class="form-control" placeholder="*******" name="txtPassword" />
        <button type="button" id="btnToggle" class="toggle"><i id="pass-status" class="fa fa-eye" onClick="viewPassword()"></i></button>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Mínimo 6 carácteres, máximo 30.   &nbsp; Se admiten números y carácteres</small>
                            </div>

                            <div class="form-group col-md-6">
                            <label class="labelform" for="inputAdress">Número de teléfono o celular:</label>
                            <div class="input-container">
                            <i class="fa fa-phone icon"></i>
                            <input name="telefono" id="telefono" type="number" class="form-control" placeholder="(000)-000-00-00" value="" />
                            </div>
                            <small id="emailHelp" class="form-text text-muted">*Opcional</small>
                            </div>


<div class="form-group col-md-12">
<div class="form-group form-groupx">
 <label class="labelform" for="inputAdress">Foto de perfil:</label>
        <div class="input-group">
           <i class="fa fa-folder icon"></i>
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">


                   Examinar....         <input type="file" name="photo" id="imgInp">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
         <small id="emailHelp" class="form-text text-muted">*Carga una imágen de perfil desde tu computadora</small>
        <img src="Imagenes/avatar2.png" id='img-upload'/>
        <small id="emailHelp" class="form-text text-muted">*Si tu imagen es muy grande, es posible que se recorte para mostrarla en la barra de navegación</small>
    </div>
</div>



</div>

 

                        <div class="form-group">
                          <div class="col-md-12">
<div class="form-group form-groupy">
                            <input type="submit" class="btnSubmit" value="Registrarse" />
                            </div>
                        </div>


                         <div class="form-group">
                          <div class="col-md-12">
<div class="form-group form-groupz">
                        <a href="Login.php" class="ForgetPwd" value="Login">¿Ya tienes cuenta? Ingresa aquí</a>
                        </div>
                        </div>
                    </form>
                </div>


                </div>




      </div>
        </div>
</div>




  </body>
</html>