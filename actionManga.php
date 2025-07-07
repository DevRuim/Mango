<?php include "header.php" ?>

<div class='container mt-3 mb-3'>

<?php

    //Verifica o método de requisição do servidor
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Bloco para declaração de variáveis
        $foto = $nomeManga = $editora = $autor = $volume = $classificacao_etaria = $ano_publicacao = $encadernacao = $valor = $estoque = $descricaoManga = "";
        $erroPreenchimento = false;
       
        //Início da validação do campo foto
        $diretorio    = "img/"; //Define para qual diretório do sistema as imagens serão movidas
        $foto  = $diretorio . basename($_FILES["foto"]["name"]); //img/nomeDaFoto
        $erroUpload   = false; //Variável para verificar erros no upload
        $tipoDaImagem = strtolower(pathinfo($foto, PATHINFO_EXTENSION));//Converter para minúsculo e adquirir a extensão do arquivo

        //Verificar se tamanho do arquivo é maior do que zero
        if ($_FILES['foto']['size'] != 0){

            //Verificar se o tamanho do arquivo é maior do que 5MB (Em bytes)
            if($_FILES['foto']['size'] > 5000000){
                echo "<div class='alert alert-warning text-center'>
                        A <strong>FOTO</strong> não deve possuir mais do que 5MB!
                    </div>";
                $erroUpload = true;
            }

            //Verificar o tipo do arquivo (pela extensão)
            if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                echo "<div class='alert alert-warning text-center'>
                    A <strong>FOTO</strong> deve estar no formato JPG, JPEG, PNG ou WEBP!
                </div>";
                $erroUpload = true;
            }

            //Verifica se houve algum erro no upload
            if($erroUpload){
                echo "<div class='alert alert-warning text-center'>
                    Erro ao tentar fazer o upload da <strong>FOTO</strong>!
                </div>";
                $erroUpload = true;
            }
            else{
                //Usa a função move_uploaded_file para mover o arquivo para o diretório img
                if(!move_uploaded_file($_FILES['foto']['tmp_name'], $foto)){
                    echo "<div class='alert alert-warning text-center'>
                        Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!
                    </div>";
                $erroUpload = true;
                }
            }

        }

        //Validação do campo nomeManga
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["nomeManga"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>NOME</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $nomeManga = testar_entrada($_POST["nomeManga"]);
        }

        //Validação do campo nomeManga
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["descricaoManga"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>DESCRIÇÃO MANGÁ</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $descricaoManga = testar_entrada($_POST["descricaoManga"]);
        }

        //Validação do campo editora
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["editora"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>EDITORA</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $editora = testar_entrada($_POST["editora"]);
        }
        
        //Validação do campo autor
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["autor"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>AUTOR</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $autor = testar_entrada($_POST["autor"]);
        }

        //Validação do campo volume
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["volume"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>VOLUME</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $volume = testar_entrada($_POST["volume"]);
        }

        //Validação do campo classificacao_etaria
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["classificacao_etaria"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>CLASSIFICAÇÃO ETÁRIA</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $classificacao_etaria = testar_entrada($_POST["classificacao_etaria"]);
        }

        //Validação do campo ano_publicacao
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["ano_publicacao"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>ANO DE PUBLICAÇÃO</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $ano_publicacao = testar_entrada($_POST["ano_publicacao"]);
        }

        //Validação do campo encadernacao
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["encadernacao"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>ENCADERNAÇÃO</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $encadernacao = testar_entrada($_POST["encadernacao"]);
            if(!preg_match('/^[\p{L} ]+$/u', $encadernacao)){
                echo "<div class='alert alert-warning text-center'>
                    O <strong>NOME</strong> deve conter apenas letras!
                </div>";
                $erroPreenchimento = true;
            }
        }

        //Validação do campo valor
        //Utiliza a função empty para verificar se o campo está vazio
        if(empty($_POST["valor"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>VALOR</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $valor = testar_entrada($_POST["valor"]);
        }

        if(empty($_POST["estoque"])){
            echo "<div class='alert alert-warning text-center'>
                    O campo <strong>ESTOQUE</strong> é obrigatório!
                </div>
            ";
            $erroPreenchimento = true;
        }
        else{
            //Armazena o valor na variável
            $estoque = testar_entrada($_POST["estoque"]);
        }


        //Se não houver erro de preenchimento ou erro de upload
        if(!$erroPreenchimento && !$erroUpload){

            //Criar uma QUERY responsável por realizar a inserção dos dados no BD
            $inserirManga= "INSERT INTO Mangas (foto, nomeManga, editora, autor, volume, classificacao_etaria, ano_publicacao, encadernacao, disponivel, valor, estoque, descricaoManga)
                                VALUES ('$foto', '$nomeManga', '$editora', '$autor', '$volume', '$classificacao_etaria', '$ano_publicacao', '$encadernacao', '1', '$valor', '$estoque', '$descricaoManga') ";

            //Inclui o arquivo de conexão com o BD
            include "conexaoBD.php";

            //Se a query for executada com sucesso, exibe mensagem e tabela
            if(mysqli_query($conn, $inserirManga)){

                echo "<div class='alert alert-success text-center'>Manga(a) cadastrado(a) com sucesso!</div>";
                
                echo "<div class='container mt-3'>
                        <div class='mt-3 text-center'>
                            <img src='$foto' style='width:150px' title='Foto de $nomeManga'>
                        </div>
                        <div class='table-responsive'>
                            <table class='table'>
                                <tr>
                                    <th>NOME</th>
                                    <td>$nomeManga</td>
                                </tr>
                                <tr>
                                    <th>DESCRIÇÃO PRODUTO</th>
                                    <td>$descricaoManga</td>
                                </tr>
                                <tr>
                                    <th>VALOR</th>
                                    <td>$valor</td>
                                </tr>
                                <tr>
                                    <th>VOLUME</th>
                                    <td>$volume</td>
                                </tr>
                                <tr>
                                    <th>AUTOR</th>
                                    <td>$autor</td>
                                </tr>
                                <tr>
                                    <th>EDITORA</th>
                                    <td>$editora</td>
                                </tr>
                                <tr>
                                    <th>CLASSIFICAÇÂO</th>
                                    <td>$classificacao_etaria</td>
                                </tr>
                                <tr>
                                    <th>ANO PUBLICAÇÂO</th>
                                    <td>$ano_publicacao</td>
                                </tr>
                                <tr>
                                    <th>ENCADERNCACAO</th>
                                    <td>$encadernacao</td>
                                </tr>
                                <tr>
                                    <th>ESTOQUE</th>
                                    <td>$estoque</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                
                ";
                mysqli_close($conn); //Encerra a conexão com o banco de dados
            }
            //Se não conseguir inserir dados do Manga na base de dados, emite alerta danger
            else{
                echo "<div class='alert alert-danger text-center'>
                            Erro ao tentar inserir dados do <strong>Manga</strong> na base de dados!
                        </div>";
            }
        }
    }
    else{
        //Redireciona para a página formUsuario.php
        header("location:formManga.php");
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