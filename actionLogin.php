<?php

    include("conexaoBD.php");
    session_start(); //Iniciar uma sessão

    $emailUsuario = mysqli_real_escape_string($conn, $_POST['emailUsuario']);
    $senhaUsuario = mysqli_real_escape_string($conn, $_POST['senhaUsuario']);
    $quantidadeLogin = 0; //Inicia a variável que contabilizará a quantidade de logins equivalentes encontrados

    $buscarLogin  = "SELECT *
                     FROM Usuarios
                     WHERE emailUsuario = '{$emailUsuario}'
                     AND senhaUsuario   = md5('{$senhaUsuario}')
                    ";
    
    
    $efetuarLogin = mysqli_query($conn, $buscarLogin);

    if($registro = mysqli_fetch_assoc($efetuarLogin)){
        $quantidadeLogin = mysqli_num_rows($efetuarLogin);

        //Cria variáveis PHP para armazenar registros encontrados no BD
        $idUsuario    = $registro['idUsuario'];
        $tipoUsuario  = $registro['tipoUsuario'];
        $emailUsuario = $registro['emailUsuario'];
        $nomeUsuario  = $registro['nomeUsuario'];
        

        //Cria variáveis de SESSÃO para armazenar os registros das variáveis PHP
        $_SESSION['idUsuario']    = $idUsuario;
        $_SESSION['tipoUsuario']  = $tipoUsuario;
        $_SESSION['emailUsuario'] = $emailUsuario;
        $_SESSION['nomeUsuario']  = $nomeUsuario;



        $_SESSION['logado']       = true; //Variável de controle de sessão

        header('location:index.php?pagina=index'); //Redireciona para a página inicial
    }
    elseif(empty($_POST['emailUsuario']) || empty($_POST['senhaUsuario']) || $quantidadeLogin == 0){
        header('location:formLogin.php?pagina=formLogin&erroLogin=dadosInvalidos');
    }
    

?>