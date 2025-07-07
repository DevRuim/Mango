<?php include "header.php" ?>

<div class="container text-center" style="min-height: 80vh;  justify-content: center; align-items: center;">

<?php

    //Verifica o método de requisição do servidor
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Bloco para declaração de variáveis
        $nomeUsuario = $telefone = $emailUsuario = $senha_usuario = $confirmarSenhaUsuario = $preferencias = "";
        $erroPreenchimento = false;

        //Validação do campo nomeUsuario
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["nomeUsuario"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>NOME</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $nomeUsuario = testar_entrada($_POST["nomeUsuario"]);
            //Usa a função preg_match para verificar o padrão de caracteres
            if(!preg_match('/^[\p{L} ]+$/u', $nomeUsuario)){
                echo "<div class='alert alert-warning text-center'>
                    O <strong>NOME</strong> deve conter apenas letras!
                </div>";
                $erroPreenchimento = true;
            }
        }

        //Validação do campo telefoneUsuario
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["telefone"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>TELEFONE</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $telefone = testar_entrada($_POST["telefone"]);
        }

        //Validação do campo emailUsuario
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["emailUsuario"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>EMAIL</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $emailUsuario = testar_entrada($_POST["emailUsuario"]);
        }

        //Validação do campo senha_usuario
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["senhaUsuario"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>SENHA</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $senhaUsuario = md5(testar_entrada($_POST["senhaUsuario"]));
        }

        //Validação do campo confirmarsenha_usuario
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["confirmarSenhaUsuario"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $confirmarSenhaUsuario = md5(testar_entrada($_POST["confirmarSenhaUsuario"]));
            if($senhaUsuario != $confirmarSenhaUsuario){
                echo "<div class='alert alert-warning text-center'>
                        As <strong>SENHAS</strong> não conferem!
                    </div>";
                $erroPreenchimento = true;
            }
        }

        //Se não houver erro de preenchimento ou erro de upload
        if(!$erroPreenchimento){

            //Criar uma QUERY responsável por realizar a inserção dos dados no BD
            $inserirUsuario = "INSERT INTO Usuarios (tipoUsuario, nomeUsuario, emailUsuario, senhaUsuario, telefone)
                                VALUES ('cliente', '$nomeUsuario', '$emailUsuario', '$senhaUsuario', '$telefone') ";

            //Inclui o arquivo de conexão com o BD
            include "conexaoBD.php";

            //Se a query for executada com sucesso, exibe mensagem e tabela
            if(mysqli_query($conn, $inserirUsuario)){

                echo "<div class='alert alert-success text-center'>Usuário(a) cadastrado(a) com sucesso!</div>";
                
                echo "<div class='d-flex justify-content-center mb-1'>
                        <div class='row' style='width: 80%;'>
                            <table class='table'>
                                <tr>
                                    <th>NOME</th>
                                    <td>$nomeUsuario</td>
                                </tr>
                                <tr>
                                    <th>EMAIL</th>
                                    <td>$emailUsuario</td>
                                </tr>
                                <tr>
                                    <th>TELEFONE</th>
                                    <td>$telefone</td>
                                </tr>
                            </table>
                        </div>
                    </div>    
                ";
                mysqli_close($conn); //Encerra a conexão com o banco de dados
            }
            //Se não conseguir inserir dados do Usuário na base de dados, emite alerta danger
            else{
                echo "<div class='alert alert-danger text-center'>
                            Erro ao tentar inserir dados do <strong>Usuário</strong> na base de dados!
                        </div>";
            }
        }
    }
    else{
        //Redireciona para a página formUsuario.php
        header("location:formUsuario.php");
    }

    function testar_entrada($dado){
        $dado = trim($dado); //TRIM - Remove espaços desnecessários
        $dado = stripslashes($dado); //Remove barras invertidas
        $dado = htmlspecialchars($dado); //Converte caracteres especiais

        return($dado);
    }

?>

</div>

<?php include "footer.php" ?>