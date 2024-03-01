<?php

require 'banco.php';

$id = null;

if(!empty($_GET['id'])){

    $id = $_REQUEST['id'];
}
if (null == $id){

    header("Location : index.php");
}

if (!empty($_POST)){
    $nomeErro = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null ;
    $sexoErro = null  ;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];

    //validar
    $validacao = true ;
    if(empty($nome)){
        $nomeErro = 'Por favor, digite seu nome ';
        $validacao = false;
    }
    if (empty($email)){
        $emailErro ='Por favor digite seu email';
        $validacao = false;
    }else if (!filter_var($email, FILTER_VALIDADE_EMAIL)){
        $emailErro = ' Favor digitar um email válido ';
        $validacao = false;
    }
    if (empty($endereco)){
        $enderecoErro = 'Favor digitar o endereco';
        $validacao = false;
    }
    if (empty($telefone)){
        $enderecoErro = 'Favor digitar o telefone';
        $validacao = false;
    }
    if (empty($sexo)){
        $enderecoErro = 'Preencha esse campo !';
        $validacao = false;
    }
    // update
    
    if($validacao){
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'UPDATE tb_aluno set nome = ? , endereco=?, telefone=?, email = ? , sexo = ? WHERE id = ?';
        $q = $pdo->prepare($sql);
        $q->executive(array($nome , $endereco , $telefone , $email , $sexo , $id ));
        Banco::desconectar();
        header("Location:index.php")
    }


}else {

    $pdo = Banco::desconectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT *FROM tb_aluno where id =?";
    $q ->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $nome = $data['endereco'];
    $nome = $data['telefone'];
    $nome = $data['email'];
    $nome = $data['sexo'];
   Banco::desconectar();
}
?>