<?php
class UserModel
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function getAll()
    {
        $query = "SELECT * FROM php_demo.users";
        $result = $this->conn->query($query);

        $users = [];
        while($row = $result->fetch_assoc()){
            $users[] = $row;
        }

        return $users;
    }

    public function getById($id){
        $query = "SELECT * FROM php_demo.users WHERE u_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($nome, $email, $senha, $celular) {
        $query = "INSERT INTO php_demo.users (u_nome, u_email, u_senha, u_celular) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $nome, $email, $senha, $celular);
        return $stmt->execute();
    }
}