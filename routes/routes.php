<?php
require_once __DIR__."/../controllers/UserController.php";

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($path){
    case "/user/":
        $userController = new UserController($conn);
        if($method == 'GET'){
            if(isset($_GET['id'])){
                $userController->getUserById($_GET['id']);
            }else{
                $userController->getAllUsers();
            }
        }else if($method == 'POST'){
            $userController->createUser();
        }else{
            http_response_code(405);
            echo json_encode([
                "message"=>"Método não suportado"
            ]);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode([
            "message"=>"Rota não encontrada"
        ]);
        break;
}