<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Mango</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/Icon-mango.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS -->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- JQuery e máscaras -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <!-- Boxicons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function(){
                $("#telefone").mask("(00) 00000-0000");
            });
        </script>
    </head>
    <body>
        <?php
            date_default_timezone_set('America/Sao_Paulo');
            session_start();
            error_reporting(0);

            if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
                $idUsuario    = $_SESSION['idUsuario'];
                $tipoUsuario  = $_SESSION['tipoUsuario'];
                $nomeUsuario  = $_SESSION['nomeUsuario'];
                $emailUsuario = $_SESSION['emailUsuario'];
            }
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php" style="width: 10%;margin-right:0;">
                    <img style="width: 100%;" src="img/Mango.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="listarMangas.php">Todos os Mangás</a></li>
                    </ul>

                    <?php
                    include("conexaoBD.php");

                    if($tipoUsuario == 'administrador'){
                        echo "
                        <ul class='navbar-nav mb-2 mb-lg-0 ms-lg-4'>
                            <li class='nav-item'><a class='nav-link' href='formManga.php'>Cadastrar Mangá</a></li>
                        ";
                    }

                    if($tipoUsuario == 'cliente'){
                        $itensCarrinho = "SELECT SUM(quantidade) AS total_comprado FROM Carrinho WHERE idUsuario = $idUsuario;";
                        $result  = mysqli_query($conn, $itensCarrinho);
                        $totalCarrinho = 0;
                        if($result){
                            $row = mysqli_fetch_assoc($result);
                            $totalCarrinho = $row['total_comprado'] ?? 0;
                        }

                        echo "
                        <ul class='navbar-nav mb-2 mb-lg-0 ms-lg-4'>
                            <form class='d-flex'>
                                <a class='btn btn-outline-orange button py-2' href='#' onclick='verificaCarrinho($totalCarrinho)'>
                                    <i class='bi-cart-fill me-1'></i>
                                    Carrinho
                                    <span class='badge bg-light text-orange ms-1 rounded-pill'>$totalCarrinho</span>
                                </a>
                            </form>
                        ";
                    }

                    if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
                        echo "
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' id='navbarDropdown' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='bx bx-user-circle bx-sm'></i>
                            </a>
                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                            if($tipoUsuario == 'administrador'){
                                echo "<li><a class='dropdown-item' href='visualizarPedidos.php'>Visualizar Solicitações</a></li>
                                <li><a class='dropdown-item' href='visualizarUsuarios.php'>Visualizar Usuários</a></li>";
                            }
                            if($tipoUsuario == 'cliente'){
                                echo "<li><a class='dropdown-item' href='historicoCompras.php'>Histórico de Compras</a></li>";
                            }
                            echo "
                                <li><a class='dropdown-item' href='logout.php?pagina=formLogin'><i class='bx bx-door-open bx-sm'></i></a></li>
                            </ul>
                        </li>
                        ";
                    } else {
                        echo "
                        <form class='d-flex'>
                            <button class='btn btn-outline-orange' type='submit'>
                                <a class='nav-link' href='formLogin.php?pagina=formLogin'>Login</a>
                            </button>
                        </form>
                        ";
                    }
                    ?>
                    </ul>
                </div>
            </div>
        </nav>

        <script>
            function verificaCarrinho(total) {
                if(total <= 0){
                    Swal.fire({
                        title: 'Carrinho vazio!',
                        text: 'Você ainda não possui nenhum item no carrinho.',
                        icon: 'info',
                        confirmButtonColor: '#fd7e14'
                    });
                } else {
                    window.location.href = 'carrinho.php';
                }
            }
        </script>
