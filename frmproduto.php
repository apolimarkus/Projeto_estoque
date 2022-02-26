<?php
    require 'Controller.php';
    $p = new Controller("bdestoque", "localhost", "root", "");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <?php

        if(isset($_POST['nome_cliente']))
        {
           //Rotinas do botão Editar
            if(isset($_GET['id_up']) && !empty($_GET['id_up']))
            {
                $id_upd = $_GET['id_up'];
                $nomeCli = addslashes($_POST['nome_cliente']);
                $numOrdem = addslashes($_POST['num_ordem']);
                $email = addslashes($_POST['email']);
                $telefone = addslashes($_POST['telefone']);
                $produto = addslashes($_POST['produto']);
                $valor = addslashes($_POST['valor']);
                $situacao = addslashes($_POST['situacao']);
                $descricao = addslashes($_POST['descricao']);

                //Atualiza os dados
                if(!empty($nomeCli) && !empty($numOrdem) && !empty($email) && !empty($telefone) && !empty($produto) && !empty($valor) && !empty($situacao) && !empty($descricao))
                {
                    $p->atualizarDados($id_upd, $nomeCli, $numOrdem, $email, $telefone, $produto, $valor, $situacao, $descricao);
                    header("Location: listarConsertos.php");
                }else
                {
                    echo "Preencha todos os campos!";
                }

            
            //Rotinas para o botão Cadastrar
            }else
            {
                $nomeCli = addslashes($_POST['nome_cliente']);
                $numOrdem = addslashes($_POST['num_ordem']);
                $email = addslashes($_POST['email']);
                $telefone = addslashes($_POST['telefone']);
                $produto = addslashes($_POST['produto']);
                $valor = addslashes($_POST['valor']);
                $situacao = addslashes($_POST['situacao']);
                $descricao = addslashes($_POST['descricao']);

                //Verifica se as variáveis estão vazias
                if(!empty($nomeCli) && !empty($numOrdem) && !empty($email) && !empty($telefone) && !empty($produto) && !empty($valor) && !empty($situacao) && !empty($descricao))
                {
                    if(!$p->cadastrarProduto($nomeCli, $numOrdem, $email, $telefone, $produto, $valor, $situacao, $descricao))
                    {
                        echo "Email já está cadastrado!";

                    }

                }else
                {
                    echo "Preencha todos os campos!";
                }
            }
        }

    ?>

    <?php
        if(isset($_GET['id_up']))
        {
            $id_update = addslashes($_GET['id_up']);
            $res = $p->buscarDadosProduto($id_update);

        }
    ?>
    <div class="container">
        <h2>Preencha os campos para registrar o serviço</h2><br>
    <!--inicio Formulario-->
    <form class="row g-3" method="POST">
        <div class="col-md-8">
            <label for="inputNome" class="form-label">Nome do Cliente</label>
            <input type="text" class="form-control" name="nome_cliente" value="
            <?php if(isset($res))
                    { 
                        echo $res['nome_cliente'];
                    }
            ?>">
        </div>
        <div class="col-md-4">
            <label for="inputCodigo" class="form-label">Número de Ordem</label>
            <input type="text" class="form-control" name="num_ordem"
            value="
            <?php if(isset($res))
                    { 
                        echo $res['num_ordem'];
                    }
            ?>">

        </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" name="email"
        value="
            <?php if(isset($res))
                    { 
                        echo $res['email'];
                    }
            ?>">
    </div>
    <div class="col-md-6">
        <label for="inputTelefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" name="telefone"
        value="
            <?php if(isset($res))
                    { 
                        echo $res['telefone'];
                    }
            ?>">
     
    </div>
    <div class="col-6">
        <label for="inputProduto" class="form-label">Equipamento</label>
        <input type="text" class="form-control" name="produto"
        value="
            <?php if(isset($res))
                    { 
                        echo $res['produto'];
                    }
            ?>"
        >
    </div>
    <div class="col-3">
        <label for="inputValor" class="form-label">Valor do Conserto (R$)</label>
        <input type="text" class="form-control" name="valor"
        value="
            <?php if(isset($res))
                    { 
                        echo $res['valor'];
                    }
            ?>"
        >
    </div>
    <div class="col-3">
        <label for="inputSituacao" class="form-label">Situação Atual</label>
        <input type="text" class="form-control" name="situacao"
        value="
            <?php if(isset($res))
                    { 
                        echo $res['situacao'];
                    }
            ?>"
        >
    </div>
    <div class="col-md-12">
        <label for="inputDescricao" class="form-label">Breve descrição dos problemas relatados </label><br>
        <textarea name="descricao" id="" cols="100" rows="10"
        value="
            <?php if(isset($res))
                    { 
                        echo $res['descricao'];
                    }
            ?>"
        ></textarea>
    </div>
        
    
    <div class="col-12">
        <input type="submit" class="btn btn-primary"
        value="
            <?php if(isset($res))
                    { 
                        echo "Atualizar";
                    }else
                    {
                        echo "Cadastrar
                        ";
                    }
            ?>"
        >
    </div>
    </form>
    <!--Fim Formulario-->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
</body>
</html>