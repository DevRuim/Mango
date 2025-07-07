<?php include "header.php" ?>

<div class='container mt-3 mb-3'>

<?php
    include "conexaoBD.php";
    session_start();

    function testar_entrada($dado){
        $dado = trim($dado);
        $dado = stripslashes($dado);
        $dado = htmlspecialchars($dado);
        return $dado;
    }

    $erroPreenchimento = false;
    $erroUpload = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Recupera ID
        if (isset($_POST["idManga"])) {
            $idManga = $_POST["idManga"];
        } else {
            echo "<div class='alert alert-danger text-center'>Erro: ID do manga não foi recebido!</div>";
            exit;
        }

        $nomeManga = !empty($_POST["nomeManga"]) ? testar_entrada($_POST["nomeManga"]) : null;
        if(!$nomeManga){
            echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        $descricaoManga = !empty($_POST["descricaoManga"]) ? testar_entrada($_POST["descricaoManga"]) : null;
        if(!$descricaoManga){
            echo "<div class='alert alert-warning text-center'>O campo <strong>DESCRIÇÂO</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        $editora = !empty($_POST["editora"]) ? testar_entrada($_POST["editora"]) : null;
        if(!$editora){
            echo "<div class='alert alert-warning text-center'>O campo <strong>EDITORA</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        $autor = !empty($_POST["autor"]) ? testar_entrada($_POST["autor"]) : null;
        if(!$autor){
            echo "<div class='alert alert-warning text-center'>O campo <strong>AUTOR</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        } elseif(!preg_match('/^[\p{L} ]+$/u', $autor)){
            echo "<div class='alert alert-warning text-center'>O <strong>AUTOR</strong> deve conter apenas letras!</div>";
            $erroPreenchimento = true;
        }

        $volume = !empty($_POST["volume"]) ? testar_entrada($_POST["volume"]) : null;
        if(!$volume){
            echo "<div class='alert alert-warning text-center'>O campo <strong>VOLUME</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        $classificacao_etaria = !empty($_POST["classificacao_etaria"]) ? testar_entrada($_POST["classificacao_etaria"]) : null;
        if(!$classificacao_etaria){
            echo "<div class='alert alert-warning text-center'>O campo <strong>CLASSIFICAÇÃO ETÁRIA</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        $ano_publicacao = !empty($_POST["ano_publicacao"]) ? testar_entrada($_POST["ano_publicacao"]) : null;
        if(!$ano_publicacao){
            echo "<div class='alert alert-warning text-center'>O campo <strong>ANO DE PUBLICAÇÃO</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        $encadernacao = !empty($_POST["encadernacao"]) ? testar_entrada($_POST["encadernacao"]) : null;
        if(!$encadernacao){
            echo "<div class='alert alert-warning text-center'>O campo <strong>ENCADERNAÇÃO</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        $valor = !empty($_POST["valor"]) ? testar_entrada($_POST["valor"]) : null;
        if(!$valor){
            echo "<div class='alert alert-warning text-center'>O campo <strong>VALOR</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        $estoque = !empty($_POST["estoque"]) ? testar_entrada($_POST["estoque"]) : null;
        if(!$estoque){
            echo "<div class='alert alert-warning text-center'>O campo <strong>ESTOQUE</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }

        // Foto
        $diretorio = "img/";
        if (isset($_FILES["foto"]) && $_FILES["foto"]["size"] > 0) {
            $foto = $diretorio . basename($_FILES["foto"]["name"]);
            $tipoDaImagem = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

            if ($_FILES['foto']['size'] > 5000000){
                echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> não deve ultrapassar 5MB!</div>";
                $erroUpload = true;
            }

            if(!in_array($tipoDaImagem, ["jpg", "jpeg", "png", "webp"])){
                echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve ser JPG, JPEG, PNG ou WEBP!</div>";
                $erroUpload = true;
            }

            if(!$erroUpload && !move_uploaded_file($_FILES['foto']['tmp_name'], $foto)){
                echo "<div class='alert alert-warning text-center'>Erro ao mover a <strong>FOTO</strong> para o diretório!</div>";
                $erroUpload = true;
            }
        } else {
            $foto = $_POST["fotoAtual"];
        }

        // Se não houver erros
        if(!$erroPreenchimento && !$erroUpload){
            $sql = "UPDATE Mangas 
                    SET foto = '$foto', nomeManga = '$nomeManga', editora = '$editora', autor = '$autor', volume = '$volume', classificacao_etaria = '$classificacao_etaria', 
                        ano_publicacao = '$ano_publicacao', encadernacao = '$encadernacao', valor = '$valor', estoque = '$estoque', descricaoManga = '$descricaoManga'
                    WHERE idManga = '$idManga'";

            if(mysqli_query($conn, $sql)){
                echo "<div class='alert alert-success text-center'>Mangá atualizado com sucesso!</div>";
                echo "<div class='container mt-3'>
                        <div class='mt-3 text-center'>
                            <img src='$foto' style='width:150px' title='Foto de $nomeManga'>
                        </div>
                        <div class='table-responsive'>
                            <table class='table'>
                                <tr><th>NOME</th><td>$nomeManga</td></tr>
                                <tr><th>EDITORA</th><td>$editora</td></tr>
                                <tr><th>AUTOR</th><td>$autor</td></tr>
                                <tr><th>VOLUME</th><td>$volume</td></tr>
                                <tr><th>CLASSIFICAÇÃO ETÁRIA</th><td>$classificacao_etaria</td></tr>
                                <tr><th>ANO PUBLICAÇÃO</th><td>$ano_publicacao</td></tr>
                                <tr><th>ENCADERNAÇÃO</th><td>$encadernacao</td></tr>
                                <tr><th>VALOR</th><td>$valor</td></tr>
                                <tr><th>ESTOQUE</th><td>$estoque</td></tr>
                                <tr><th>DESCRIÇÂO</th><td>$descricaoManga</td></tr>
                            </table>
                        </div>
                    </div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Erro ao atualizar o mangá no banco de dados!</div>";
            }
        }
    }
    ?>

</div>

<?php include "footer.php" ?>
