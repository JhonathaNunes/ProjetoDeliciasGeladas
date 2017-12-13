<?php
    require_once('cms/modulo.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            Delicias Geladas - Promoções
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

            <h1 id="pagTitle">Promoções</h1>

            <?php
                $sql = "SELECT * FROM tbl_produto WHERE promocao=1";
                $select = mysqli_query(ConexaoDb(), $sql);
                while($rsPromo=mysqli_fetch_array($select)){

            ?>
                <section class="sucoPromo">
                    <div class="promoImagem">
                        <img alt="Teste" src="cms/<?php echo($rsPromo['imagem'])?>">
                    </div>
                    <div class="descricaoPromo">
                        <h2 class="tituloPromo"><?php echo($rsPromo['nomeProduto'])?></h2>
                        <p class="txtPromo">
                            <?php echo($rsPromo['descricao'])?> <br><br>

                            <span style="font-weight:bold">De: </span><span style="text-decoration:line-through;"><?php echo($rsPromo['preco'])?></span> <br>
                            <span style="font-weight:bold">Por: </span><span style="font-weight:bold; color:#f44242; font-size:20px;"><?php echo($rsPromo['preco']  - $rsPromo['preco'] * ($rsPromo['desconto']/100))?></span>
                        </p>
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
                <div id="logo">
                    <img alt="Logo" src="imagens/logoBeta.png" class="logoImage">
                </div>
            </div>
        </footer>
    </body>
</html>
