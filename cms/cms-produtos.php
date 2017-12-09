<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    if(isset($_GET['destaqueAtivo'])){
            $sql = "UPDATE tbl_produto SET destaque = 0 WHERE idProduto = ".$_GET["id"];

        echo($sql);
            mysqli_query(ConexaoDb(), $sql);
            header('location:cms-produtos.php');
        }else if(isset($_GET['destaqueDesativo'])){
            $sql = "UPDATE tbl_produto SET destaque = 1 WHERE idProduto = ".$_GET["id"];
            mysqli_query(ConexaoDb(), $sql);
            header('location:cms-produtos.php');
            echo($sql);
        }
?>

<!DOCTYPE HTML>
<!--addslashes na string sql-->
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
         <link rel="stylesheet" type="text/css" href="css/style.css">
        <script>
            $(document).ready(function(){
                $(".ver").click(function(){
                    $(".modalPromo").slideToggle(1000);
                });
            });

            function Modal(idItem){
                $.ajax({
                    type:"POST",
                    url: "modal-promo.php",
                    data: {id:idItem},
                    success:function(dados){
                        $('.modalzito').html(dados);
                    }
                })
            }
        </script>
    </head>
    <body>
        <div class="modalPromo">
            <div class="modalzito">

            </div>
        </div>
        <div id="holder">
            <?php criaMenu() ?>
            <main>
                <div id="holderUserOptions">
                    <a href="cms-gerenciamento-suco.php">
                        <div class="iconeOpcoes">
                            <img src="imagens/suco.png" alt="" class="icone">
                            <h2 class="titulo">Adcionar Sucos</h2>
                        </div>
                    </a>
                    <a href="cms-gerenciamento-subcategoria.php">
                        <div class="iconeOpcoes">
                            <img src="imagens/categorias.png" alt="" class="icone">
                            <h2 class="titulo">Categorias</h2>
                        </div>
                    </a>
                </div>
                <div id="tblSuco">
                    <div id="titlesSuco">
                        <div class="categoria">
                            Nome
                        </div>
                        <div class="categoriaTF">
                            Destaque
                        </div>
                        <div class="categoriaTF">
                            Promoção
                        </div>
                        <div class="categoriaOptions">
                            Opções
                        </div>

                    </div>

                    <?php

                        //Lista os produtos para que sofrerão edição
                        $sql = "select * from tbl_produto order by nomeProduto desc;";

                        $select = mysqli_query(ConexaoDb(), $sql);

                        while($rsProduto = mysqli_fetch_array($select)){
                    ?>

                    <div class="resultsSuco">
                        <div class="result">
                            <?php echo($rsProduto['nomeProduto']) ?>
                        </div>
                        <div class="iconTF">
                            <?php /*Põe a imagem x se o produto estiver em destaque ou não*/
                                if($rsProduto['destaque']){
                            ?>
                                <a href="?destaqueAtivo=true&id=<?php echo($rsProduto['idProduto'])?>">
                                    <img class="icon" src="imagens/ativo.png" alt="">
                                </a>
                            <?php }else{ ?>
                                <a href="?destaqueDesativo=true&id=<?php echo($rsProduto['idProduto'])?>">
                                    <img class="icon" src="imagens/inativo.png" alt="">
                                </a>
                            <?php } ?>
                        </div>
                        <div class="iconTF">
                            <?php /*Põe a imagem x se o produto estiver em promoção ou não*/
                                if($rsProduto['promocao']){
                            ?>
                                <a href="modal-promo.php?id=<?php echo($rsProduto['idProduto'])?>">
                                    <img class="icon" src="imagens/ativo.png" alt="">
                                </a>

                            <?php }else{ ?>
                                <a href="modal-promo.php?id=<?php echo($rsProduto['idProduto'])?>">
                                    <img class="icon" src="imagens/inativo.png" alt="">
                                </a>
                            <?php } ?>
                        </div>
                        <div class="iconOptions">
                            <a href="cms-gerenciamento-suco.php?codigo=<?php echo($rsProduto['idProduto'])?>">
                               <img class="icon" src="imagens/sharingan.png" alt="">
                            </a>
                            <a href="cms-gerenciamento-suco.php?codigo=<?php echo($rsProduto['idProduto'])?>&delete=true">
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
