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



if(isset($_GET["new"]) && !empty(trim($_GET["new"]))){
        // Get URL parameter
        $n_id =  trim($_GET["new"]);
        
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
        



      $sql = "CALL sp_countlikes(?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_idnc);
            
            // Set parameters
            $param_idnc = $n_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $n_likes = $row["contador"];


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


}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    // Validate name
    $input_nnoticia = trim($_POST["noti"]);
        $nnoticia = $input_nnoticia;


    $input_comentardor = trim($_POST["commenter"]);
        $comentardor = $input_comentardor;

    $input_comentario = trim($_POST["coment"]);
        $comentario = $input_comentario;






            if (isset($_POST['publish'])) // If there was no error
            {
 
                $query = "CALL sp_comment('$comentario', '$nnoticia', '$comentardor');";

                
if($stmt =  mysqli_query($link, $query)){
            
                header("location: Noticia.php?user=$comentardor&new=$nnoticia");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
}




 if (isset($_POST['like'])) {
                $query = "CALL sp_like('$nnoticia', '$comentardor');";
         if($stmt =  mysqli_query($link, $query)){   
                header("location: Noticia.php?user=$comentardor&new=$nnoticia");
                exit();
                            } else{
                echo "Something went wrong. Please try again later.";
            }

}


}


$db_selectsection = 'S';

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
	<link rel="stylesheet" href="CSS files/carousel.css"> 
    <link rel="stylesheet" href="CSS files/commentbox.css">
  <link rel="stylesheet" href="CSS files/card.css"> 
  <link rel="stylesheet" href="CSS files/new.css"> 
	<link rel="icon" href="imagenes/icon1.ico">
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugins/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

     <!-- js del proyecto -->
<script type="text/javascript" src="JS files/lightbox.js"></script>
  </head>
  <body   style="background-color : #ECECEC;">
  

  
  
 <!-- NAVBAR PRINCIPAL-->
<?php


if ($iduserx == 0){
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
                            mysqli_next_result($link);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 




echo    '</ul>  
</div><!--/.nav-collapse -->';



echo    '</div>';

}


else{

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
                                                        mysqli_next_result($link);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 




echo    '</ul>  
</div><!--/.nav-collapse -->';



echo    '</div>';




}


?>  



<div class="col-xs-12" style="height:25px;"></div>

<div class="container-fluid">
  <div class="row">



<div class="col-sm-2 fixed-side-column">
      <!-- I want this column to be fixed. -->
</div> 



<div class="col-sm-8 fluid-middle-column">


<a class="alink" style="background-color: #2f435e; "href="#">Portada</a>
<a style = "font-size: 120%; color: #44566c; font-weight: 600;">/</a>
<?php echo '<a class="alink" style="background-color:' . $n_color . '; "href="#">' . $n_seccion . '</a>';?>
<a style = "font-size: 120%; color: #44566c; font-weight: 600;">/</a>
<?php echo '<a class="alink" style="background-color:' . $n_color . '; "href="#">' . $n_titulo . '</a>';?>


<div class="col-xs-12" style="height:25px;"></div>

<?php
echo '

     <h2 style="color:  #201b22; font-size: 280%; font-weight: 500;">' . $n_titulo . '</h2>
     <hr class="titlehr" style="border:  3px solid ' . $n_color . ';">
     <h3 style="color:  #000000; font-size: 180%; font-weight: 400;">' . $n_descripcion . '</h2>
';?>

<?php echo '
<hr class="topdate" style="border: 1px solid #44566c;">
<h6 style="color:  #44566c; font-size: 110%; font-weight: 400;"> ' . $n_lugar . ' . ' . $n_fecha . '
</h6>
<i style="color:  #44566c; font-size: 110%; font-weight: 400;">Publicado el: ' . $n_publicacion . ' </i>
<hr class="topdatedos" style="border: 1px solid #44566c;">'

;?>


<div class="col-xs-12" style="height:25px;"></div>


<?php 
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
<i style="color:  #44566c; font-size: 120%; font-weight: 400;">' . $n_descripcion . '</i>
</div>
';
 }
                                              mysqli_free_result($result);
                                                        mysqli_next_result($link);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

;?>

<div class="col-xs-12" style="height:35px;"></div>

<?php echo ' <p style="color:  #000000; font-size: 120%; font-weight: 400;">' . $n_texto . '</p>' ;?>



<div class="col-xs-12" style="height:15px;"></div>

<div class="text-center" >
    <h2 style="color:  #44566c; font-size: 240%; font-weight: 600;">Galería</h2>
</div>


<div class="col-xs-12" style="height:10px;"></div>


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


<div class="col-xs-12" style="height:15px;"></div>



<div class="col-xs-12" style="height:35px;"></div>


<h2 style="color:  #44566c; font-size: 200%; font-weight: 500;">Sobre el autor:</h2>

<?php echo ' <div class="container" style="background-color: #ffffff">
    <div class="row">
    <div class="col-md-12">
            <div class="well well-sm">
                <div class="media">
                    <a class="thumbnail pull-left" href="data:image/jpg;base64,'.base64_encode($n_autfoto).'">
                        <img class="media-object" src="data:image/jpg;base64,'.base64_encode($n_autfoto).'">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">' . $n_autor . '</h4>
                        <h5 class="media-subheading"><i class="fa fa-graduation-cap fa-fw"></i> &nbsp;' . $n_profesion . '</h5>
                        <h5 class="media-subheading"><i class="fa fa-envelope fa-fw"></i> &nbsp;' . $n_correo . '</h5>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>';
?>


<div class="col-xs-12" style="height:35px;"></div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">


     <?php      echo '
