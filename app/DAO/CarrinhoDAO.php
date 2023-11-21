<?php
namespace DAO;

use Model\Carrinho;
use Models\Produto;
use mysqli;

class CarrinhoDAO {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function resetaCarrinho($user_id) {
        $query = "DELETE FROM carrinho WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    public function listProdutosCarrinho($user_id){
        $query = "SELECT * FROM carrinho WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $produtosCarrinho = [];
    
        if ($result->num_rows > 0) {
            $produtoDAO = new ProdutoDAO(); // Instancia o DAO de Produto
            
            while ($row = $result->fetch_assoc()) {
                $produto_id = $row['produto_id'];
                
                // Busca as informações do produto pelo ID
                $produto = $produtoDAO->getProdutoById($produto_id);
                
                // Adiciona o produto à lista de produtos do carrinho
                $produtosCarrinho[] = $produto;
            }
        }
        $stmt->close();
        return $produtosCarrinho;
    }
    
    public function criaCarrinho($user_id, $produto_id) {
        $query = "INSERT INTO carrinho (user_id, produto_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $produto_id);
        $stmt->execute();
        $carrinho_id = $stmt->insert_id;
        $stmt->close();
        return true; 
    }
    public function __destruct() {
        $this->conn->close();
    }
}
