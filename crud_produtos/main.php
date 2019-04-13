<?php

include_once('classeProduto.php'); // sera incluido apenas uma vezsad

$produtos = []; //declara variavel produtos vazia

function inserirProduto(Produto $produto){ // variavle produto recebe a classe com seus atributos
    array_push($GLOBALS['produtos'],$produto);
}

function buscarProdutoPorId($idProduto) {
    foreach($GLOBALS['produtos'] as $el){
        if($el->$idProduto == $idProduto) 
            return $el;
        
    }
    return null;
}

function deletarProdutos($id) {
    foreach($GLOBALS['produtos'] as $i => $produto){
        if($produto->$id === $id) 
           array_splice($GLOBALS['produtos'],$i,1);
        
    }
}

function atualizarProduto($id,Produto $idAlterado){ //produto recebe id alterado
    foreach($GLOBALS['produtos'] as $i => $produto){
        if($produto->$id === $id) {
            $produto->nome = $idAlterado->nome;
            $produto->preco = $idAlterado->preco;
        }
    }
}

function listarProdutos(){
    return $GLOBALS['produtos'];
}

inserirProduto(new Produto(1, "mesa", 539.5));
inserirProduto(new Produto(2, "mesa", 539.5));
inserirProduto(new Produto(3, "mesa", 539.5));

print_r(buscarProdutoPorId(3));
print("\n");
deletarProdutos(2);


$produto = buscarProdutoPorId(3);
$produto->nome = "cadeira";
atualizarProduto(3,$produto);
print_r(listarProdutos());
print("\n");

?>