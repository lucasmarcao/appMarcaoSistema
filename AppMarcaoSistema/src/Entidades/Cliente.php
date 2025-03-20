<?php
// Cliente.php
class Cliente
{
    private $id;
    private $nome;
    private $email;
    private $nota;
    private $senha;

    // Construtor
    public function __construct($nome, $email, $nota, $senha, $id = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->nota = $nota;
        $this->senha = $senha;
    }

    // Getters e setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
}
