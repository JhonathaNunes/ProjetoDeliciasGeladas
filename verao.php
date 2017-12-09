<?php
    require_once('cms/modulo.php');

    $sql = "SELECT * FROM tbl_verao WHERE idVerao = 1";

    $select = mysqli_query(ConexaoDb(), $sql);
    $rs = mysqli_fetch_array($select);

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            Delicias Geladas - Verão
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="imagens/logoBeta.png" type="image/x-icon">
        <script src="biblioteca/jquery-3.2.1.js"></script>
    </head>
    <body>
        <header id="header">
            <div id="menuBox">
                <div class="logo">
                    <img alt="logo" src="imagens/logoBeta.png" class="logoImage">
                </div>
                <nav id="menu">
                    <a href="index.php">
                        <div class="menuItem">
                            Home
                        </div>
                    </a>
                    <a href="destaques.php">
                        <div class="menuItem">
                            Destaques
                        </div>
                    </a>
                    <a href="promocoes.php">
                        <div class="menuItem">
                            Promoções
                        </div>
                    </a>
                    <a href="verao.php">
                        <div class="menuItem">
                            Verão
                        </div>
                    </a>
                    <a href="suco.php">
                        <div class="menuItem">
                            Sobre Suco
                        </div>
                    </a>
                    <a href="locais.php">
                        <div class="menuItem">
                        Locais
                        </div>
                    </a>
                    <a href="faleconosco.php">
                        <div class="menuItem">
                        Fale Conosco
                        </div>
                    </a>
                </nav>
                <form name="frmLogin" method="post" action="login.php">
                    <div id="login">
                        <div id="labels">
                            <div class="caixa">
                                Usuário:
                                <input class="loginBox" type="text" name="txtUsuario" size="15">
                            </div>
                            <div class="caixa">
                                Senha:
                                <input class="loginBox" type="password" name="txtSenha" size="15">
                            </div>
                        </div>
                        <div id="btn">
                            <input type="submit" name="btnLogin" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </header>
        <div id="xpto"></div>
        <main id="conteudo">
            <div id="redesSociais">
                <img alt="Facebook" class="logoSocial" src="imagens/facebook.png">
                <img alt="Twitter" class="logoSocial" src="imagens/twitter.png">
                <img alt="Instagram" class="logoSocial" src="imagens/instagram.png">
            </div>

            <h1 id="pagTitle">A moda verão</h1>

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
                    <p><?php echo(nl2br($rs['texto2'])) ?></p>
                </div>

                <div class="text">
                    <p><?php echo(nl2br($rs['texto3'])) ?></p>
                    <div class="confira">
                        <a href="index.php">
                            <img src="imagens/confira.png" class="confira" alt="confira">
                        </a>
                    </div>
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
