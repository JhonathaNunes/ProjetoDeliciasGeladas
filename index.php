<?php
    require_once('cms/modulo.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            Delicias Geladas - Home
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="imagens/logoBeta.png" type="image/x-icon">
        <script type="text/javascript" src="cms/js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".ver").click(function(){
                    $(".modalContainer").slideToggle(1000);
                });
            });

            function Modal(idIten){
                $.ajax({
                    type:"GET",
                    url: "modalDetalhes.php",
                    data: {id:idIten},
                    success:function(dados){
                        $('.modal').html(dados);
                    }
                })
            }

            function filtraSubCat(idSubCategoria){
              $.ajax({
                type:"POST",
                url: "index.php",
                data: {idSub:idSubCategoria},
                success:function(dados){
                    $('body').html(dados);
                }
              });
            }
        </script>
        <script type="text/javascript" src="lib/jquery.min.js"></script>
        <script type="text/javascript" src="lib/jquery.cycle.all.js"></script>
        <script type="text/javascript">
             function simpleSlider(){
                var sliderActive = $("#slider .sliderActive");
                var sliderNext   = sliderActive.next().length ? sliderActive.next() : $("#slider li:first");
                    sliderNext.addClass('sliderActive').fadeIn();
                    sliderActive.removeClass('sliderActive').fadeOut();
            }
            $(function(){
            $("#slider li:first").fadeIn();
                setInterval( "simpleSlider()", 2500 );
            });
        </script>
    </head>
    <body>
        <div class="modalContainer">
            <div class="modal">

            </div>
        </div>
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
            <ul id="slider">
                <li class="sliderArctive"><img src="imagens/slide1.jpg" alt=""></li>
                <li><img src="imagens/slide2.jpg" alt=""></li>
                <li><img src="imagens/slide3.jpg" alt=""></li>
            </ul>
            <div id="redesSociais">
                <img alt="Facebook" class="logoSocial" src="imagens/facebook.png">
                <img alt="Twitter" class="logoSocial" src="imagens/twitter.png">
                <img alt="Instagram" class="logoSocial" src="imagens/instagram.png">
            </div>
            <div id="menuLateral">
                <?php
                    $sql = "select * from tbl_categoria;";
                    $select = mysqli_query(ConexaoDb(), $sql);
                    while($rsCategorias=mysqli_fetch_array($select)){
                ?>
                    <div class="lateralItem">
                        <?php echo($rsCategorias['nome']) ?>
                        <ul class="subMenu">
                                <?php
                                    $sql1 = "select * from tbl_subcategoria where idCategoria=".$rsCategorias['idCategoria'];
                                    $select1 = mysqli_query(ConexaoDb(), $sql1);
                                    while($rsSubcategorias=mysqli_fetch_array($select1)){
                                ?>
                                <a href="#" onclick="filtraSubCat(<?php echo($rsSubcategorias['idSubcategoria'])?>);">
                                  <li class="submenuItem" ><?php echo($rsSubcategorias['nome'])?></li>
                                </a>
                                <?php } ?>
                            </ul>
                    </div>
                <?php } ?>
            </div>
            <div id="produtos">
                <div class="produtosBox">
                    <?php
                      $sql = null;
                      if (isset($_POST['idSub'])){
                        $idSub = $_POST['idSub'];
                        $sql = "select * from tbl_produto as p
                        inner join tbl_prod_subcategoria as ps on p.idProduto = ps.idProduto where ativo = 1 and ps.idSubcategoria = $idSub;";
                      }else {
                        $sql = "select * from tbl_produto  where ativo = 1;";
                      }
                        $select = mysqli_query(ConexaoDb(), $sql);
                        while($rsProdutos=mysqli_fetch_array($select)){
                    ?>
                    <div class="item">
                        <div class="imageBox">
                            <img class="produtoImg" alt="Suco Natural" src="cms/<?php echo($rsProdutos['imagem'])?>">
                        </div>
                        <div class="descricaoProdutos">Nome:<?php echo($rsProdutos['nomeProduto'])?></div>
                        <div class="descricaoProdutos">Ingredientes:<?php echo($rsProdutos['ingredientes'])?></div>
                        <div class="descricaoProdutos">Preço:<?php echo($rsProdutos['preco'])?></div>
                        <a class="ver" href="#" onclick="Modal(<?php echo(1)?>)">
                            <div class="detalhes">Detalhes</div>
                        </a>
                    </div>
                    <?php } ?>
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
