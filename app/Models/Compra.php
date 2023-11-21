<?php

namespace Models;

class Compra {
    private $id;
    private $total;
    private $data;
    private $hora; // Adicionando o horário da compra
    private $user_id;
    private $produtosComprados = []; // Array de produtos comprados na compra

    public function __construct($total, $user_id, $id = null) {
        date_default_timezone_set('America/Sao_Paulo');
        $this->total = $total;
        $this->data = date('Y-m-d');
        $this->hora = date('H:i:s');; 
        $this->user_id = $user_id;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function gethora() {
        return $this->hora;
    }

    public function sethora($hora) {
        $this->hora = $hora;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getProdutosComprados() {
        return $this->produtosComprados;
    }

    public function setProdutosComprados($produtosComprados) {
        $this->produtosComprados = $produtosComprados;
    }

    public function addProdutoComprado($produto_id) {
        $this->produtosComprados[] = $produto_id;
    }
}
