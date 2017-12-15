<?php
 session_start();
            if (!empty($_SESSION['usuario'])) {
                //Creamos una cookiea para la ultima conexion
                setcookie("fecha_ultima_conexion", date("j, n, Y, g:i a"), time() + 3600);
                //Si se pulsa salir, se cierra la sesion
 } else {

            header('Location:login.php');
  }
  
  if(isset($_POST['cerrar'])){
      session_destroy();
      header('Location:../indextema5.html');
  }
?>
<!DOCTYPE html>
<html>
<title>EncuestaPDO</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Gill Sans Extrabold", Helvetica, sans-serif }
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
img.imagenFooter{
    width: 100px;
    height: 50px;
}

</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Cerrar menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>Encusta<br>PDO</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Index</a> 
    <a href="encuesta.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Encuesta</a> 
    <a href="seguimiento.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Seguimiento</a> 
    <a href="verCodigo.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Codigo</a> 
    <a href="verLibreria.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Libreria Validacion</a> 
    <a href="verCreacion.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Scripts BD</a>
  </div>
</nav>


<header class="w3-container w3-top w3-hide-large w3-blue w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-blue w3-margin-right" onclick="w3_open()">☰</a>
  <span>Encuesta PDO</span>
</header>


<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<div class="w3-main" style="margin-left:340px;margin-right:40px">

  


  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>

 
  <div class="w3-container" id="services" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-blue"><b>Fucionamiento</b></h1>
    <hr style="width:50px;border:5px solid blue" class="w3-round">
    <img src="img/encuesta2.PNG" alt="Funciomamiento encuesta"/>
  </div>
  
  

 

  
  



<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><a href="https://github.com/MarioLV98/dwes.git"><img class="imagenFooter" src="../../../github.PNG"/></a>
    <a  href="http://daw-usgit.sauces.local/MLV-1718/dwes"> <img  class="imagenFooter" src="../../../gitlab.PNG"/></a>
    <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" id="formulario1" method="post">
         <input type="submit" name="cerrar" value="Cerrar sesion"/>
    </form>
    <p class="w3-right">Powered by Mario Labra Villar</p>
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

</body>
</html>
