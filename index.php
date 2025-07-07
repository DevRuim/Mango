<?php include "header.php"; ?>
        
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <img style="width: 35%;" src="img/Mango-white.png" alt="Mango Logotipo" >
                    <p class="lead fw-normal text-white-50 mb-0">Fisicamente presente para sua leitura</p>
                </div>
            </div>
        </header>

             
            <div class="row">
                <section class="py-5">
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php
                 include("conexaoBD.php");

                $listarMangas = "SELECT * FROM Mangas LIMIT 8";

                if(isset($_GET["filtroMangas"])){
                    $filtroMangas= $_GET["filtroMangas"];
                    $listarMangas = $listarMangas . " WHERE disponivel = '1' ";
                }
                

                $res = mysqli_query($conn, $listarMangas); //Executa a query
                $totalMangas = mysqli_num_rows($res); //Retorna a quantidade de registros

                    //Aqui ficará o loop para listar os registros
                    while($registro = mysqli_fetch_assoc($res)){
                        $idManga        = $registro["idManga"];
                        $foto           = $registro["foto"];
                        $nomeManga      = $registro["nomeManga"];
                        $editora        = $registro["editora"];
                        $autor          = $registro["autor"];
                        $volume         = $registro['volume'];
                        $valor          = $registro["valor"];
                        $disponivel     = $registro["disponivel"];


                        echo "
                        <div class='col mb-5'>
                            <div class='card h-100'>
                                <img class='card-img-top' src='$foto' alt='$nomeManga'/>
                                <div class='card-body p-4'>
                                    <div class='text-center'>
                                        <h5 class='fw-bolder'>$nomeManga Vol. $volume</h5>
                                    </div>
                                    <div class='text-justify'> 
                                        Valor: R$$valor <br>
                                        Autor: $autor <br>
                                        Editora: $editora <br>
                                    </div>
                                </div>
                                <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                    <div class='text-center'><a class='btn btn-outline-orange mt-auto' href='visualizarManga.php?idManga=$idManga'>Ver Detalhes</a></div>
                                </div>
                            </div>
                        </div>
                        ";
                    } 
                mysqli_close($conn);

                ?>
                
            </div>
        </div>

            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    
                </div>
            </div>
        </section>
<?php include "footer.php" ?>