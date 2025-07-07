<?php
session_start(); //Inicia sessão

//Verifica se há sessão iniciada
if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){

    if(isset($_POST['idManga'])){

        $idUsuario   = $_SESSION['idUsuario']; //Captura o id do usuário logado (pela sessão)
        $idManga     = $_POST['idManga'];
        $quantidade  = $_POST['quantidade'];

        //Incluir o arquivo de conexão com o banco de dados
        include("conexaoBD.php");

        //Query para inserir no carrinho
        $adicionar = "INSERT INTO Carrinho (idUsuario, idManga, quantidade) VALUES('$idUsuario', '$idManga', '$quantidade')";
        mysqli_query($conn, $adicionar);

        header("Location: index.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>
<?php include("header.php"); ?>

<?php include ("footer.php") ?>