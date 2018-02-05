<?php

if (isset($_POST['volver'])){//Si se pulsa volver ejecuta lo siguiente
    
  if(isset($_GET['anterior']))  {//Si esta definido anterior nos lleva alli
  $regresar="Location: index.php?location=".$_GET['anterior'];
  header($regresar);
  }else{//Si no al index
      header('Location:index.php');
  }
}else{//Si no se pulsa volver incluimos la vista
    include 'view/layout.php';
    
}

