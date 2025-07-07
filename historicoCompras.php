<?php
include("header.php");

    include("conexaoBD.php");

    session_start();

    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: index.php");
        exit;
    }

    $idUsuario = $_SESSION['idUsuario'];

    // Busca histórico agrupado por mangá
    $historicoCompras = "
        SELECT 
            M.idManga,
            M.nomeManga,
            M.foto,
            M.volume,
            SUM(P.quantidade) as totalComprado,
            SUM(P.valor) as valorTotal,
            MAX(P.dataPedido) as ultimaCompra
        FROM Pedidos P
        JOIN Mangas M ON P.idManga = M.idManga
        WHERE P.idUsuario = '$idUsuario'
        GROUP BY M.idManga
        ORDER BY ultimaCompra DESC
    ";

    $res = mysqli_query($conn, $historicoCompras);
?>
    <h3 class="text-center mt-5 fw-bolder">Histórico de Compras</h3>

    <div class="container px-5 px-lg-5" style="min-height: 80vh; display: flex; justify-content: center; align-items: center;">
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (mysqli_num_rows($res) > 0):
                while ($pedido = mysqli_fetch_assoc($res)): ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="<?php echo $pedido['foto']; ?>" alt="<?php echo $pedido['nomeManga']; ?>"/>
                            <div class="card-body p-3">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?php echo $pedido['nomeManga'] . " Vol. " . $pedido['volume']; ?></h5>
                                    <div class="mt-2" style="text-align: justify;">
                                        <strong>Total Comprado:</strong> <?php echo $pedido['totalComprado']; ?> unidade(s)<br>
                                        <strong>Valor Total:</strong> R$ <?php echo number_format($pedido['valorTotal'], 2, ',', '.'); ?><br>
                                        <strong>Última compra:</strong> <?php echo date("d/m/Y", strtotime($pedido['ultimaCompra'])); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                <a class="btn btn-outline-orange px-3" href="visualizarManga.php?idManga=<?php echo $pedido['idManga']?>">Página do Mangá</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="alert alert-warning text-center" style="max-width: 500px; margin: 20px auto; min-width:250px;margin-bottom: 50%;">
                    Você ainda não realizou nenhuma compra!
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php
    mysqli_close($conn);
    include("footer.php");
?>
