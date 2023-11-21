<?php

namespace DAO;
use Models\Compra;
use Models\Usuario;
use mysqli;

require_once '/xampp/htdocs/php-system-ecormerc/app/config.php';
require_once '/xampp/htdocs/php-system-ecormerc/app/Models/Usuario.php';
require_once '/xampp/htdocs/php-system-ecormerc/app/Models/Compra.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    // Criação de um novo usuário
    public function createUser($nome, $email, $senha) {
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $nome, $email, $senha);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    // Deleta um usuário pelo ID
    public function deleteUserById($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    // Lista todos os usuários
    public function getAllUsers() {
        $allUsers = [];
        $query = "SELECT * FROM usuarios";
        $result = $this->conn->query($query);
        if ($result) {
            while ($userData = $result->fetch_assoc()) {
                $allUsers[] = new Usuario(
                    $userData['id'],
                    $userData['nome'],
                    $userData['email'],
                    $userData['senha']
                );
            }
            $result->close();
        }
        return $allUsers;
    }
    //BUSCA O USUARIO
    public function addProductToCart($user_id, $product_id) {
        $query = "INSERT INTO carrinho (usuario_id, produto_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    // Remove um produto do carrinho de um usuário
    public function removeProductFromCart($user_id, $product_id) {
        $query = "DELETE FROM carrinho WHERE usuario_id = ? AND produto_id = ? ORDER BY id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
   public function getHistoricoComprasUsuario($user_id) {
    $historicoCompras = [];

    $query = "SELECT * FROM compra WHERE usuario_id = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($compraData = $result->fetch_assoc()) {
        $compra = new Compra(
            $compraData['total'],
            $compraData['dia'],
            $compraData['hora'],
            $compraData['usuario_id'],
            $compraData['id']
        );

        $historicoCompras[] = $compra;
    }

    $stmt->close();
    return $historicoCompras;
}
//autentucação do usuario
public function autenticaUsuario($email, $senha){
    $query = "SELECT id, nome, email, senha FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usuario = new Usuario($row['nome'], $row['email'], $row['senha'],$row['id']);
        $stmt->close();
        return $usuario;
    } else {
        $stmt->close();
        return null;
    }
}
    //DELETE
    public function __destruct() {
        $this->conn->close();
    }
}

