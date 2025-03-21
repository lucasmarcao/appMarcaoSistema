<?php
// Configurações de conexão
$servername = "localhost";
$username = "root";
$password = ""; // Substitua pela senha do seu banco de dados

// $servername = "sql208.infinityfree.com";
// $servername = "https://php-myadmin.net/db_sql.php";
// $username = "if0_38565346";
// $password = "marcao2004";
// $dbname = "if0_38565346_app_marcao_sistema";

// $servername = "sql208.infinityfree.com";
// $username = "if0_38565346";
// $password = "marcao2004"; // Substitua pela senha do seu banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password);

// Verificando a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Nome do banco de dados que você deseja criar
$dbname = "app_marcao_sistema";

// SQL para criar o banco de dados
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

// Verificando se o banco de dados foi criado com sucesso
if ($conn->query($sql) === TRUE) {
    echo '<div class="centroTudo margemFacil">';
    echo "Banco de dados '$dbname' <br> criado com sucesso ou já existe.";
    echo "</div>";
} else {
    echo "Erro ao criar o banco de dados: " . $conn->error;
}

// Fechando a conexão inicial
$conn->close();
