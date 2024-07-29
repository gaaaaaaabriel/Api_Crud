<?php
require_once("classe_pessoa.php");
$p = new Pessoa("crudpdo", "localhost", "root", "");

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);

    if (!empty($nome) && !empty($telefone) && !empty($email)) {
        if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
            // Atualizar dados
            $id_update = addslashes($_GET['id_up']);
            $p->editarDados($id_update, $nome, $telefone, $email);
            header("Location: index.php");
            exit();
        } else {
            // Cadastrar dados
            if (!$p->inserirDados($nome, $telefone, $email)) {
?>
                <div class='aviso'>
                    <img src="pngwing.com.png">
                    <h4>
                        Email já cadastrado.
                    </h4>
                </div>
        <?php

            } else {
                header("Location: index.php");
                exit();
            }
        }
    } else {
        ?>
        <div class='aviso'>
            <img src="pngwing.com.png">
            <h4>
                Preencha todos os campos.

            </h4>
        </div>
<?php
    }
}

// Buscar dados para edição
$res = null;
if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
    $id_update = addslashes($_GET['id_up']);
    $res = $p->buscarDadosPessoa($id_update);
}

// Excluir registro
if (isset($_GET['id'])) {
    $id_pessoa = addslashes($_GET['id']);
    $p->deletarDados($id_pessoa);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de pessoas</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <section id="direita">
        <form method="POST">
            <h2><?php echo isset($id_update) ? "ATUALIZAR PESSOA" : "CADASTRAR PESSOAS"; ?></h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php if (isset($res)) {
                                                                echo htmlspecialchars($res['nome']);
                                                            } ?>" required>
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="<?php if (isset($res)) {
                                                                        echo htmlspecialchars($res['telefone']);
                                                                    } ?>" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php if (isset($res)) {
                                                                    echo htmlspecialchars($res['email']);
                                                                } ?>" required>
            <input type="submit" value="<?php echo isset($id_update) ? "Atualizar" : "Cadastrar"; ?>">
        </form>
    </section>

    <section id="esquerda">
        <table>
            <thead>
                <tr id="titulo">
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th colspan="2">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dados = $p->buscarDados();
                if (count($dados) > 0) {
                    foreach ($dados as $item) {
                        echo "<tr>";
                        foreach ($item as $key => $value) {
                            if ($key != "id") {
                                echo "<td>" . htmlspecialchars($value) . "</td>";
                            }
                        }
                ?>
                        <td>
                            <a href="index.php?id_up=<?php echo $item['id']; ?>" class="button">Editar</a>
                            <a href="index.php?id=<?php echo $item['id']; ?>" class="button">Excluir</a>
                        </td>
                <?php
                        echo "</tr>";
                    }
                } else {
                    echo "<div class='aviso'>
                    <h4>Não há pessoas cadastradas</h4>
                  </div>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>

</html>