<input name="commenter" id="commenter" type="hidden" value="' . $iduserx . '">

';?>
    
     <?php      echo '
<input name="noti" id="noti" type="hidden" value="' . $n_id . '">

';
?>

<button name="like" type="submit" class="btn btn-primary" style="background-color: #4b5e65; border-color : #4b5e65;     margin-left: 55vw;  font-weight: 600; font-size: 130%;"><i class="fa fa-heart fa-fw"></i>Me gusta</button>
</form>

<div class="col-xs-12" style="height:1px;"></div>

<?php
echo '   <p style="color:  #2f435e; font-size: 100%; font-weight: 500;     margin-left: 47vw;">A ' . $n_likes . ' personas les gusta esta noticia</p>
';
?>

<div class="col-xs-12" style="height:15px;"></div>

<h2 style="color:  #44566c; font-size: 150%; font-weight: 500;">Etiquetas:</h2>

<?php

$sql = "CALL sp_relatedwords('$n_id')";
 if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){
echo '   <a href="#" class="badge">' . $row['palabra'] . '</a>';
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



<div class="col-xs-12" style="height:35px;"></div>

<h2 style="color:  #44566c; font-size: 200%; font-weight: 500;">Comentarios:</h2>


<div class="col-xs-12" style="height:5px;"></div>

<div class="row justify-content-center justify-content-md-center">
      
<div class="detailBox">
    <div class="titleBox">
      <label>Caja de comentarios</label>
    </div>
    <div class="actionBox">
        <ul class="commentList">
<?php
$sql = "CALL sp_showcomments('$n_id')";
 if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){
  echo '           <li>
                <div class="commenterImage">
                  <img src="data:image/jpg;base64,'.base64_encode($row['perfilv']).'">
                </div>
                <div class="commentText">
                    <p class="commentText">' . $row['textov'] . '</p> 
                    <span class="date sub-text">' . $row['autornv'] . ' , ' . $row['fechav'] . '</span>
                    <br>
                    <button type="button" class="btn btnreply"><i class="fa fa-reply fa-fw"></i>&nbsp; Responder</button>
                </div>
            </li>';
}

                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Todavá no hay comentarios</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }


        
    mysqli_next_result($link);
?>
        

         

     
        </ul>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="form-inline" role="form">
          <div class="form-group">
  <?php  echo ' <img src="data:image/jpg;base64,'.base64_encode($u_foto).'" class="previmg">';?>      
            </div>

            <div class="form-group">
            </div>

            <div class="form-group">
                <input name="coment" id="coment" pattern=".{6,}" class="form-control" type="text" placeholder="Escribe un comentario...." />
            </div>

            <div class="form-group">
            </div>

            <div class="form-group">
                <button name="publish" type="submit" class="btn btn-primary" style="background-color: #4b5e65; border-color : #4b5e65;"><i class="fa fa-comment fa-fw"></i>Publicar comentario</button>
            </div>

     <?php      echo '
<input name="commenter" id="commenter" type="hidden" value="' . $iduserx . '">

';?>
    
     <?php      echo '
<input name="noti" id="noti" type="hidden" value="' . $n_id . '">

';

?>


        </form>
    </div>
</div>

</div>


<div class="col-xs-12" style="height:50px;"></div>
<h2 style="color:  #44566c; font-size: 250%; font-weight: 500;">Noticias Relacionadas</h2>
<hr class="relatedhr" style="border:  2px solid #44566c;">

      <!-- este ultimo div es sospechoso -->
</div>

<div class="col-sm-2 fixed-side-column">
      <!-- I want this column to be fixed. -->
</div>


</div>
</div>



<div class="col-sm-12 mt-5 mb-3">
<div class="container">
  <div class="row">
    

<?php
$sql = "CALL sp_related('$n_idseccion', '$n_id')";
 if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){


echo '   <div class="col-md-4 col-sm-6 mb-4">
     <div class="card">
                <!--Card image and header-->
                <div class="card-img ">
                <!--Card image-->
                <img src="data:image/jpg;base64,'.base64_encode($row["fotov"]).'" alt="">
                <!--Card category header-->
                  <span style = "background: ' . $row['colorv'] . '"><h4 class="cardsec">' . $row['seccionv'] . '</h4></span>
                </div>
                <!--Card content-->
                <div class="card-body">
                    <!--Card date-->
                    <h6 class="h6card">' . $row['fechav'] . '</h6>
                    <!--Title-->
                    <h4 class="card-title">' . $row['titulov'] . '</h4>
                    <!--Card horizontal rule-->
                    <hr class="cardhr" style="border:  3px solid ' . $row['colorv'] . ';">
                    <!--Text-->
                    <p class="card-text">' . $row['descripcionv'] . '</p>
                    <!--Center button-->
                    <div class="row justify-content-center">';
if ($iduserx == 0){
  echo '<a href="Noticia.php?new=' . $row['idv'] . '"  style="color:  #FFFFFF; background-color: #44566c; border-color: #44566c; width: 50%; font-weight: 600; font-size: 120%;" class="btn btn-primary btn-block">Leer más...</a>';
}
else{
    echo '<a href="Noticia.php?user=' . $iduserx . '&new=' . $row['idv'] . '"  style="color:  #FFFFFF; background-color: #44566c; border-color: #44566c; width: 50%; font-weight: 600; font-size: 120%;" class="btn btn-primary btn-block">Leer más...</a>';
}
                    echo '  </div>

                </div>
            </div>
    </div>';
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


 






    
  </div>
</div>
</div>



 

	 
	 
	 
	
  </body>
</html>