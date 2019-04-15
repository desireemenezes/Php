<?php

    class Produto {
    /* atributos public da classse  */
        public $id;         
        public $nome;
        public $preco;

    /* método construtor */
        public function __construct($id, $nome, $preco) {
            $this->$id = $id;
            $this->$nome = $nome;
            $this->$preco = $preco;
        }


    }




?>