<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Latest complied and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>
<body>>
    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <h2>PRIMEIRO PROJETO PWBE - CRUD<span class="badge badge-secondary">v 1.0.0 - SENAI</span></h2>
</div>
</div>
</br>
<div class="row">
    <p>
        <a href="create.php" class="btn btn-success">Adicionar</a>
</p>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Endereço</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">Sexo</th>
            <th scope="col">Ação</th>

</th>
</thead>
<tbody>
    <?php 
    include 'banco.php';
    $pdo = Banco::conectar();
    $sql = 'SELECT' * FROM tb_aluno ORDER BY id DESC';
    
    foreach($pdo->query($sql)as $row)
    {
        echo '<tr>';
        echo '<th scope="row">'. $row['id'] . '</th>';
        echo '<td>'. $row ['nome'] . '</td>';
        echo '<td>'. $row ['endereco'] . '</td>';
        echo '<td>'. $row ['telefone'] . '</td>';
        echo '<td>'. $row ['email'] . '</td>';
        echo '<td>'. $row ['sexo'] . '</td>';
        echo '<td width-250>';
        echo '<a class= "btn btn-primary" href= "read.php?id='.$row['id'].'">Info</a>';
        echo '';
        echo '<a class= "btn btn-warning" href= "update.php?id='.$row['id'].'">Atualizar</a>';
        echo '';
        echo '<a class= "btn btn-danger" href= "delete.php?id='.$row['id'].'">Excluir</a>';
        echo '</td>';
        echo '</tr>';
    }

    Banco::desconectar();
    ?>
    </tbody>
    </table>
    </div>
    </div>
</body>
</html>