<?php include "header.php" ?>

<div class="container text-center mb-3 mt-3"
     style="min-height: 80vh; display: flex; justify-content: center; align-items: center;">

    <div>
        <h2>Acessar o Sistema:</h2>
        <div class="d-flex justify-content-center mb-3">
            <div class="row">
                <div class="col-12">
                    <form action="actionLogin.php" method="POST" class="was-validated">
                        <div class="form-floating mb-3 mt-3">
                            <input type="email" class="form-control" id="emailUsuario" placeholder="Email" name="emailUsuario" required>
                            <label for="emailUsuario">Email</label>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" class="form-control" id="senhaUsuario" placeholder="Senha" name="senhaUsuario" required>
                            <label for="senhaUsuario">Senha</label>
                        </div>
                        <button type="submit" class="btn btn-outline-orange"><i class="bi bi-person"></i>Login</button>
                    </form>
                        <?php
        //Verifica se há algum parâmetro chamado 'erroLogin' sendo recebido por GET
        if(isset($_GET['erroLogin'])){
            $erroLogin = $_GET['erroLogin']; //Variável PHP recebe o parâmetro GET

            if($erroLogin == 'dadosInvalidos'){
                echo "<div class='alert alert-warning text-center mt-3'><strong>USUÁRIO ou SENHA</strong> inválidos!</div>";
            }
            if($erroLogin == 'naoLogado'){
                echo "<div class='alert alert-warning text-center mt-3'><strong>USUÁRIO</strong> não logado!</div>";
            }
            if($erroLogin == 'acessoProibido'){
                //Redireciona para a página index.php
                header('location:index.php?pagina=index');
            }
        }
    ?>
                </div>
            </div>
        </div>
        <br>
        <p>
            Ainda não possui cadastro? <a href="formUsuario.php" title="Cadastrar-se">Clique aqui!</a> <i class="bi bi-emoji-smile"></i>
        </p>
    </div>

</div>

<?php include "footer.php" ?>
