<?php

if (isset($_POST['volver'])){
    
  if(isset($_GET['anterior']))  {
  $regresar="Location: index.php?location=".$_GET['anterior'];
  header($regresar);
  }else{
      header('Location:index.php');
  }
}else{
    include 'view/layout.php';
    
}

