<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
        <title>Nuevo usuario</title>
    </head>
    <body>
        <header>
            <nav style="margin-top: 2rem;">
                <a href="./">Home</a>
                <a class="current" href="./users.php">Usuarios</a>
            </nav>
        </header>


<?php
    require_once 'callAPI.php';
    require_once 'print.php';

    send_user();

    function send_user(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $permissionLevel = $_POST['permissionLevel'];

            $postData = array(
                "email"=>$_POST["email"], 
                "password"=>$_POST["password"],
                "firstName"=>$_POST["firstName"],
                "lastName"=>$_POST["lastName"],
                "permissionLevel"=>$_POST["permissionLevel"]
            );

            
            $jsonData = json_encode($postData);
            
            $url = 'http://localhost:3000/users';
            
            consoleLog($jsonData);

            $jsonResponse = call_api('POST',$url, $jsonData,'appplication/json');
            
            $response = json_decode($jsonResponse);

        }
        else{
            echo '
                <form style="margin-bottom: 2rem;" method="POST">
                    <h3>Nuevo usuario</h3>

                        <p>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required="">
                        </p>
                        <p>
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" required="">
                        </p>

                        <p>
                            <label for="firstName">Nombre</label>
                            <input type="text" id="firstName" name="firstName" required="">
                        </p>

                        <p>
                            <label for="lastName">Apellido</label>
                            <input type="text" id="lastName" name="lastName" required="">
                        </p>
                    <p>
                        <label for="permissionLevel">Nivel de permiso</label>
                        <input id="permissionLevel" name="permissionLevel" type="number"/>
                    </p>

                    <button type="submit" value="submit">Guardar</button>
                    <button type="reset">Reset</button>
                </form>
            ';
        }
    }
?>
    </body>
</html>