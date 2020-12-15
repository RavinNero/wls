<?php
    require __DIR__."/vendor/autoload.php";

    require __DIR__."/app/database/Connection.php";
    require __DIR__."/app/models/User_races.php";
    require __DIR__."/app/models/User.php";

    use CoffeeCode\Router\Router;
    use App\Models\Connection;
    use App\Models\UserRace;
    use App\Models\User;

    $router = new Router( URL_BASE );

    $router->namespace("App\Controllers");

    /*  
    *UserRacesController
    *home
    */
    
    $router->group(null);
    $router->get("/", function($data){
        echo '
            <!DOCTYPE html>
            <html lang="PT-BR">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">

                    <title> Cadastro de Usuário </title>
                </head>
                <body>

                    <form method="POST" action="/register">
                        <input type="hidden" name="userID" id="userID" value="1">
                        <input type="hidden" name="status" id="status" value="OK">

                        <label>Data:</label><input type="date" name="date" id="date"><br>
                        <label>Hora:</label><input type="time" name="hour" id="hour"><br>
                        <label>Local de embarque:</label><input type="text" name="meetingPoint" id="meetingPoint"><br>
                        <label>Destino:</label><input type="text" name="destiny" id="destiny"><br>
                        <input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">
                    </form>
                </body>
            </html>
        ';
    });

    $router->get("/user_races", function($data){
        $Races = new UserRace(new Connection);
        print json_encode($Races->list());
    });

    $router->post("/register", function($data){
        $Races = new UserRace(new Connection);
        $result = $Races->create($data["userID"],
                $data["date"],
                $data["hour"],
                $data["status"],
                $data["meetingPoint"],
                $data["destiny"]
            );

        if($result){
            print json_encode(array("Msg"=> "OK"));
        }else{
            print json_encode(array("Msg"=> "ERROR"));
        }
    });
    
    $router->get("/users_and_races", function($data){
        $Races = new UserRace(new Connection);
        print json_encode($Races->listUsersRaces());
    });

    /* 
    * Errors
    */

    $router->group("ooops");
    $router->get("/{errcode}", function($data){
        echo "<h1>Erro {$data["errcode"]}</h1>";
        var_dump($data);
    });

    $router->dispatch();

    if($router->error()){
        $router->redirect("/ooops/{$router->error()}");
    }
?>