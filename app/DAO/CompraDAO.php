<?php

namespace DAO;

use Models\Compra;
use mysqli;
use Models\ProdutosComprados;

class CompraDAO {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    //lista os produtos comprado
    public function produtosComprados($compra_id) {
       
        $query = "SELECT * FROM produtos_comprados WHERE compra_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $compra_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produtosComprados = [];

        while ($produtoComprado = $result->fetch_assoc()) {
            $produtosComprados[] = new ProdutosComprados(
                $produtoComprado['compra_id'],
                $produtoComprado['produto_id']
            );
            $produtoId = new ProdutoDAO();
            $produto = $produtoId->getProdutoById($produtoComprado['produto_id']);
            $produtos[] = $produto;
        }

        $stmt->close();
        return $produtos;
    }
    //cria uma compra
    public function criarCompra(Compra $compra) {
        $query = "INSERT INTO compra (total, dia, hora, usuario_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $compra->getTotal(), $compra->getData(), $compra->getHora(), $compra->getUserId());
        $stmt->execute();
        $novoId = $stmt->insert_id; 
        $compra->setId($novoId);
        $stmt->close();
        return $compra;
    }
    //remove do carrinho
    public function removerProdutosDoCarrinho($usuario_id) {
        $query = "DELETE FROM carrinho WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    
    //adciona os produtos comprados a compra
    public function adicionarProdutosACompra($compra_id, array $produtos) {
        $query = "INSERT INTO produtos_comprados (compra_id, produto_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        foreach ($produtos as $produto_id) {
            $stmt->bind_param("ii", $compra_id, $produto_id);
            $stmt->execute();
        }

        $stmt->close();
        return true;
    }
}