<?php
    
    try{
         $conexion = new PDO('mysql:host=localhost;dbname=login_tuto', 'josejaime', 'admin1234');
    }catch(PDOException $prueba_error){
        echo "Error: " . $prueba_error->getMessage();
    }


?>