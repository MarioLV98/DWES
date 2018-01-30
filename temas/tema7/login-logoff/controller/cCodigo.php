<?php

if(isset($_POST['codigo'])){
    header('Location:index.php?location=codigo');
   
}else{
    include 'view/layout.php'; 
}

