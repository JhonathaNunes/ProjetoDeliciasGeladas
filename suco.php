<?php
    require_once('cms/modulo.php');

    $sql = "SELECT * FROM tbl_suco WHERE idSuco = 1";

    $select = mysqli_query(ConexaoDb(), $sql);
    $rs = mysqli_fetch_array($select);

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            Delicias Geladas - Sobre o Suco Natural
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="imagens/logoBeta.png" type="image/x-icon">
        <script src="biblioteca/jquery-3.2.1.js"></script>
    </head>
    <body>
        <header id="header">
            <?php menuUser(); ?>
        </header>
        <div id="xpto"></div>
        <main id="conteudo">
            <div id="redesSociais">
                <img alt="Facebook" class="logoSocial" src="imagens/facebook.png">
                <img alt="Twitter" class="logoSocial" src="imagens/twitter.png">
                <img alt="Instagram" class="logoSocial" src="imagens/instagram.png">
            </div>

            <h1 id="pagTitle">A importância do suco natural</h1>

            <div id="artigo">
                <div id="imagemMain">
                    <img src="cms/<?php echo($rs['imagem1'])?>" alt="verão">
                </div>

                <div class="txt">
                    <p><?php echo(nl2br($rs['texto1'])) ?></p>
                </div>

                <div class="images">
                    <img src="cms/<?php echo($rs['imagem2'])?>" alt="verão">
                </div>

                <div class="text">
                    <p><?php echo(nl2br($rs['texto3'])) ?></p>

                </div>

                <div class="text">
                    <p><?php echo(nl2br($rs['texto3'])) ?></p>
                </div>

                <div class="images">
                    <img src="cms/<?php echo($rs['imagem3'])?>" alt="verão">
                </div>
            </div>
        </main>
        <footer id="rodape">
            <div id="footerContentHolder">
                <nav id="siteMap">
                    <h1 id="footerTitle">Explore o Site!</h1>
                    <ul id="mapaSite">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="destaques.php">Sucos em Destaque</a></li>
                        <li><a href="promocoes.php">Sucos em Promoção</a></li>
                        <li><a href="verao.php">Desvende o Verão</a></li>
                        <li><a href="destaques.php">Importância do Suco Natural</a></li>
                        <li><a href="suco.php">Encontre nossos sucos</a></li>
                        <li><a href="faleconosco.php">Fale Conosco</a></li>
                    </ul>
                </nav>
                <div id="unamed">
                    <p>Av. Buz Buzzard, nº 666</p>
                    <p>deliciagelada@gelada.com</p>
                </div>
                <div id="logo">
                    <img alt="Logo" src="imagens/logoBeta.png" class="logoImage">
                </div>
            </div>
        </footer>
    </body>
</html>
