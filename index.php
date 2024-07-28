<?php
require_once ("classe_pessoa.php");
$p = new Pessoa("crudpdo", "localhost", "root", "");
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
        <form action="seu_script_php.php" method="post">
            <h2>CADASTRAR PESSOAS</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <input type="submit" value="Cadastrar">
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
                    for ($i = 0; $i < count($dados); $i++) {
                        echo "<tr>";
                        foreach ($dados[$i] as $key => $value) {
                            if ($key != "id") {
                                echo "<td>" . htmlspecialchars($value) . "</td>";
                            }
                        }
                        echo '<td><a href="" class="button">Editar</a> <a href="" class="button">Excluir</a></td>';
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </section>

</body>

</html>