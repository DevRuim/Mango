<?php include('header.php');

    include("conexaoBD.php");

    $listarMangas = "SELECT mangas.idManga,foto,mangas.nomeManga, mangas.volume, mangas.valor, 
        SUM(carrinho.quantidade) as total, 
        (mangas.valor * SUM(quantidade)) as valorTotal
    FROM Carrinho 
    JOIN Mangas ON carrinho.idManga = mangas.idManga 
    WHERE carrinho.idUsuario = '$idUsuario'
    GROUP BY mangas.idManga;";

    $res = mysqli_query($conn, $listarMangas);
    $totalMangas = mysqli_num_rows($res);
    ?>
    <div class="row">
        <section class="pt-5">
            <div class="container px-5 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 row-cols-xl-4 justify-content-center" 
                    style="min-height: 65vh; display: flex; align-items: center;">

                <?php while ($registro = mysqli_fetch_assoc($res)): 
                    $idManga    = $registro["idManga"];
                    $foto       = $registro["foto"];
                    $nomeManga  = $registro["nomeManga"];
                    $volume     = $registro['volume'];
                    $valor      = $registro["valor"];
                    $total      = $registro['total'];
                    $valorTotal = $registro['valorTotal'];
                ?>
                
                    <form method='POST' action="removerItemCarrinho.php" class="removerItemForm">
                        <div class='col mb-5'>
                            <div class='card h-100'>
                                <img class='card-img-top' src='<?php echo $foto; ?>' alt='<?php echo $nomeManga; ?>'/>
                                <div class='card-body p-3'>
                                    <div class='text-center'>
                                        <h5 class='fw-bolder'><?php echo "$nomeManga Vol. $volume"; ?></h5>
                                        <div style='text-align: justify' class='ms-2 mt-2'>
                                            Valor Unidade: R$ <?php echo $valor; ?> <br>
                                            Valor Total: R$ <?php echo $valorTotal; ?> <br>
                                            Unidade(s): <?php echo $total; ?>
                                        </div>
                                    </div>
                                </div>
                                <input type='hidden' name='idUsuario' value='<?php echo $idUsuario; ?>'>
                                <input type='hidden' name='idManga' value='<?php echo $idManga; ?>'>
                                <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                    <div class='text-center'>
                                        <button class='btn btn-outline-orange-light mt-auto' type='submit'>Remover do Carrinho</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>
                </div>
            </div>              
        </section>

        <div class='px-auto mt-1 mb-5 m-auto d-flex justify-content-center' style='width:45%;'>
            <div style='display:flex;flex-direction: row; justify-content: space-between;'>
                <form action='limparCarrinho.php' method='POST' id='limparCarrinho'>
                    <input type='hidden' name='idUsuario' value='<?php echo $idUsuario; ?>'>
                    <div class='p-2 d-flex justify-content-center'>
                        <button class='btn btn-outline-orange-light px-3' type='submit'>Limpar Carrinho</button>
                    </div>
                </form>

                <form action='efetuarCompra.php' method='POST' id="efetuaCompra">
                    <input type='hidden' name='idUsuario' value='<?php echo $idUsuario; ?>'>

                    <?php
                    // Executa de novo para pegar para a compra
                    $res = mysqli_query($conn, $listarMangas);
                    $totalCarrinho = 0;
                    while ($registro = mysqli_fetch_assoc($res)):
                        $idManga    = $registro["idManga"];
                        $nomeManga  = $registro["nomeManga"];
                        $valorTotal = $registro["valorTotal"];
                        $quantidade = $registro["total"];
                        $totalCarrinho += $valorTotal;
                    ?>
                        <input type='hidden' name='idManga[]' value='<?php echo $idManga; ?>'>
                        <input type='hidden' name='quantidade[]' value='<?php echo $quantidade; ?>'>
                        <input type='hidden' name='valor[]' value='<?php echo $valorTotal; ?>'>
                        <input type='hidden' name='nome[]' value='<?php echo $nomeManga; ?>'>
                    <?php endwhile; ?>

                    <div class='p-2 justify-content-center'>
                        <button class='btn btn-outline-orange px-3' type='submit'>Comprar Carrinho</button>
                    </div>
                </form>
                <hr>
            </div>
        </div>
    </div> 

    <?php mysqli_close($conn); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("limparCarrinho").addEventListener("submit", function(e){
            e.preventDefault();
            Swal.fire({
                title: "Limpar Carrinho?",
                text: "Todos itens serão removidos!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#fd7e14",
                cancelButtonColor: "#696969",
                confirmButtonText: "Sim, Limpar Carrinho.",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Carrinho Limpo!",
                        text: "Itens removidos do carrinho!",
                        icon: "success",
                        iconColor: "#fd7e14"
                    }).then(() => {
                        this.submit();
                    });
                }
            });
        });

        // agora com class correta
        document.querySelectorAll(".removerItemForm").forEach(function(form){
            form.addEventListener("submit", function(e){
                e.preventDefault();
                Swal.fire({
                    title: "Remover Item?",
                    text: "O item será removido!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#fd7e14",
                    cancelButtonColor: "#696969",
                    confirmButtonText: "Sim, Remover Item."
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Item Removido!",
                            text: "Item removido com sucesso!",
                            icon: "success",
                            iconColor: "#fd7e14"
                        }).then(() => {
                            form.submit();
                        });
                    }
                });
            });
        });

        document.getElementById("efetuaCompra").addEventListener("submit", function(e){
            e.preventDefault();
            Swal.fire({
                title: "Comprar Carrinho?",
                text: "Valor total dos itens do carrinho: R$: <?php echo $totalCarrinho ?>!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#fd7e14",
                cancelButtonColor: "#696969",
                confirmButtonText: "Sim, Comprar Carrinho."
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Compra Realizada!",
                        text: "Sua compra foi feita com sucesso!",
                        icon: "success",
                        iconColor: "#fd7e14"
                    }).then(() => {
                        this.submit();
                    });
                }
            });
        });
    </script>

<?php include('footer.php'); ?>
