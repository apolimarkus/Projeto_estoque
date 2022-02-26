<?php

class Controller
{
    private $conn;

    public function __construct( $dbname, $host, $user, $senha)
    {
        try {
            $this->conn = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
        } catch (PDOException $e) {
            echo "Ocorreu um erro inesperado com o servidor. Entre em contato com o administrador através do emil: admin@gmaill.com.";
        }
    }

    public function buscarDados()
    {
        $res = array();
        $sql = "SELECT * FROM tbprodutos ORDER BY nome_cliente";
        $cmd = $this->conn->query($sql);
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;

    }

    public function cadastrarProduto($nomeCli, $numOrdem, $email, $telefone, $produto, $valor, $situacao, $descricao)
    {
        $sql = "SELECT id_produto FROM tbprodutos WHERE email = :e";
        $cmd = $this->conn->prepare($sql);
        $cmd->bindValue(":e", $email);
        $cmd->execute();

        //Verifica se o email já foi cadastrado
        if($cmd->rowCount() > 0)
        {
            return false;
        }
        else
        {
            $sql = "INSERT INTO tbprodutos(nome_cliente, num_ordem, email, telefone, produto, valor, situacao, descricao)VALUES(:n, :o, :e, :t, :p, :v, :s, :d)";
            $cmd = $this->conn->prepare($sql);
            $cmd->bindValue(':n', $nomeCli);
            $cmd->bindValue(':o', $numOrdem);
            $cmd->bindValue(':e', $email);
            $cmd->bindValue(':t', $telefone);
            $cmd->bindValue(':p', $produto);
            $cmd->bindValue(':v', $valor);
            $cmd->bindValue(':s', $situacao);
            $cmd->bindValue(':d', $descricao);
            $cmd->execute();
            return true;

        }
    }

    //Função que exclui um registro do banco de dados
    public function excluirProduto($id)
    {
            $sql = "DELETE FROM tbprodutos WHERE id_produto = :id";
            $cmd = $this->conn->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
    }

    public function buscarDadosProduto($id)
    {
        $res = array();
        $sql = "SELECT *FROM tbprodutos WHERE id_produto = :id";
        $cmd = $this->conn->prepare($sql);
        $cmd->bindValue(':id', $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;

    }

    public function atualizarDados($id, $nomeCli, $numOrdem, $email, $telefone, $produto, $valor, $situacao, $descricao)
    {
        $sql = "UPDATE tbprodutos SET nome_cliente = :n, num_ordem = :o, email = :e, telefone = :t, produto = :p, valor = :v, situacao = :s, descricao = :d WHERE id_produto = :id";
        $cmd = $this->conn->prepare($sql);
            $cmd->bindValue(':n', $nomeCli);
            $cmd->bindValue(':o', $numOrdem);
            $cmd->bindValue(':e', $email);
            $cmd->bindValue(':t', $telefone);
            $cmd->bindValue(':p', $produto);
            $cmd->bindValue(':v', $valor);
            $cmd->bindValue(':s', $situacao);
            $cmd->bindValue(':d', $descricao);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
        

    }
}