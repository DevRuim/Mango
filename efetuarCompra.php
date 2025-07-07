<?php include ("header.php");
    session_start();

    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {

        if (isset($_POST['idManga']) && is_array($_POST['idManga'])) {

            include("conexaoBD.php");

            $idUsuario  = $_SESSION['idUsuario'];
            $dataPedido = date('Y-m-d');
            $todosOk    = true;

            for ($i = 0; $i < count($_POST['idManga']); $i++) {

                $idManga    = $_POST['idManga'][$i];
                $quantidade = $_POST['quantidade'][$i];
                $valor      = $_POST['valor'][$i];
                $nomeManga  = $_POST['nome'][$i];

                $inserirPedido    = "INSERT INTO Pedidos (idUsuario, idManga, dataPedido, valor, quantidade)
                                    VALUES ('$idUsuario', '$idManga', '$dataPedido', '$valor', '$quantidade')";
                
                $atualizarEstoque = "UPDATE Mangas SET estoque = estoque - $quantidade WHERE idManga = $idManga";

                if (mysqli_query($conn, $inserirPedido) && mysqli_query($conn, $atualizarEstoque)) {
                    echo "";
                } else {
                    echo "";
                    $todosOk = false;
                }
            }

            // Agora limpa o carrinho só depois de tudo
            if ($todosOk) {
                $limparCarrinho = "DELETE FROM Carrinho WHERE idUsuario = $idUsuario";
                mysqli_query($conn, $limparCarrinho);

                header("Location: index.php");
                exit;
            }

            mysqli_close($conn);

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

<?php include ("footer.php") ?>
