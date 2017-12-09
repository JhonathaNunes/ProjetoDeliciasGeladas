<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');
    
    //Chama a função para criar a conexao com o banco
    conexaoDb();
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
            <?php /*Chama função para menu*/ criaMenu() ?>
            <main>
                <div id="options">
                    <a href="cms-verao.php">
                        <div class="item">
                            <img class="itemImg" src="imagens/verao.png">
                            <h2 class="itemName">Verão</h2>
                        </div>
                    </a>
                    <a href="cms-sucos.php">
                        <div class="item">
                            <img class="itemImg" src="imagens/sucos.png">
                            <h2 class="itemName">Sobre Suco</h2>
                        </div>
                    </a>
                    <a href="cms-lojas.php">
                        <div class="item">
                        <img class="itemImg" src="imagens/loja.png">
                        <h2 class="itemName">Lojas</h2>
                    </div>
                    </a>    
                </div>
            </main>
            <footer>
                <p id="developed">Desenvolvido por: JSoftwares</p>
            </footer>
        </div>
    </body>
</html>