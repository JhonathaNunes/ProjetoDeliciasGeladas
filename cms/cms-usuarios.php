<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    if (isset($_GET['delete'])){
        //Deleta o usuário selecionado
        $codigo = $_GET['codigo'];

        $sql = "DELETE FROM tbl_usuario where idUsuario = ".$codigo;

        mysqli_query(ConexaoDb(), $sql);
        header("location:cms-usuarios.php");
    }
?>
<!DOCTYPE HTML>
<!--addslashes na string sql-->
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="holder">
            <?php criaMenu() ?>
            <main>
                <div id="holderUserOptions">
                    <a href="gerenciamento-usuario.php">
                        <div class="iconeOpcoes">
                            <img src="imagens/addUser.png" alt="" class="icone">
                            <h2 class="titulo">Adcionar Usuários</h2>
                        </div>
                    </a>
                    <a href="gerenciamento-nivel.php">
                        <div class="iconeOpcoes">
                            <img src="imagens/level.png" alt="" class="icone">
                            <h2 class="titulo">Gerenciar niveis</h2>
                        </div>
                    </a>
                </div>

                <div id="tblfaleConosco">
                    <div id="titles">
                        <div class="categoria">
                            Nome
                        </div>
                        <div class="categoria">
                            Email
                        </div>
                        <div class="categoriaPhone">
                            Celular
                        </div>
                        <div class="categoriaOptions">
                            Opções
                        </div>

                    </div>

                    <?php
                        //Lista os usuarios cadastrados
                        $sql = "select * from tbl_usuario order by idUsuario desc";

                        $select = mysqli_query(ConexaoDb(), $sql);

                        while($rsUsuario = mysqli_fetch_array($select)){
                    ?>

                    <div class="results">
                        <div class="result">
                            <?php echo($rsUsuario['nome']) ?>
                        </div>
                        <div class="result">
                            <?php echo($rsUsuario['email']) ?>
                        </div>
                        <div class="phoneResult">
                            <?php echo($rsUsuario['celular']) ?>
                        </div>
                        <div class="iconOptions">
                            <a href="gerenciamento-usuario.php?codigo=<?php echo($rsUsuario['idUsuario']) ?>">
                                <img class="icon" src="imagens/sharingan.png" alt="">
                            </a>
                            <a href="?delete=true&codigo=<?php echo($rsUsuario['idUsuario']) ?>">
                                <img class="icon" src="imagens/delete.png" alt="">
                            </a>
                        </div>
                    </div>

                    <?php } ?>
                </div>
            </main>
            <footer>
                <p id="developed">Desenvolvido por: JSoftwares</p>
            </footer>
        </div>
    </body>
</html>
