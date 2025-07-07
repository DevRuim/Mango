<?php include "header.php" ?>
<?php include "validarSessao.php" ?> 

<div class="container text-center mb-3 mt-3">
<?php


    if(isset($_GET['idManga'])){
        $idManga = $_GET['idManga'];

        include("conexaoBD.php");

        $buscarManga = "SELECT * FROM Mangas WHERE idManga = $idManga";
        $res = mysqli_query($conn, $buscarManga);
        $totalMangas = mysqli_num_rows($res);

        if($totalMangas > 0){
            $registro = mysqli_fetch_assoc($res);
            $foto                   = $registro['foto'];
            $nomeManga              = $registro['nomeManga'];
            $descricaoManga         = $registro['descricaoManga'];
            $autor                  = $registro['autor'];
            $editora                = $registro['editora'];
            $encadernacao           = $registro['encadernacao'];
            $ano_publicacao         = $registro['ano_publicacao'];
            $classificacao_etaria   = $registro['classificacao_etaria'];
            $valor                  = $registro['valor'];
            $volume                 = $registro['volume'];
            $estoque                = $registro['estoque'];

        } else {
            echo "<div class='alert alert-danger text-center'>Não foi possível carregar o Mangá.</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Não foi possível carregar o Mangá.</div>";
        exit;
    }
?>

    <h2>Editar Mangá:</h2>
    <div class="d-flex justify-content-center mb-3">
        <div class="row">
            <div class="col-12">
                <form action="actionEditarManga.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="idManga" name="idManga" value="<?php echo $idManga ?>" required readonly>
                        <label for="idManga">ID</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <img src="<?php echo $foto ?>" style="width: 100px;" title="Foto atual de <?php echo $nomeManga ?>"> 
                        <input type="hidden" id="fotoAtual" name="fotoAtual" value="<?php echo $foto ?>" required>
                        <input type="file" class="btn btn-link" name="foto">
                        <label for="foto"></label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="nomeManga" placeholder="Nome do Mangá" name="nomeManga" value="<?php echo $nomeManga ?>" required>
                        <label for="nomeManga">Nome do Mangá</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="autor" placeholder="Nome do Autor" name="autor" value="<?php echo $autor ?>" required>
                        <label for="autor">Autor</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="editora" placeholder="Nome da Editora" name="editora" value="<?php echo $editora ?>" required>
                        <label for="editora">Editora</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="descricao" placeholder="Descrição do Mangá" name="descricaoManga" value="<?php echo $descricaoManga ?>" required>
                        <label for="descricaoManga">Descrição do Mangá</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input class="form-control" id="encadernacao" placeholder="Encadernação do Mangá" name="encadernacao"  value="<?php echo $encadernacao ?>" required>
                        <label for="encadernacao">Encadernacao</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="number" class="form-control" id="valor" placeholder="Valor" name="valor" value="<?php echo $valor ?>" required>
                        <label for="valor">Valor (R$)</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="ano_publicacao" placeholder="Ano da publicação" name="ano_publicacao" value="<?php echo $ano_publicacao ?>" required>
                        <label for="ano_publicacao">Ano de publicação</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="number" class="form-control" id="classificacao_etaria" placeholder="Classificação Etária" name="classificacao_etaria" value="<?php echo $classificacao_etaria ?>" required>
                        <label for="classificacao_etaria">Classificação Etária</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="number" class="form-control" id="volume" placeholder="Volume" name="volume" value="<?php echo $volume ?>" required>
                        <label for="volume">Volume</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="number" class="form-control" id="estoque" placeholder="Estoque" name="estoque" value="<?php echo $estoque ?>" required>
                        <label for="estoque">Estoque</label>
                    </div>
                    <button type="submit" class="btn btn-outline-orange">Salvar Alterações</button>
                </form>

                <form method='POST' action="removerManga.php" id="removerManga"class='mt-2'>
                <input type='hidden' name='idManga' value='<?php echo $idManga; ?>'>
                    <button type="submit" class="btn btn-outline-orange-light">Remover Item</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("removerManga").addEventListener("submit", function(e){
                e.preventDefault();
                Swal.fire({
                    title: "Remover Mangá?",
                    text: "O item será removido!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#fd7e14",
                    cancelButtonColor: "#696969",
                    confirmButtonText: "Sim, Remover Mangá.",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Mangá Removido!",
                            text: "Item removido com sucesso!",
                            icon: "success",
                            iconColor: "#fd7e14"
                        }).then(() => {
                            this.submit();
                        });
                    }
                });
            });
    </script>

<?php include "footer.php" ?>
