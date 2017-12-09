<?php
    require_once('cms/modulo.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            Delicias Geladas - Locais
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

            <h1 id="pagTitle">Nossas Lojas!</h1>

            <?php
                $sql = "SELECT l.nomeLoja, l.logradouro, l.telefone, l.horario, l.imagem, c.nome as cidade, e.uf FROM tbl_loja as l inner join tbl_cidade as c on l.idCidade = c.idCidade INNER JOIN tbl_estado as e on c.idEstado = e.idEstado;";
                $select = mysqli_query(ConexaoDb(), $sql);
                while($rs = mysqli_fetch_array($select)){

            ?>
                <section class="loja">
                    <div class="lojaImagem">
                        <img src="cms/<?php echo($rs['imagem'])?>" alt="teste">
                    </div>
                    <div class="descricaoLoja">
                        <h2 class="tituloLoja"><?php echo($rs['nomeLoja'])?></h2>
                        <div>
                            <p>Endereço: <?php echo($rs['logradouro']." - ".$rs['cidade'].", ".$rs['uf'])?></p>
                            <p>Telefone: <?php echo($rs['telefone'])?></p>
                            <p>Horário: <?php echo($rs['horario'])?></p>
                            <img src="imagens/iconPin.png" alt="icon"/> Como chegar
                        </div>
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
