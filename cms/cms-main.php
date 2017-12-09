<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');
    

    
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="holder">
            <!--Chama função para o menu-->
            <?php criaMenu() ?>
            <main>
                
                <div id="logoCenter">
                    <img id="logoNull" src="imagens/logoBeta.png" alt="">
                </div>
            </main>
            <footer>
                <p id="developed">Desenvolvido por: JSoftwares</p>
            </footer>
        </div>
    </body>
</html>