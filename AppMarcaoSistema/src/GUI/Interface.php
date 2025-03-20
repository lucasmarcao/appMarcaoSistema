<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Clientes</title>
</head>

<body>
    <h1>CRUD de Clientes 2</h1>

    <!-- // inicio php -->
    <?php
    // Interface.php
    // include_once dirname(__DIR__) . '/src/Entidades/Cliente.php';
    // include_once dirname(__DIR__) . '/src/DAOs/DAOCliente.php';
    include_once '../criarBD.php';
    include_once '../Entidades/Cliente.php';
    include_once '../DAOs/DAOCliente.php';

    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "app_marcao_sistema";

    // Criando a conexão
    try {
        //code...
        $conn = new mysqli($servername, $username, $password, $dbname);
    } catch (\Throwable $th) {
        //throw $th;
        echo " aaaaaa4545 $th";
    }

    // Verificando a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL para criar a tabela "clientes"
    $sql = "CREATE TABLE IF NOT EXISTS clientes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    nota FLOAT NOT NULL,
    senha VARCHAR(255) NOT NULL
    )";

    // Verificando se a tabela foi criada com sucesso
    if ($conn->query($sql) === TRUE) {
        echo "Tabela 'clientes' criada com sucesso.<br>";
    } else {
        echo "Erro ao criar a tabela: " . $conn->error;
    }


    $dao = new DAOCliente($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['inserir'])) {
            // Inserir
            $cliente = new Cliente($_POST['nome'], $_POST['email'], $_POST['nota'], $_POST['senha']);
            $dao->inserir($cliente);
        } elseif (isset($_POST['atualizar'])) {
            // Atualizar
            $cliente = new Cliente($_POST['nome'], $_POST['email'], $_POST['nota'], $_POST['senha'], $_POST['id']);
            $dao->atualizar($cliente);
        } elseif (isset($_POST['excluir'])) {
            // Excluir
            $dao->excluir($_POST['id']);
        }
    }

    $clientes = $dao->buscarTodos();

    if (isset($_POST['inserir']) or isset($_POST['atualizar']) or isset($_POST['excluir'])) {
        // Se o campo não foi preenchido corretamente, 
        // redireciona o usuário de volta para o formulário
        header("Location: /src/clientes.php");
        exit(); // Encerra o script após o redirecionamento
    }

    ?>
    <!-- fim php -->

    <!-- Formulário de inserção -->
    <h2>Adicionar Cliente</h2>
    <form action="Interface.php" method="post">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="number" name="nota" step="0.01" placeholder="Nota" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit" name="inserir">Inserir Cliente</button>
    </form>

    <hr>

    <!-- Listar todos os clientes -->
    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Nota</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente->getId(); ?></td>
                <td><?= $cliente->getNome(); ?></td>
                <td><?= $cliente->getEmail(); ?></td>
                <td><?= $cliente->getNota(); ?></td>
                <td>
                    <!-- Editar e Excluir -->
                    <form action="Interface.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $cliente->getId(); ?>">
                        <input type="text" name="nome" value="<?= $cliente->getNome(); ?>" required>
                        <input type="email" name="email" value="<?= $cliente->getEmail(); ?>" required>
                        <input type="number" name="nota" step="0.01" value="<?= $cliente->getNota(); ?>" required>
                        <input type="text" name="senha" value="<?= $cliente->getSenha(); ?>" required>
                        <button type="submit" name="atualizar">Atualizar</button>
                    </form>
                    <form action="Interface.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $cliente->getId(); ?>">
                        <button type="submit" name="excluir">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>