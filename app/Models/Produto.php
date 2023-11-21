<?php

namespace Models;

class Produto {
    private $id;
    private $nome;
    private $valor;
    private $descricao;
    private $img;

    public function __construct($nome, $valor, $descricao, $img, $id = null) {
        $this->nome = $nome;
        $this->valor = $valor;
        $this->descricao = $descricao;
        $this->img = $img;
        $this->id = $id;
    }

    // Getters e Setters para cada atributo (id, nome, valor, descricao, img)
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
    }
}