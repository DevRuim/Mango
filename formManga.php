<?php include ("header.php") ;
 include ("validarSessao.php");
?>
<div class="container text-center mb-3 mt-3">
    
    <h2>Cadastrar Mangá:</h2>
    <div class="d-flex justify-content-center mb-3">
        <div class="row">
            <div class="col-12">
                <form action="actionManga.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <div class="form-floating mb-3 mt-3">
                        <input type="file" class="form-control" id="foto" name="foto" required>
                        <label for="foto">Foto</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="nomeManga" placeholder="Nome do Mangá" name="nomeManga" required>
                        <label for="nomeManga">Nome do Mangá</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type ="text" class="form-control" id="editora" placeholder="Informe a Editora do mangá" name="editora" required>
                        <label for="editora">Editora</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type ="text" class="form-control" id="autor" placeholder="Informe o Autor do mangá" name="autor" required>
                        <label for="autor">Autor</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type ="number" class="form-control" id="volume" placeholder="Informe o Volume do mangá" name="volume" required>
                        <label for="volume">Volume</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type ="number" class="form-control" id="classificacao_etaria" placeholder="Informe a Classificação Etária do mangá" name="classificacao_etaria" required>
                        <label for="classificacao_etaria">Classificação Etária</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type ="date" class="form-control" id="ano_publicacao" placeholder="Informe o Ano de Publicação Etária do mangá" name="ano_publicacao" required>
                        <label for="ano_publicacao">Ano de Publicação</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type ="text" class="form-control" id="encadernacao" placeholder="Informe a Encadernação do mangá" name="encadernacao" required>
                        <label for="encadernacao">Encadernação</label>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="number" class="form-control" id="valor" placeholder="Valor do Mangá" name="valor" required>
                        <label for="valor">Valor do Mangá (R$):</label>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="number" class="form-control" id="estoque" placeholder="Estoque do Mangá" name="estoque" required>
                        <label for="estoque">Estoque:</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input class="form-control" id="descricaoManga" placeholder="Descrição do Mangá" name="descricaoManga" required>
                        <label for="descricaoManga">Descrição do Mangá</label>
                    </div>
                    <button type="submit" class="btn btn-outline-orange">Cadastrar Mangá</button>
                </form>
            </div>
        </div>
    </div>
    <br>

</div>

<?php include ("footer.php") ?>