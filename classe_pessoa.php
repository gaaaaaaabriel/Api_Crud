<?php
class Pessoa
{
    private $pdo;
    public function __construct($dbname, $host, $user, $senha)
    {

        try {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
        } catch (PDOException $e) {
            echo "Erro com o banco de dados";
            exit();
        } catch (Exception $e) {
            echo "erro generico" . $e->getMessage();
            exit();
        }
    }
    //função para buscar dados no banco de dados e exibir na coluna da direita 
    public function buscarDados()
    {
        $res = array(); 
        $comando = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
        $res = $comando->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

}
