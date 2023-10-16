<?php session_start();

    if(isset($_SESSION['usuario'])) {
        header('location: index.php');
    }

    $error = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $clave = hash('sha512', $clave);

        $driver = 'pgsql';
        $host = 'app-cfa38304-9db4-4d49-9f56-9e0bf9328d20-do-user-14633560-0.b.db.ondigitalocean.com';
        $port = 25060;
        $dbname = 'db' ;
        $user =  'db';
        $password = 'AVNS_TA0VT6EIUBdsgPjMiIb';
        
        try{
            //$conexion = new PDO('mysql:host=localhost;dbname=login_tuto', 'josejaime', 'admin1234');
            $connection = new PDO("$driver:host=$host;port=$port;dbname=$dbname", $user, $password);
        
        }catch(PDOException $prueba_error){
                echo "Error: " . $prueba_error->getMessage();
            }
        
        $statement = $conexion->prepare('
        SELECT * FROM login WHERE usuario = :usuario AND clave = :clave'
        );
        
        $statement->execute(array(
            ':usuario' => $usuario,
            ':clave' => $clave
        ));
            
        $resultado = $statement->fetch();
        
        if ($resultado !== false){
            $_SESSION['usuario'] = $usuario;
            header('location: principal.php');
        }else{
            $error .= '<i>Este usuario no existe</i>';
        }
    }
    
require 'frontend/login-vista.php';


?>
