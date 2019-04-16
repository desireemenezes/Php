<?php
	include_once 'Produto.php';
	include_once 'ProdutoDAO.php';
	
	if (version_compare(phpversion(), '7.1', '>=')) {
    	ini_set( 'serialize_precision', -1 );
	}
	

	$request_method=$_SERVER["REQUEST_METHOD"];
	switch($request_method)
	{
		case 'GET':
			// Se tem id, busca o produto por id
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);

				$dao= new ProdutoDAO;		
				$produto = $dao->buscarPorId($id);
				
				$produto_json = json_encode($produto);
				header('Content-Type:application/json');
				echo($produto_json);
			}
			//senão, retorna todos os produtos
			else
			{
				$dao= new ProdutoDAO;
				$produtos =  $dao->listar();	

				$produto_json = json_encode($produtos);
				header('Content-Type:application/json');
				echo($produto_json);			
			}
			break;
			
		case 'POST':
			$data = file_get_contents("php://input");
			$var = json_decode($data);
			$produto = new Produto(0, $var->nome, $var->preco);
			
			$dao= new ProdutoDAO;
			$produto = $dao->inserir($produto);

			$produto_json = json_encode($produto);
			header('HTTP/1.1 201 Created');
			header('Content-Type:application/json');
			echo($produto_json);
			break;

		case 'PUT':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$data = file_get_contents("php://input");
				$var = json_decode($data);
				$produto = new Produto($id, $var->nome, $var->preco);

				$dao= new ProdutoDAO;
				$dao->atualizar($produto);
				
				$produto_json = json_encode($produto);
				header('Content-Type:application/json');
				echo($produto_json);				
			}
			break;
			
		case 'DELETE':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);

				$dao= new ProdutoDAO;
				$produto = $dao->buscarPorId($id);
				$dao->deletar($id);				
				
				$produto_json = json_encode($produto);
				header('Content-Type:application/json');
				echo($produto_json);
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
 
?>