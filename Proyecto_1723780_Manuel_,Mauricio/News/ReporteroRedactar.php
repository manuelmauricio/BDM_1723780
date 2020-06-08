<?php
//require('php/conexion.php');
require_once "php/conexion.php";

$db_selectsection = 'S';


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

    // Validate name
    $input_lugar = trim($_POST["lugar"]);
        $lugar = $input_lugar;


    $input_fecha = trim($_POST["fecha"]);
        $fecha = $input_fecha;

    $input_titulo = trim($_POST["titulo"]);
        $titulo = $input_titulo;

    $input_descripcion = trim($_POST["descripcion"]);
        $descripcion = $input_descripcion;

    $input_texto = trim($_POST["texto"]);
        $texto = $input_texto;


    $input_autor = trim($_POST["autor"]);
        $autor = $input_autor;

    $input_seccion = trim($_POST["seccion"]);
        $seccion = $input_seccion;


    $input_destacada = trim($_POST["destacada"]);
        $destacada = $input_destacada;

    $input_palabra = trim($_POST["palabra"]);
        $palabra = $input_palabra;


        if (isset($_FILES['photo']) && isset($_FILES['photox']) && isset($_FILES['photoy'])  )
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

                $datax = file_get_contents($_FILES['photox']['tmp_name']);
                $datax = mysqli_real_escape_string($link, $datax);

                $datay = file_get_contents($_FILES['photoy']['tmp_name']);
                $datay = mysqli_real_escape_string($link, $datay);

               $datav = file_get_contents($_FILES['UploadFileName']['tmp_name']);
               $datav = mysqli_real_escape_string($link, $datav);

                // Preparing data to be used in MySQL query
                //$query = "INSERT INTO {$table} SET ext='$ext', title='$title', data='$data'";
                //$query = "INSERT INTO {$table}(ext, title, data) VALUES('$ext', '$title', '$data')";
                //
                //mysql_query($query);
                $query = "CALL sp_redactar('$lugar', '$fecha', '$titulo',  '$descripcion', '$texto', '$autor', '$seccion',
                '$destacada', '$data', '$ext', '$datax', '$ext', '$datay', '$ext', '$palabra', '$datav')";

                
if($stmt =  mysqli_query($link, $query)){
            
                header("location: ReporteroNoticias.php?user=$autor");
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
        mysqli_close($link);
}








?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	 <title>Backend Reportero</title>
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
  <?php echo  ' <a href="ReporteroNoticias.php?user=' . $iduserx . '"><i class="fa fa-list fa-fw"></i>&nbsp;&nbsp;Lista de Noticias</a> ';  ?>
  <?php echo  ' <a href="ReporteroRedactar.php?user=' . $iduserx . '"><i class="fa fa-pencil fa-fw"></i>&nbsp;&nbsp;Redactar</a>' ;  ?>
</div>




<nav class="navbar navbar-expand-lg"  style="background-color:  #111;">
  <span style="font-size:30px;color:#FFFFFF; cursor:pointer" onclick="openNav()">&#9776; Menú</span>

    <div class="offset-md-1"></div>
    <ul class="navbar-nav">
    <li class="nav-item ">
      <h1 style="color:#FFFFFF">Backend Reportero</h1>
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
  <h2>Reactar noticia</h2>
  <p>Escribe una nueva noticia</p>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputName">Título:</label>
      <input name="titulo" id="titulo" pattern=".{6,}" type="name" class="form-control"  aria-describedby="namelHelp" placeholder="Título de la noticia">
    </div>   
</div>
   
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputName">Descripción:</label>
      <input name="descripcion" id="descripcion" pattern=".{6,}" type="name" class="form-control" aria-describedby="namelHelp" placeholder="Descripción de la noticia">
    </div>   
</div>


<div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputUser">Lugar:</label>
      <input name="lugar" id="lugar" pattern=".{6,}" type="user" class="form-control" aria-describedby="userHelp" placeholder="Lugar: Colonia, Ciudad, País
