<?php include "header.php" ?>

    <?php

        if(isset($_GET['idManga'])){
            $idManga = $_GET['idManga'];

            //Inclui o arquivo de conexão com o Banco de Dados
            include("conexaoBD.php");

            $exibirManga = "SELECT * FROM Mangas WHERE idManga = $idManga";
            $res           = mysqli_query($conn, $exibirManga); //Executa o comando
            $totalMangas = mysqli_num_rows($res); //Retorna a quantidade de registros

            if($totalMangas > 0){

                if($registro = mysqli_fetch_assoc($res)){
                    $idManga                = $registro["idManga"];
                    $foto                   = $registro["foto"];
                    $nomeManga              = $registro["nomeManga"];
                    $autor                  = $registro["autor"];
                    $editora                = $registro["editora"];
                    $descricaoManga         = $registro["descricaoManga"];
                    $volume                 = $registro["volume"];
                    $valor                  = $registro["valor"];
                    $disponivel             = $registro["disponivel"];
                    $estoque                = $registro["estoque"];
                    $encadernacao           = $registro["encadernacao"];
                    $ano_publicacao         = $registro["ano_publicacao"];
                    $classificacao_etaria   = $registro["classificacao_etaria"];

                    if($estoque == '0'){
                        $disponivel = '0';
                    }
                    
    ?>
            <section class="py-5" style="background: url('img/tokyoghoul.png');">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-1 gx-lg-5 align-items-center bg-light py-3">
                    <div class="col-md-5"><img class="card-img-top" src="<?php echo $foto ?>" alt="<?php echo $nomeManga ?>" /></div>
                    <div class="col-md-6 px-3 mt-2">
                        <div class="mb-1">Unidades disponíveis: 
                            <?php 
                            if($disponivel == '0'){
                                echo "Esgotado";
                            } else {
                                echo $estoque;
                            }
                    ?>
                    </div>
                        <h1 class="display-5 fw-bolder"><?php echo $nomeManga ?> <?php echo "Vol."; echo $volume;?></h1>
                        <div class="fs-5 mb-5">
                            <h6> Autor: <?php echo $autor?></h6>
                            <h6> Editora: <?php echo $editora?></h6>
                            <h6> Ano de publicação: <?php echo date("d/m/Y", strtotime($ano_publicacao)); ?></h6>
                            <h6> Classificação Etária: <?php echo $classificacao_etaria?></h6>
                            <h6> Encadernacao: <?php echo $encadernacao?></h6>
                            <span> R$: <?php echo $valor?>,00</span>
                        </div>
                        <p class="lead" style="text-align: justify;"> <?php echo $descricaoManga ?>

        <?php
        
            //Verifica se há uma sessão iniciada
            if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
                if($_SESSION['tipoUsuario'] == 'cliente'){
                    if($disponivel == '1'){
                        echo "<form class='d-flex' id='adicionarCarrinho' action='adicionarCarrinho.php' method='POST'>              
                                <input class='form-control text-center me-3' id='quantidade' type='number' value='1' style='max-width: 3rem' name='quantidade' min='1' max='$estoque'>
                                <label for='quantidade'></label>
                                <button class='btn btn-outline-orange flex-shrink-0' type='submit'>
                                    <i class='bi-cart-fill me-1'></i>
                                    Adicionar ao carrinho
                                </button>
                                <input type='hidden' name='idManga' value='$idManga'>
                                <input type='hidden' name='foto' value='$foto'>
                                <input type='hidden' name='nomeManga' value='$nomeManga'>
                                <input type='hidden' name='valor' value='$valor'>
                            </form>";
                    }
                    else{
                        echo "
                            <div class='alert alert-secondary'>
                                Mangá esgotado! <i class='bi bi-emoji-frown'></i>
                            </div>
                        ";
                    }
                }
                else{
                    echo "
                        <form action='formEditarManga.php?idManga=$idManga' method='POST'>
                        <input type='hidden' name='idManga' value='$idManga'>
                        <input type='hidden' name='autor' value='$autor'>
                        <input type='hidden' name='editora' value='$editora'>
                        <input type='hidden' name='classificacao_etaria' value='$classificacao_etaria'>
                        <input type='hidden' name='ano_publicacao' value='$ano_publicacao'>
                        <input type='hidden' name='volume' value='$volume'>
                        <input type='hidden' name='foto' value='$foto'>
                        <input type='hidden' name='nomeManga' value='$nomeManga'>
                        <input type='hidden' name='valor' value='$valor'>
                        <input type='hidden' name='estoque' value='$estoque'>
                        <input type='hidden' name='encadernacao' value='$encadernacao'>
                        <input type='hidden' name='descricaoManga' value='$descricaoManga'>
                            <button type='submit' class='btn btn-outline-orange'>
                                <i class='bi bi-pencil-square'></i>
                                Editar Manga
                            </button>
                        </form>
                    ";
                }
            }
            else{
                echo "
                    <div class='btn btn-outline-orange'>
                        <a href='formLogin.php' class='nav-link'>
                            Acesse o sistema para poder comprar este Manga! 
                            <i class='bi bi-person'></i> 
                        </a>
                    </div>
                ";
            }
            }
            else{
                echo ("<div class='alert alert-danger text-center'>Manga não localizado!</div>");
            }
                echo "</div>";
            }
        }
        else{
            echo ("<div class='alert alert-danger text-center'>Não foi possível carregar o Manga!</div>");
        }

        ?>

                </div>
            </div>
        </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.getElementById("adicionarCarrinho").addEventListener("submit", function(e){
        e.preventDefault();
        Swal.fire({
            position: "center",
            icon: "success",
            iconColor: "#fd7e14",
            title: "Adicionado ao carrinho!",
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            this.submit();
        });
    });
    </script>

<?php include "footer.php" ?>