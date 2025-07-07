<?php include('header.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include("conexaoBD.php");

        $idUsuario = $_POST['idUsuario'];
        $idManga = $_POST['idManga'];

        $removerItem = "DELETE FROM Carrinho WHERE idUsuario = $idUsuario AND idManga = $idManga";
        
        $res = mysqli_query($conn, $removerItem); //Executa a query
        mysqli_close($conn);

        header("location: index.php");
    }

?>