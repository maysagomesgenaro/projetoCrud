<?php
require 'banco.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $sexoErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = FALSE;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = FALSE;
        }

        if (!empty($_POST['endereco'])) {
            $endereco = $_POST['endereco'];
        } else {
            $enderecoErro = 'Por favor digite o seu endereço';
            $validacao = FALSE;

        }

        if(!empty($_POST['telefone'])) {
            $telefone = $_POST['telefone'];
        } else {
            $telefoneErro = 'Por favor digite o número de telefone';
            $validacao = FALSE;
        }

        if (!empty($_POST['email'])) {
            $email = $_POST ['email'];
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErro = 'Por favor digite um endereço de email válido!';
                $validacao = FALSE;
            }
        } else {
            $emailErro = 'Por favor digite um endereço de email!';
            $validacao = FALSE;
        }

        if (!empty($_POST['sexo'])) {
            $sexo = $_POST['sexo'];
        } else {
            $emailErro = 'Por favor selecione um campo!';
            $validacao = FALSE;
        }
    }

    //Inserindo no banco
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->seAttribute(PDO::ATR_ERRMODE_EXCEPTION);
        $sql = "INSERT INTO aluno (nome, endereco, telefone, email, sexo) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $sexo));
        Banco::desconectar();
        header("Location: index.php")

    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href="assets/css/bootstrap.min.css">
    <title>Adicionar Contato</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class= "card-header">
                    <h3 class="well">Adicionar Contato </h3>
</div>
<div class="card-body">
    <form class="form-horizontal" action="create.php" method="post">

    <div class="control-group <?php echo !empty($nomeErro) ? 'error' : ''; ?>">
    <label class = "control-label">Nome</label>
    <div class=" controls">
        <input size="50" class="form-control" name="nome" type="text" placeholder="Nome">
        value="<?php echo !empty($nome) ? $nome : ''; ?>">
        <?php if (!empty($nomeErro)): ?>
            <span class="text-danger"><?php echo $nomeErro; ?></spam>
            <?php endif; ?>
        </div>
        </div>

        <div class="control-group <?php echo !empty($enderecoErro) ? 'error' : ''; ?>">
        <label classs="control-label">Endereço</label>
        <div class="controls">
            <input size="80" class="form-control" name="endereco" type="text" placeholder="Endereço"
            value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
            <?php if (!empty($emailErro)) ?>
            <span class="text-danger"><?php echo $enderecoErro; ?></span>
            <?php endif; ?>
        </div>
        </div>

        <div class="control-group <?php echo !empty($telefoneErro) ? 'error' : ''; ?>">
        <label class="control-label">Telefone</label>
        <div class="controls">
            <input size="35" class="form-control" name="telefone" type="text" placeholder="Telefone">
            value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
            <?php if (!empty($telefoneErro)) : ?>
                <span class="text-danger"><?php echo $telefoneErro; ?></span>
                <?php endif; ?>
            </div>
            </div>

            <div class="control-group" <?php !empty($emailErro) ? '$emailErro' : ''; ?>">
            <label class="control-label">Email</label>
            <div class="controls">
                <input size="40" class="form-control" name="email" type="text" placeholder="Email">
                value="<?php echo !empty($email) ? $email : ''; ?>">
                <?php if (!empty($emailErro)): ?>
                    <span class="text-danger"><?php echo $emailErro; ?></span>
                    <?php endif; ?>
                </div>
                </div>

                <div class="control-group <?php !empty($sexoErro) ? 'echo($sexoErro)' : ''; ?>">
                <div class="controls">
                    <label class="control-label">Sexo</label>
                    <div class="form-check">
                    <div class="form-check-label">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo"
                        value="M" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "M" ? "checked" : null; ?>/>
                        Masculino</p>
                </div>
                <div class="form-check">
                    <p class="form-check-label">
                        <input class="form-check-input" id="sexo" name="sexo" type="radio"
                        value="F" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "F" ? "checked" : null; ?>/>
                        Feminino</p>
                </div>
                <?php if (!empty($sexoErro)): ?>
    <span class= "help-inline text-danger"><?php echo $sexoErro; ?></span>
    <?php endif; ?>
</div>
</div>
<div class="form-actions">
    <br/>
    <button type="submit" class="bnt bnt-sucess">Adicionar</button>
    <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
 
<!--Latest complied and minifiend JavaScript -->
<script src-"assert/js/bootstrap.min.js"></script>
</body>
</html>

