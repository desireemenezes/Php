<?php
    include_once 'Produto.php';
	include_once 'PDOFactory.php';

    class ProdutoDAO
    {
        public function inserir(Produto $produto)
        {
            $qInserir = "INSERT INTO produto(nome,preco) VALUES (:nome,:preco)";            
            $pdo = PDOFactory::getConexao();
            // A classe PDO prepara o comando a ser executado
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$produto->nome);
            $comando->bindParam(":preco",$produto->preco);
            $comando->execute();
            $produto->id = $pdo->lastInsertId();
            return $produto;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from produto WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id); 
            // A classe PDO executa o comando
            $comando->execute();
        }

        public function atualizar(Produto $produto)
        {
            $qAtualizar = "UPDATE produto SET nome=:nome, preco=:preco WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$produto->nome);
            $comando->bindParam(":preco",$produto->preco);
            $comando->bindParam(":id",$produto->id);
            $comando->execute();        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM produto';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $produtos=array();	
            // Laço para exibir todas as linhas
            /** PDO::fetch. Este método nos retorna a linhas de uma consulta SQL, além disso, 
             * retorna true enquanto houver novas linhas. Isso indica que podemos 
             * utilizar o laço while para mostrar tudo o que for encontrado pelo comando que executarmos. */
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $produtos[] = new Produto($row->id,$row->nome,$row->preco);
            }
            return $produtos;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM produto WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Produto($result->id,$result->nome,$result->preco);           
        }
    }
?>