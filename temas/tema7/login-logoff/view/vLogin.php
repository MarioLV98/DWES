<?php include 'model/validacion.php'; ?>

          <div id="contenido" class="container">
         <section class="main row">
        <article id="formulario" class="col-xs-12 col-sm-4 col-md-4">
            <form action="index.php?location=login" id="formulario" method="post">

                
                    
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuario" value="<?php if(isset($_POST['enviar'])){echo $_POST['usuario'];}?>"><br />
                    <p id="err"><?php if(isset($_POST['enviar'])){echo $valida = Validacion::comprobarUsuario($_POST['usuario']);} ?></p>

                    <label for="contrasena">Contraseña:</label><br />
                    <input type="password" name="contrasena" value="<?php if(isset($_POST['enviar'])){echo $_POST['contrasena'];}?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['enviar'])){echo $valida = Validacion::comprobarPassword($_POST['usuario'],$_POST['contrasena']);}?></p>
                    
                    
                    <input class="btn btn-primary" type="submit" name="enviar" value="Iniciar sesion"/>
                    
                    <p>No tienes cuenta? <input class="btn btn-warning" type="submit" name="registro" value="Registrate"/></p>
                   
                    

                
    </form>
           
        </article>
        
        <aside class="col-xs-12 col-sm-8 col-md-8">
           
                <h3>Tecnologias utilizadas</h3>
            
               <p>-PHP</p>
                <br>
                 <p>-HTML5</p>
                <br>
                 <p>-CSS3</p>
             <br>
                 <p>-BOOSTRAP</p>
            
        </aside>
        
    </section>
        
        <div class="row">
            <div class="color1 col-xs-12 col-sm-6 col-md-6">
                <h3>Arbol de almacenamiento</h3>
                
                <img class="img-responsive" src="webroot/almacenamiento.PNG">
            </div>
                        

            <div class="col-xs-12 col-sm-6 col-md-6 ">
                <h3>Diagrama de clases</h3>
                <img class="img-responsive" src="webroot/diagramadeclases.PNG">
            </div>
            
            <div class="color1 col-xs-12 col-sm-6 col-md-6">
                <h3>Arbol de navegacion</h3>
               <img class="img-responsive" src="webroot/arbolnavegacion.PNG">
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-6">
                <h3>Catalogo de requisitos</h3>
                
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-6">
                <h3>Modelo fisico de datos</h3>
                
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-6">
                <h3>Algo mas</h3>
                
            </div>
            
        </div>

    </div>
    

