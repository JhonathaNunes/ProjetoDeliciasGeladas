<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');
    $btnNome = "btnSave";
    $categoriaId = 0;
    $nome = null;

    conexaoDb();

    //Confere se o modo é para excluir as categorias
    if(isset($_POST["excluir"])){
        $idCategoria = $_POST["id"];

        $sql = "DELETE FROM tbl_categoria WHERE idCategoria=$idCategoria";
        mysqli_query(ConexaoDb(), $sql);
    }

    if(isset($_GET["modo"])){
        $modo = $_GET["modo"];

        if($modo == "editar"){
          $_SESSION['idSub'] = $_GET['idSub'];

          $sql = "SELECT * FROM tbl_subcategoria WHERE idSubCategoria = ".$_SESSION['idSub'].";";
          $select = mysqli_query(ConexaoDb(), $sql);
          $rssubCategoria = mysqli_fetch_array($select);

          $nome = $rssubCategoria['nome'];
          $categoriaId = $rssubCategoria['idCategoria'];

          $btnNome = "btnEdit";
        }elseif ($modo == "delete") {
          $sql = "DELETE FROM tbl_subcategoria WHERE idSubcategoria=".$_GET['sId'].";";
          mysqli_query(ConexaoDb(), $sql);
        }
    }


    if(isset($_POST['btnSave'])){
        $descricao = $_POST["txtDescricao"];
        $categoria = $_POST["cbCategoria"];

        $sql = "insert into tbl_subcategoria set nome ='".$descricao."', idCategoria=".$categoria.";";
        mysqli_query(ConexaoDb(), $sql);
        header('location:cms-gerenciamento-subcategoria.php');
    }elseif(isset($_POST['btnEdit'])){
        $descricao = $_POST["txtDescricao"];
        $categoria = $_POST["cbCategoria"];

        $sql = "update tbl_subcategoria set nome ='".$descricao."', idCategoria=".$categoria." WHERE idSubcategoria = ".$_SESSION['idSub'].";";
        mysqli_query(ConexaoDb(), $sql);
        header('location:cms-gerenciamento-subcategoria.php');
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
                data: {id:idItem, mode:"xpto"},
                success:function(dados){
                  $('.modal1').html(dados);
                }
              });
            }

            function DeletarCat(idItem){
                if(confirm("Ao deletar essa categoria, todas as subcategorias relacionadas também serão deletas.")){
                    $.ajax({
                        type:"POST",
                        url:"cms-gerenciamento-subcategoria.php",
                        data:{excluir:true, id:idItem},
                        success: function(dados){
                            $("#holder").html(dados);
                        }
                    });
                }
            }

            function DeletarSubCat(idItem){
                  $.ajax({
                      type:"GET",
                      url:"cms-gerenciamento-subcategoria.php",
                      data:{modo:"delete", sId:idItem},
                      success: function(dados){
                          $("#holder").html(dados);
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
                        <input type="text" name="txtDescricao" value="<?php echo($nome); ?>" required><br><br>
                        Categoria:
                        <select name="cbCategoria">
                            <?php
                              if ($categoriaId >=1) {
                                $sql = "SELECT * FROM tbl_categoria WHERE idCategoria = $categoriaId;";
                                $select = mysqli_query(ConexaoDb(), $sql);
                                $rsCategoria = mysqli_fetch_array($select)

                                ?>
                                <option value="<?php echo($categoriaId); ?>" selected>
                                  <?php echo($rsCategoria['nome']); ?>
                                </option>
                              <?php
                                }

                                    $sql = "SELECT * FROM tbl_categoria WHERE idCategoria != $categoriaId ;";

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

                            <input type="submit" name="<?php echo($btnNome); ?>" value="Salvar">

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
                                <a href="#" onclick="DeletarCat(<?php echo($rs['idCategoria']) ?>);">
                                    <img class="icon" src="imagens/delete.png" alt="">
                                </a>
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

                            while($rsSubcat = mysqli_fetch_array($select)){
                        ?>

                        <div class="resultsCat">
                            <div class="resultCat">
                                <?php echo($rsSubcat['nome']) ?>
                            </div>

                            <div class="iconOptions">
                                <a href="cms-gerenciamento-subcategoria.php?modo=editar&id=<?php echo($rsSubcat['idSubcategoria'])?>">
                                    <img class="icon" src="imagens/sharingan.png" alt="">
                                </a>
                                <a href="#" onclick="DeletarSubCat(<?php echo($rsSubcat['idSubcategoria']) ?>);">
                                  <img class="icon" src="imagens/delete.png" alt="">
                                </a>
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
