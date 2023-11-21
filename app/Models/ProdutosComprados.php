<?php 
namespace Models;

class ProdutosComprados {
    private $compra_id;
    private $produto_id;

    public function __construct($compra_id, $produto_id) {
        $this->compra_id = $compra_id;
        $this->produto_id = $produto_id;
    }
    public function getCompraId() {
        return $this->compra_id;
    }

    public function setCompraId($compra_id) {
        $this->compra_id = $compra_id;
    }

    public function getProdutoId() {
        return $this->produto_id;
    }

    public function setProdutoId($produto_id) {
        $this->produto_id = $produto_id;
    }
}
