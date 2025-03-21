<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/media/imgs/mikor.jpg" type="image/x-icon">
    <title>Cursor testes</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/forms.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">PHP_Marcao</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">
                            | Main_page |
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/src/clientes.php"> Tabela Cliente </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Outras Ações
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Alterar</a></li>
                            <li><a class="dropdown-item" href="#">Exluir Item</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/">Outro Grupo <> </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/src/exemplo.php" class="nav-link"> Exemplo </a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-dark" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="centroTudo">
        <div class="margemFacil apresentado">
            <h1 class="textoPad">CRUD de Clientes : inserir</h1>
        </div>
    </div>

    <!-- PHP PARTE PHP -->
    <?php
    // INICIO DO CODIGO
    // Interface.php
    // include_once dirname(__DIR__) . '/src/Entidades/Cliente.php';
    // include_once dirname(__DIR__) . '/src/DAOs/DAOCliente.php';
    include("criarBD.php");
    include_once '../src/Entidades/Cliente.php';
    include_once '../src/DAOs/DAOCliente.php';

    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "app_marcao_sistema";

    // $servername = "sql208.infinityfree.com";
    // $username = "if0_38565346";
    // $password = "marcao2004";
    // $dbname = "if0_38565346_app_marcao_sistema";

    // $servername = "sql208.infinityfree.com";
    // $servername = "https://php-myadmin.net/db_sql.php";
    // $username = "if0_38565346";
    // $password = "marcao2004";
    // $dbname = "if0_38565346_app_marcao_sistema";

    // Criando a conexão
    try {
        //code...
        $conn = new mysqli($servername, $username, $password, $dbname);
    } catch (\Throwable $th) {
        //throw $th;
        echo " TESTE $th";
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
        echo '
        <div class="centroTudo margemFacil">
            Tabela "clientes" criada com sucesso.
        </div>
        ';
    } else {
        echo "<br> Erro ao criar a tabela: <br>" . $conn->error . "<hr>";
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
    // FIM DO CODIGO
    ?>
    <!-- PHP PARTE PHP -->

    <hr>

    <div class="container">
        <form action="../src/GUI/Interface.php" method="post" class="paiFormInsere">

            <div class="row">
                <div class="centroTudo col-12">
                    <input class="formInsere" type="text" name="nome" placeholder="Nome" minlength="3" required>
                </div>
            </div>
            <div class="row">
                <div class="centroTudo col-12">
                    <input class="formInsere" type="email" name="email" placeholder="Email" minlength="6" required>
                </div>
            </div>
            <div class="row">
                <div class="centroTudo col-12">
                    <input class="formInserePequeno" type="number" name="nota" step="0.01" placeholder="Nota" min="0" max="110" required>
                    <input class="formInserePequeno" type="password" name="senha" placeholder="Senha" minlength="6" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 centroTudo">
                    <button class="btn btn-primary botaoInsere" type="submit" name="inserir">
                        Inserir Cliente
                    </button>
                </div>
            </div>
        </form>
    </div>

    <hr>

    <!-- Listar todos os clientes -->
    <div class="centroTudo margemFacil">
        <h2>Lista de Clientes</h2>
    </div>
    <div class="centroTudo margemFacil">
        <div class="comeCOL">
            <table class="align-middle">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nota</th>
                    <th>Senha</th>
                </tr>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td class="naoQuebraPalavra"><?= $cliente->getId(); ?></td>
                        <td><?= $cliente->getNome(); ?></td>
                        <td><?= $cliente->getEmail(); ?></td>
                        <td><?= $cliente->getNota(); ?></td>
                        <td><?= $cliente->getSenha(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>


    <hr>
    <div class="centroTudo margemFacil">
        <h2>
            Editar cliente
        </h2>
    </div>
    <div class="centroTudo margemFacil">
        <div>
            <table class="align-middle">
                <tr>
                    <th>ID</th>

                    <th>Ações</th>
                </tr>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td class="naoQuebraPalavra"><?= $cliente->getId(); ?></td>
                        <td>
                            <!-- Editar e Excluir -->
                            <form action="../src/GUI/Interface.php" method="post" style="display:inline;">
                                <input class="inputTableInsere" type="hidden" name="id" value="<?= $cliente->getId(); ?>">
                                <input class="inputTableInsere" type="text" name="nome" value="<?= $cliente->getNome(); ?>" required>
                                <input class="inputTableInsere" type="email" name="email" value="<?= $cliente->getEmail(); ?>" required>
                                <input class="inputTableInsere" type="number" name="nota" step="0.01" value="<?= $cliente->getNota(); ?>" required>
                                <input class="inputTableInsere" type="text" name="senha" value="<?= $cliente->getSenha(); ?>" required>
                                <button type="submit" class="btnTableInsere btn btn-warning" name="atualizar">Atualizar</button>
                            </form>
                            <form action="../src/GUI/Interface.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $cliente->getId(); ?>">
                                <button type="submit" class=" btnTableInsere btn btn-danger" name="excluir">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>



    <!-- inicio footer -->
    <br>
    <footer class="footerMarcao" id="footerMarcao">
        <div class="centroTudo">
            Site PHP feito por Lucas Marcão.
        </div>
    </footer>

    <!-- fim do footer -->

    <!-- XxxxxxxXXXX___xxxxxxxxx  -->
    <script src="/js/main.js"></script>
    <script src="/js/http.js"></script>
    <script src="/js/style.js"></script>
    <script src="/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- ESSE NÃO POHA
     SÓ O BUNDLE (APENAS)
    <script src="/bootstrap/js/bootstrap.js"></script> -->
    <script src="/js/others/toasts.js"></script>
</body>

</html>