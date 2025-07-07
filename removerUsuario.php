<?php include('header.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include("conexaoBD.php");
        $idUsuario = $_POST['idUsuario'];
        $removerUsuario = "DELETE FROM Usuarios WHERE idUsuario = $idUsuario";

        $res = mysqli_query($conn, $removerUsuario); //Executa a query
        mysqli_close($conn);

        header("Location: index.php");
        exit;
    }

?>