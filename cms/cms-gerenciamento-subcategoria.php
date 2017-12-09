<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    conexaoDb();

    if(isset($_POST['btnSave'])){
        $descricao = $_POST["txtDescricao"];
        $categoria = $_POST["cbCategoria"];

        $sql = "insert into tbl_subcategoria set nome ='".$descricao."', idCategoria=".$categoria.";";

        mysqli_query(ConexaoDb(), $sql);
    }

?>
<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".ver").click(function(){
                    $(".modalContainer").slideToggle(1000);
                });
            });

            function Novo(){
                $.ajax({
                    type:"POST",
                    url: "modalCategoria.php",
                    success:function(dados){
                        $('.modal1').html(dados);
                    }
                })
            }

            function Editar(idItem){
              $.ajax({
                type:"GET",
                url: "modalCategoria.php",
                data: {id:idItem},
                success:function(dados){
                  $('.modal1').html(dados);
                }
              });
            }
        </script>
    </head>
    <body>
        <div class="modalContainer">
            <div class="modal1">

            </div>
        </div>
        <div id="holder">
            <!--Chama função para o menu-->
            <?php criaMenu() ?>
            <main>
                <div id="formNivel" >
                    <h1 id="tituloPagina">Adicionar Subcategoria</h1>
                    <form name="frmNivel" method="post" action="cms-gerenciamento-subcategoria.php">
                         Descrição:
                        <input type="text" name="txtDescricao" value="" required><br><br>
                        Categoria:
                        <select name="cbCategoria">
                            <?php

                                $sql = "SELECT * FROM tbl_categoria;";

                                echo($sql);

                                $select = mysqli_query(ConexaoDb(), $sql);

                                while($rsCategoria = mysqli_fetch_array($select)){
                            ?>
                                    <option value="<?php echo($rsCategoria['idCategoria']) ?>">
                                        <?php echo($rsCategoria['nome'])?>
                                    </option>
                                <?php
                                    }
                                ?>
                            </select>

                            <input type="submit" name="btnSave" value="Salvar">

                           <div id="center">
                                <a class="ver" href="#" onclick="Novo(1)">
                                    Adcionar Categoria
                                </a>
                            </div>
                    </div>
                </form>
                <div id="tblHold">
                    <div id="tblCat">
                        <div id="titlesCat">
                            <div class="categoriaCat">
                                Categoria
                            </div>
                            <div class="categoriaOptions">
                                Opções
                            </div>

                        </div>

                        <?php
                            $sql = "select * from tbl_categoria;";

                            $select = mysqli_query(ConexaoDb(), $sql);

                            while($rs = mysqli_fetch_array($select)){
                        ?>

                        <div class="resultsCat">
                            <div class="resultCat">
                                <?php echo($rs['nome']) ?>
                            </div>

                            <div class="iconOptions">
                                <a href="#" class="ver" onclick="Editar(<?php echo($rs['idCategoria']) ?>);">
                                  <img class="icon" src="imagens/sharingan.png" alt="">
                                </a>
                                <img class="icon" src="imagens/delete.png" alt="">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div id="tblCat">
                        <div id="titlesCat">
                            <div class="categoriaCat">
                                Subcategoria
                            </div>
                            <div class="categoriaOptions">
                                Opções
                            </div>

                        </div>

                        <?php
                            $sql = "select * from tbl_subcategoria order by idCategoria;";

                            $select = mysqli_query(ConexaoDb(), $sql);

                            while($rs = mysqli_fetch_array($select)){
                        ?>

                        <div class="resultsCat">
                            <div class="resultCat">
                                <?php echo($rs['nome']) ?>
                            </div>

                            <div class="iconOptions">
                                <img class="icon" src="imagens/sharingan.png" alt="">
                                <img class="icon" src="imagens/delete.png" alt="">
                            </div>
                        </div>

                        <?php } ?>
                    </div>
                </div>
            </main>

            <footer>
                <p id="developed">Desenvolvido por: JSoftwares</p>
            </footer>
        </div>
    </body>
</html>
