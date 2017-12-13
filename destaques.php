<?php
    require_once('cms/modulo.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            Delicias Geladas - Destaques
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

            <h1 id="pagTitle">Sucos do Mês</h1>

            <?php
                $sql = "SELECT * FROM tbl_produto WHERE destaque=1";
                $select = mysqli_query(ConexaoDb(), $sql);
                while($rsDestaque=mysqli_fetch_array($select)){

            ?>

            <section class="sucoDestaque">
                <div class="destaqueImagem">
                    <img src="cms/<?php echo($rsDestaque['imagem'])?>" alt="teste">
                </div>
                <div class="descricaoDestaque">
                    <h2 class="tituloDestaque"><?php echo($rsDestaque['nomeProduto'])?></h2>
                    <div>
                        <p>Ingredientes: <?php echo($rsDestaque['ingredientes'])?></p>
                        <p>Preço: <?php echo($rsDestaque['preco'])?></p>
                    </div>
                </div>

                <div class="txtDescritivo">
                        <?php echo($rsDestaque['descricao'])?>
                </div>

            </section>

            <?php
                }
            ?>
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
                <div class="logo">
                    <img alt="logo" src="imagens/logoBeta.png" class="logoImage">
                </div>
                </div>
        </footer>
    </body>
</html>
