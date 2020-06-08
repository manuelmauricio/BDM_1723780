<?php
//require('php/conexion.php');
require_once "php/conexion.php";

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	 <title>Data Dictionary</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<!-- font-awesome CSS -->
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<!-- css del proyecto -->
  <link rel="stylesheet" href="CSS files/backend.css">  
  <link rel="stylesheet" href="CSS files/tablesd.css">  
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



<nav class="navbar navbar-expand-lg"  style="background-color:  #111;">
    <ul class="navbar-nav">
    <li class="nav-item ">
      <h1 style="color:#FFFFFF">Diccionario de Datos</h1>
      </li>
    </ul>



</nav>


<div id="main">
  <h2>Diccionario de Datos del proyecto de Portal de Noticias</h2>
  <p>A continuación se presenta la descripción de los
objetos o elementos de datos que conforman el proyecto </p>

  <div class="row justify-content-center justify-content-md-center">



<div class="container">
  <div class="row">
    <div class="col-12">
    <table class="table table-striped">
      <thead>
        <tr>
        
          <th scope="col">Tabla</th>
          <th scope="col">Nombre del campo</th>
          <th scope="col">Tipo de dato</th>
          <th scope="col">Restricciones</th>
          <th scope="col">Valor default</th>
          <th scope="col">Acepta nulos</th>
          <th scope="col">Longitud de carácteres</th>
          <th scope="col">Descripción</th>
        </tr>
      </thead>
      <tbody>
   <?php
$sql = "CALL sp_datadictionary()";
 if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){      
 echo'       <tr>
          <td>' . $row['tabla'] . '</td>
          <td>' . $row['nombre'] . '</td>
          <td>' . $row['tipo_de_dato'] . '</td>
          <td>' . $row['restricciones'] . '</td>
          <td>' . $row['valor_default'] . '</td>
          <td>' . $row['acepta_nulos'] . '</td>
          <td>' . $row['longitud'] . '</td>
          <td>' . $row['descripcion'] . '</td>
        </tr>'

;
}

                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);

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