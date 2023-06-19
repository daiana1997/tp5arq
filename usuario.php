<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link href='https://css.gg/css' rel='stylesheet'>
    <title>Usuarios</title>
</head>
<body>

<header>
    <nav style="margin-top: 2rem; margin-bottom: 2rem;">
        <a href="./">Home</a>
        <a class="current" href="./usuario.php">Usuarios</a>    
    </nav>
</header>

<div style="display:flex; justify-content:space-between; align-items: center;">
    <h4>Usuarios</h4>

    <a class="button" style="width: 10rem;  text-align: center;" href="./newUsuario.php">Nuevo usuario</a>
</div>

<?php 
    require_once 'callAPI.php';
    require_once 'print.php';

    $url = "http://localhost:3000/users";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        
        $urlDelete = $url."/".$id;

        consoleLog("'".$urlDelete."'");

        call_api('DELETE',$urlDelete,false,false,false);
        $userObject = json_decode($result);

        consoleLog($userObject);
    }
    // else{
        $result = call_api("GET",$url,false,false,false);
        $userObject = json_decode($result);
    
        render_table($userObject);
    // }

    
    function render_table($userData){
        echo '        
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Permission Level</th>
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
            <tbody>';

            foreach($userData as $user){
                echo '
                <tr>'.
                    '<td>'.$user->id.'</td>'.
                    '<td>'.$user->email.'</td>'.
                    '<td>'.$user->firstName.'</td>'.
                    '<td>'.$user->lastName.'</td>'.
                    '<td>'.$user->permissionLevel.'</td>'.
                    '<td><form method="POST">'.
                            '<div hidden>'.
                                '<input hidden="true" type="text" name="id" value="'.$user->id.'"/>'.
                            '</div>'.
                            '<button class="button" type="submit" value="submit"><i class="gg-trash"></i></button>'.
                            '</form>'.
                    '</td>'.
                    '<td><form action="./editUser.php" method="GET">'.
                            '<div hidden>'.
                                '<input type="text" name="id" value="'.$user->id.'"/>'.
                            '</div>'.
                                '<button class="button" style="padding-top: 1rem; padding-bottom: 1rem;" type="submit" value="submit" >
                                    <i class="gg-pen">
                                    </i>
                                </button>'.
                            '</form>'.
                    '</td>'.
                '</tr>';
            }
                echo '
                    </tbody>
                    </table>
                ';
    }
?>

    </body>
</html>