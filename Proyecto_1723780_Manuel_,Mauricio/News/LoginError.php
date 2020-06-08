<?php
require_once "php/conexion.php";
// If user pressed submit in one of the forms


 $loginsucc = 0;
$db_selectsection = 'S';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{


   // Validate name
   $input_user= trim($_POST["userf"]);
       $userg = $input_user;


     $input_pass = trim($_POST["txtPassword"]);
       $pass = $input_pass;




            if (!isset($msg)) // If there was no error
            {
 
                $query = "CALL sp_validation(?, ?);";
        if($stmt = mysqli_prepare($link, $query)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_user,$param_pass);
            
            // Set parameters
            $param_user = $userg;
            $param_pass = $pass;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $resulting = $row["resultlogin"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                   header("location: LoginError.php");
                    exit();
            }
        }




if($resulting > 0){
        $loginsucc = $resulting;
                header("location: Perfil.php?user=$loginsucc");
                exit();
            } else{
                   header("location: LoginError.php");
                    exit();
            }

            

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
  <link rel="stylesheet" href="CSS files/hr.css"> 
   <link rel="stylesheet" href="CSS files/logincard.css"> 
	<link rel="icon" href="imagenes/icon1.ico">
	


	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugins/jQuery/jquery-3.3.1.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
     <!-- js del proyecto -->
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
  <h1 style="color:  #2f435e; font-size: 400%; font-weight: 300;" >Inicio de Sesión</h1>
</div>
</div>

<div class="col-sm-12 mt-5 mb-5" >
  <div class="container login-container ">

            <div class="row">

            	 <div class="col-md-2">

                </div>


                <div class="col-md-2 login-form-1">

                    <h3>Usuario y/o contraseña incorrectos</h3>
                    <p>Porfavor, ingresa una cuenta y contraseña válida o registrate si aun no tienes cuenta</p>
                   
                </div>


                <div class="col-md-6 login-form-2">
                
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-row">

 
                            <div class="form-group col-md-12">
                            <label class="labelform" for="inputAdress">Nombre de usuario:</label>
                            <div class="input-container">
                            <i class="fa fa-user icon"></i>
                            <input pattern=".{6,}" name="userf" id="userf" type="text" class="form-control" placeholder="username" value="" />
                            </div>
                            </div>

                            <div class="form-group col-md-12">
                            <label class="labelform" for="inputAdress">Contraseña:</label>
                            <div class="input-container">
                            <i class="fa fa-lock icon"></i>

                                       <input pattern=".{6,}" type="password" id="password-field" class="form-control" placeholder="*******" name="txtPassword" />
                            <button type="button" id="btnToggle" class="toggle"><i id="pass-status" class="fa fa-eye" onClick="viewPassword()"></i></button>
                            </div>
                            </div>





</div>



                        <div class="form-group">
                          <div class="col-md-12">
<div class="form-group form-groupy">
                            <input type="submit" class="btnSubmit" value="Ingresar" />
                            </div>
                        </div>


                         <div class="form-group">
                          <div class="col-md-12">
<div class="form-group form-groupz">
                        <a  href="Registro.php" class="ForgetPwd" value="Ingresar">¿No tienes cuenta? Crea una aquí</a>
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