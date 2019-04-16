<?php
    class PDOFactory{
        //static: criar somente uma conexão!
        private static $pdo;

        public static function getConexao() {
            // Tenta conectar
            try {
             // Cria a conexão PDO com a base de dados
            // isset() retorna true cado a variavel tenha sido iniciada
                if(!isset($pdo)){
                    $conexao = "pgsql:host=localhost;dbname=crud_produtos";
                    $usuario = "postgres";
                    $senha = "postgresql";

                    $pdo = new PDO($conexao, $usuario, $senha); 
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                    $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES,false);
                    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                }
                return $pdo;
                

            } catch (PDOException $e) {
                // Se der algo errado, mostra o erro PDO
                print('erro');
                
                // Mata o script
                die();
            }
                
        }

    }
?>