<?php
require_once __DIR__."/../models/UserModel.php";

class UserController
{
    private $userModel;

    public function __construct($conn)
    {
        $this->userModel = new UserModel($conn);
    }

    public function getAllUsers() {
        $users = $this->userModel->getAll();
        if(count($users) > 0){
            http_response_code(200);
            echo json_encode($users);
        }else{
            http_response_code(404);
            echo json_encode([
                "message"=>"Ainda não há usuário cadastrado"
            ]);
        }        
    }

    public function getUserById($id){
        $user = $this->userModel->getById($id);
        if($user){
            http_response_code(200);
            echo json_encode($user);
        }else{
            http_response_code(404);
            echo json_encode([
                "message"=>"Usuário não encontrado"
            ]);
        }
    }

    public function createUser(){
        $data = json_decode(file_get_contents("php://input"), true);
        $nome = $data['nome'] ? $data['nome'] : null;
        $email = $data['email'] ? $data['email'] : null;
        $senha = $data['senha'] ? md5($data['senha']) : null;
        $celular = $data['celular'] ? $data['celular'] : null;

        if($this->userModel->create($nome, $email, $senha, $celular)){
            http_response_code(201);
            echo json_encode([
                "message" => "Cadastro realizado com sucesso"
            ]);
        }else{
            http_response_code(400);
            echo json_encode([
                "message"=>"Falha ao realizar o cadastro"
            ]);
        }
    }
}