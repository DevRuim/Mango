<?php include('header.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include("conexaoBD.php");
        $idManga = $_POST['idManga'];
        $removerManga = "DELETE FROM Mangas WHERE idManga = $idManga";

        $res = mysqli_query($conn, $removerManga); //Executa a query
        mysqli_close($conn);

        header("location: index.php");
    }

?>