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

    //função para inserir ados no banco
    public function inserirDados($nome, $telefone, $email)
    {
        try {
            $comando = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
            $comando->bindValue(":e", $email);
            $comando->execute();

            if ($comando->rowCount() > 0) { //caso seja true, significa que o email já existe
                return false;
            } else { // aqui o email não existe, então pode ser efetuado o comando INSERT 
                $comando = $this->pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES(:n, :t, :e)");
                $comando->bindValue(":n", $nome);
                $comando->bindValue(":t", $telefone);
                $comando->bindValue(":e", $email);
                $comando->execute();
                return true;
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    //função para deletar dados do banco 
    public function  deletarDados($id)
    {
        $comando = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $comando->bindValue("id", $id);
        $comando->execute();
    }

    //funçaõ para buscar dados
    public function buscarDadosPessoa($id)
    {
        $res = array();
        $comando = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $comando->bindValue(":id", $id);
        $comando->execute();
        $res = $comando->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //funçaõ para editar dadosque vem do banco dedados
    public function editarDados($id, $nome, $telefone, $email)
    {


        $comando = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone = :t, email = :e WHERE id = :id");
        $comando->bindValue(":n", $nome);
        $comando->bindValue(":t", $telefone);
        $comando->bindValue(":e", $email);
        $comando->bindValue(":id", $id);
        $comando->execute();
    }
}
