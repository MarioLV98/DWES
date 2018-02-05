<?php

if(isset($_POST['codigo'])){//Si se ha pulsado el boton codigo nos lleva al codigo
    header('Location:index.php?location=codigo');
   
}else{//Si no incluimos el layout
    include 'view/layout.php'; 
}

