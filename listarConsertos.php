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
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <!--Inicio da Tabela-->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Nome do Cliente</th>
                
                <th scope="col">Numero de Ordem</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Produto</th>
                <th scope="col">Valor</th>
                <th scope="col">Status do Conserto</th>
                <th scope="col">Descrição</th>
                
                <th scope="col" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $dados = $p->buscarDados();
                $numDados = count($dados);

                if($numDados > 0)
                {
                    for($i=0; $i < $numDados; $i++)
                    {
                        echo "<tr>";

                        foreach($dados[$i] as $k => $v)
                        {
                            if($k != "id_produto")
                            {
                                echo "<td>" . $v . "</td>";
                            }
                        }
                    ?>

                        <td>
                            <a href="frmproduto.php?id_up=<?php echo $dados[$i]['id_produto'] ?>">Editar</a>
                            <a href="listarConsertos.php?id=<?php  echo $dados[$i]['id_produto'] ?>">Excluir</a>
                        </td>

                    <?php
                        echo "</tr>";

                    }
                }
            ?>

                               
            </tbody>
    </table>
    <!--Fim da Tabela-->
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

<?php
    if(isset($_GET['id'])){
        $id_prod = addslashes($_GET['id']);
        $p->excluirProduto($id_prod);
        header('Location: listarConsertos.php');
    }
?>