">
    </div>
  
    <div class="form-group col-md-4">
      <label for="inputPassword">Fecha:</label>
      <input name="fecha" id="fecha" pattern=".{6,}" type="text" class="form-control" aria-describedby="PasswordHelp" placeholder="Fecha-Hora del acontecimiento">
    </div>

    <div class="form-group col-md-4">
      <label for="inputName2">Sección:</label>
    <select class="form-control" name="seccion" id="seccion">
<?php
  $sql = "CALL sp_seccion('$db_selectsection','null','null','null','null','null','null')";
 if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){
    



     echo ' <option value="' . $row['id_seccion'] . '">' . $row['nombre_seccion'] . '</option>';


}

                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }
 
                             mysqli_next_result($link);
?>



    </select> 
  </div>  


  </div>  
  
  
  <div class="form-row">
  
   <div class="form-group col-md-12">
    <label for="exampleFormControlTextarea1">Noticia:</label>
    <textarea name="texto" id="texto" pattern=".{6,}" class="form-control" rows="13"></textarea>
  </div>

  </div>  
  
  
   <div class="form-row">
 <div class="form-group col-md-6">
      <label for="inputName2">Palabras clave:</label>
      <input name="palabra" id="palabra" pattern=".{6,}" class="form-control"  aria-describedby="nameHelp" placeholder="Palabra,ejemplo,etc">
              <small id="nameHelp" class="form-text text-muted">*Separar las palabras clave con una coma (,)</small>
    </div> 

<div class="form-group col-md-6">
      <label for="inputName2">¿Es una noticia de último momento?</label>
    <select class="form-control" name="destacada" id="destacada"">
      <option value="0">No</option>
      <option value="1">Sí</option>
    </select>
    <small id="nameHelp" class="form-text text-muted">*Importante</small>  


     <?php      echo '
<input name="autor" id="autor" type="hidden" value="' . $iduserx . '">

';?>
    

  </div> 


    </div>
    
   <div class="form-row">
 <div class="form-group col-md-12">
     <label for="inputimage">Fotos de la noticia:</label>
        <div class="input-group mb-3">
        <input type="file" name="photo" id="photo" class="form-control"   placeholder="Avatar" aria-label="Username" aria-describedby="basic-addon1" name="files" multiple>
        <small id="imagenHelp" class="form-text text-muted">*Cargra multiples imágenes para acompañar la noticia</small>
      </div>
    </div> 
    </div>

   <div class="form-row">
 <div class="form-group col-md-12">
     <label for="inputimage">Fotos de la noticia:</label>
        <div class="input-group mb-3">
        <input type="file" name="photox" id="photox" class="form-control"   placeholder="Avatar" aria-label="Username" aria-describedby="basic-addon1" name="files" multiple>
        <small id="imagenHelp" class="form-text text-muted">*Cargra multiples imágenes para acompañar la noticia</small>
      </div>
    </div> 
    </div>

     <div class="form-row">
 <div class="form-group col-md-12">
     <label for="inputimage">Fotos de la noticia:</label>
        <div class="input-group mb-3">
        <input type="file" name="photoy" id="photoy" class="form-control"   placeholder="Avatar" aria-label="Username" aria-describedby="basic-addon1" name="files" multiple>
        <small id="imagenHelp" class="form-text text-muted">*Cargra multiples imágenes para acompañar la noticia</small>
      </div>
    </div> 
    </div>

  <div class="form-row">
 <div class="form-group col-md-12">
     <label for="inputimage">Videos de la noticia:</label>
        <div class="input-group mb-3">
        <input type="file" name="UploadFileName" id="UploadFileName" class="form-control"   placeholder="Avatar" aria-label="Username" aria-describedby="basic-addon1" name="files" multiple>
        <small id="imagenHelp" class="form-text text-muted">*Cargra multiples videos para acompañar la noticia</small>
      </div>
    </div> 
    </div>


 


  


  <button class="btn btnbackend" type="submit"><i class="fa fa-check fa-fw"></i>&nbsp;&nbsp;Guardar noticia</button>
</form>
</div>

  </body>
</html>