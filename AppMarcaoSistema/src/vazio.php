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

    <!-- PHP PARTE PHP -->
    <?php
    // inicio do código

    // contrutor
    class Fruit
    {
        public $name;
        public $color;

        function __construct($name, $color)
        {
            $this->name = $name;
            $this->color = $color;
        }
        function get_name()
        {
            return $this->name;
        }
        function get_color()
        {
            return $this->color;
        }
    }


    // $cars = array("Volvo", "BMW", "Toyota"); assim tbm funciona
    $cars = [
        "Volvo",
        "XXXXXXXXX",
        "Toyota"
    ];

    // inserir
    array_push($cars, "Ford ka 2004");

    // remover
    unset($cars[1]);
    // array_splice($cars, 1, 2); remove 2 itens.
    // array_pop() -> ultimo item | array_shift() -> primeiro it

    // buscar
    // $cars[2]

    // listar
    // count($cars); | tam array
    foreach ($cars as $x) {
        echo "
        <h5 class='centroTudo'>
            $x
        </h5>";
    }
    echo "<hr>";


    $apple = new Fruit("maçã", "vermelho");
    echo "<H4> . ", $apple->get_name(), " . </H4>";
    echo "<H4> . ", $apple->get_color(), " . </H4>";

    // fim do código
    ?>
    <!-- PHP PARTE PHP -->
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