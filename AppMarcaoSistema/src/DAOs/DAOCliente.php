<?php
// DAOCliente.php
class DAOCliente
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Método para inserir um novo cliente
    public function inserir(Cliente $cliente)
    {
        $stmt = $this->conn->prepare("INSERT INTO clientes (nome, email, nota, senha) VALUES (?, ?, ?, ?)");

        /*
        O que significa "ssds" no contexto de bind_param?

        A string "ssds" é uma sequência de caracteres que 
        indica os tipos de dados que os parâmetros da consulta vão ter. 
        Cada caractere dessa string especifica o tipo 
        de dado para o parâmetro correspondente.

        Aqui está o que cada letra significa:
        | s: string - O valor que será passado é uma string (texto). 
        No caso, são os valores obtidos por $cliente->getNome() e $cliente->getEmail().
        | s: string - O segundo parâmetro também é uma string (texto). 
        No caso, é o valor obtido por $cliente->getEmail().
        | d: double (número com ponto flutuante) - 
        O valor que será passado é um número decimal. O valor obtido por $cliente->getNota() é um float, que é equivalente ao tipo double na função bind_param.
        | s: string - O valor é uma string. No caso, é o valor 
        obtido por $cliente->getSenha(). Mesmo sendo uma senha, ela é tratada como uma string.
        */

        $nome = $cliente->getNome();
        $email = $cliente->getEmail();
        $nota = $cliente->getNota();
        $senha = $cliente->getSenha();

        $stmt->bind_param("ssds", $nome, $email, $nota, $senha);
        $stmt->execute();
    }

    // Método para atualizar um cliente
    public function atualizar(Cliente $cliente)
    {
        $id = $cliente->getId();
        $nome = $cliente->getNome();
        $email = $cliente->getEmail();
        $nota = $cliente->getNota();
        $senha = $cliente->getSenha();

        $stmt = $this->conn->prepare("UPDATE clientes SET nome = ?, email = ?, nota = ?, senha = ? WHERE id = ?");
        $stmt->bind_param("ssdsd", $nome, $email, $nota, $senha, $id);
        $stmt->execute();
    }

    // Método para excluir um cliente
    public function excluir($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->bind_param("d", $id);
        $stmt->execute();
    }

    // Método para buscar todos os clientes
    public function buscarTodos()
    {
        $result = $this->conn->query("SELECT * FROM clientes");
        $clientes = [];
        while ($row = $result->fetch_assoc()) {
            $clientes[] = new Cliente($row['nome'], $row['email'], $row['nota'], $row['senha'], $row['id']);
        }
        return $clientes;
    }

    // Método para buscar um cliente por ID
    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return new Cliente($row['nome'], $row['email'], $row['nota'], $row['senha'], $row['id']);
        }
        return null;
    }
}
