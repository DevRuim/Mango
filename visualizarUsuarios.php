<?php include("header.php")?>


    <?php
    include("conexaoBD.php");

        $sql = "SELECT * FROM Usuarios";

        $res = mysqli_query($conn, $sql);

            while($registro = mysqli_fetch_assoc($res)){
                $idUsuario     = $registro["idUsuario"];
                $nomeUsuario   = $registro["nomeUsuario"];
                $telefone      = $registro["telefone"];
                $emailUsuario  = $registro["emailUsuario"];
            
            if($idUsuario != 1){
                echo "<div class='container mt-3'>
                            <table class='table'>
                                <tr><th>ID</th><td>$idUsuario</td></tr>
                                <tr><th>NOME</th><td>$nomeUsuario</td></tr>
                                <tr><th>TELEFONE</th><td>$telefone</td></tr>
                                <tr><th>EMAIL</th><td>$emailUsuario</td></tr>
                            </table>
                            <form action='removerUsuario.php' method='POST' class='removerUsuario'>
                                <input type=''hidden name='idUsuario' value='$idUsuario'>
                                <button type='submit' class='btn btn-outline-orange-light mb-3'><i class='bi bi-person'></i>Remover Usuário</button>
                            </form>
                    </div>

                </div>";
            }    
        } 
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.querySelectorAll(".removerUsuario").forEach(form => {
        form.addEventListener("submit", function(e){
            e.preventDefault();
            Swal.fire({
                title: "Remover Usuário?",
                text: "O usuário será removido!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#fd7e14",
                cancelButtonColor: "#696969",
                confirmButtonText: "Sim, Remover Usuário.",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Usuário Removido!",
                        text: "Usuário removido com sucesso!",
                        icon: "success",
                        iconColor: "#fd7e14"
                    }).then(() => {
                        this.submit();
                    });
                }
            });
        });
    });
    </script>
<?php include("footer.php")?>