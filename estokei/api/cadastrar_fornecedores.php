<?php
    //comunicar com o banco
    include "../config/config.php";

    //VER SE ESTAMOS NO SERVIDOR RECEBENDO UM METODO DE REQUISICAO DO TIPO POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //receber as informacoes do formulario pelo metodo post
        $nome = $_POST['nome'];
        $contato = $_POST['contato'];
        
        echo'Nome: '.$nome.'| contato '.$contato;

        //tentar realizar
        try {
            $sql = "INSERT INTO fornecedores(nome, contato) VALUE ('$nome', '$contato')";
            $inserir = $pdo->prepare($sql);
            $inserir->execute();
            echo"<br>fornecedor cadastrado com sucesso!";
            header("Location: ../index.php?page=lista_fornecedores.php") ;
            exit();
        } catch (PDOException $e) {
            echo 'erro ao cadastrar'.$e->getMessage();
        }
    }else {
        header("Location: ../index.php");
        exit();
    }





?>