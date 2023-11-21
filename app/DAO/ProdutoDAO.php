<?php 
namespace DAO;

use mysqli;
use Models\Produto;

    require_once '/xampp/htdocs/php-system-ecormerc/app/Models/Produto.php';
class ProdutoDAO {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function getProdutoById($id) {
        $query = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produto = $result->fetch_assoc();
        $stmt->close();
    
        if ($produto) {
            return new Produto(
                $produto['nome'],
                $produto['valor'],
                $produto['descricao'],
                $produto['img'],
                $produto['id']
            );
        }
    
        return null; 
    }
    
    //lsita produtos no carrinho
    public function getProdutosNoCarrinho($user_id) {
        $query = "SELECT produtos.* FROM produtos
        INNER JOIN carrinho ON produtos.id = carrinho.produto_id
        WHERE carrinho.usuario_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];

        while ($product = $result->fetch_assoc()) {
            $products[] = new Produto(
                $product['nome'],
                $product['valor'],
                $product['descricao'],
                $product['img'],
                $product['id']
            );
        }

        $stmt->close();
        return $products;
    }
    // lista produtos
    public function listProducts() {
        $allProducts = [];
        $query = "SELECT * FROM produtos";
        $result = $this->conn->query($query);

        if ($result) {
            while ($product = $result->fetch_assoc()) {
                $allProducts[] = new Produto(
                    $product['nome'],
                    $product['valor'],
                    $product['descricao'],
                    $product['img'],
                    $product['id']
                );
            }
            $result->close();
        }

        return $allProducts;
    }
    //cria produto
    public function createProduct(Produto $produto) {
        $query = "INSERT INTO produtos (nome, valor, descricao, img) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdss", $produto->getNome(), $produto->getValor(), $produto->getDescricao(), $produto->getimg());
        $stmt->execute();
        $stmt->close();
        return true;
    }
    //deleta produto
    public function deleteProduct($id) {
        $query = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function __destruct() {
        $this->conn->close();
    }
}