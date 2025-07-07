<?php include('header.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include("conexaoBD.php");

        $limparCarrinho = "DELETE FROM Carrinho WHERE idUsuario = $idUsuario";

        $res = mysqli_query($conn, $limparCarrinho); //Executa a query
        mysqli_close($conn);

        header("location: index.php");
    }

?>