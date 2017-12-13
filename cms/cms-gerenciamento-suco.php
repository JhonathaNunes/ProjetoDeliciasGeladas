<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    $nome = null;
    $descricao = null;
    $ingredientes = null;
    $idsub = 0;
    $preco = null;
    $checked = null;

    $required = "required";
    $nomeBotao = 'btnSave';
    if(isset($_GET["codigo"])){
            $nomeBotao = "btnEdit";
            $_SESSION['codigo'] = $_GET["codigo"];

            $sql = "select * from view_prod_sub where idProduto = ".$_SESSION['codigo'].";";

            $select = mysqli_query(ConexaoDb(), $sql);
            $rsProduto = mysqli_fetch_array($select);

            $nome = $rsProduto['nomeProduto'];
            $descricao = $rsProduto['descricao'];
            $ingredientes = $rsProduto['ingredientes'];
            $idsub = $rsProduto['idSubcategoria'];
            $preco = str_replace('.', ',',$rsProduto['preco']);
            $imagem = $rsProduto['imagem'];
            if($rsProduto["ativo"]){
               $checked="checked";
             }
    }

    if(isset($_POST['btnEdit'])){
        //Código caso o modo seja de edição
        $uploadDir="arquivos/";

        $nome = $_POST['txtNome'];
        $desc = $_POST['txtDesc'];
        $ingredientes = $_POST['txtIngredientes'];
        $idsubCat = $_POST['cbSubCat'];
        $preco = str_replace(',', '.',$_POST['txtPreco']);
        if(isset($_POST['ckAtivo'])){
            $ativo = 1;
        }else{
            $ativo = 0;
        }
        $imgSuco = basename($_FILES['imgSuco']['name']);

        if (strstr($imgSuco, '.jpg') || strstr($imgSuco, '.png')){
            $extensao = substr($imgSuco, strpos($imgSuco, '.'), 5);
            $prefixo = substr($imgSuco, 0, strpos($imgSuco, "."));

            $nomeImg = md5($prefixo).$extensao;

            $uploadFile = $uploadDir.$nomeImg;

            if(move_uploaded_file($_FILES['imgSuco']['tmp_name'], $uploadFile)){
                $sql="update tbl_produto set nomeProduto = '".$nome."', descricao = '".$desc."', ingredientes = '".$ingredientes."',
                preco = '".$preco."', ativo = ".$ativo.", imagem = '".$uploadFile."' where idProduto = ".$_SESSION['codigo'].";";
                mysqli_query(ConexaoDb(), $sql);

                $sql="UPDATE tbl_prod_subcategoria set idSubcategoria =".$idsubCat." WHERE idProduto=".$_SESSION['codigo'].";";

                mysqli_query(ConexaoDb(), $sql);
                header('location:cms-produtos.php');
        }else{
            echo("<script>alert('O arquivo escolhido deve ser do tipo .jpg ou .png! Tente novamente)</script>");
        }
      }
    }

    if(isset($_POST['btnSave'])){
        $uploadDir="arquivos/";

        $nome = $_POST['txtNome'];
        $desc = $_POST['txtDesc'];
        $ingredientes = $_POST['txtIngredientes'];
        $idsubCat = $_POST['cbSubCat'];
        $preco = str_replace(',', '.',$_POST['txtPreco']);
        if(isset($_POST['ckAtivo'])){
            $ativo = 1;
        }else{
            $ativo = 0;
        }
        $imgSuco = basename($_FILES['imgSuco']['name']);

        if (strstr($imgSuco, '.jpg') || strstr($imgSuco, '.png')){
            $extensao = substr($imgSuco, strpos($imgSuco, '.'), 5);
            $prefixo = substr($imgSuco, 0, strpos($imgSuco, "."));

            $nomeImg = md5($prefixo).$extensao;

            $uploadFile = $uploadDir.$nomeImg;

            if(move_uploaded_file($_FILES['imgSuco']['tmp_name'], $uploadFile)){
                $sql="INSERT INTO tbl_produto (nomeProduto, descricao, ingredientes, preco, ativo, imagem)
                values ('".$nome."', '".$desc."', '".$ingredientes."', ".$preco.",".$ativo.", '".$uploadFile."');";

                mysqli_query(ConexaoDb(), $sql);

                $sql="SELECT max(idProduto) as id from tbl_produto;";
                $select = mysqli_query(ConexaoDb(), $sql);
                $rsProduto = mysqli_fetch_array($select);

                $sql="INSERT INTO tbl_prod_subcategoria set idProduto=".$rsProduto['id'].", idSubcategoria =".$idsubCat.";";

                mysqli_query(ConexaoDb(), $sql);
                header('location:cms-produtos.php');
            }
        }else{
            echo("<script>alert('O arquivo escolhido deve ser do tipo .jpg ou .png! Tente novamente)</script>");
        }
}

?>
<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript">
            /* Máscara Monetaria */
            function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
            var sep = 0;
             var key = '';
             var i = j = 0;
             var len = len2 = 0;
             var strCheck = '0123456789';
             var aux = aux2 = '';
             var whichCode = (window.Event) ? e.which : e.keyCode;
             if (whichCode == 13 || whichCode == 8) return true;
             key = String.fromCharCode(whichCode); // Valor para o código da Chave
             if (strCheck.indexOf(key) == -1) return false; // Chave inválida
             len = objTextBox.value.length;
             for(i = 0; i < len; i++)
                 if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
             aux = '';
             for(; i < len; i++)
                 if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
             aux += key;
             len = aux.length;
             if (len == 0) objTextBox.value = '';
             if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
             if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
             if (len > 2) {
                 aux2 = '';
                 for (j = 0, i = len - 3; i >= 0; i--) {
                     if (j == 3) {
                         aux2 += SeparadorMilesimo;
                         j = 0;
                     }
                     aux2 += aux.charAt(i);
                     j++;
                 }
                 objTextBox.value = '';
                 len2 = aux2.length;
                 for (i = len2 - 1; i >= 0; i--)
                 objTextBox.value += aux2.charAt(i);
                 objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
             }
             return false;
        }
        </script>
    </head>
    <body>
        <div id="holder">
            <!--Chama função para o menu-->
            <?php criaMenu() ?>
            <main>
                <h1 id="tituloPagina">Gerenciar Suco</h1>
                <form name="frmNivel" method="post" action="cms-gerenciamento-suco.php" enctype="multipart/form-data">
                        <table id="formUsuario" >
                        <tr>
                            <td class=label>
                                Nome(*):
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" type="text" name="txtNome" maxlength="30" value="<?php echo($nome) ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Descrição(*):
                            </td>
                            <td class="txtHolder">
                                <textarea name="txtDesc" cols="47" rows="3" maxlength="500" class="textBox" required><?php echo($descricao) ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Ingredientes(*):
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" type="text" name="txtIngredientes" value="<?php echo($ingredientes) ?>" maxlength="40" required>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Subcategoria(*):
                            </td>
                            <td class="txtHolder">
                                <select name="cbSubCat">
                                <?php
                                    if ($idsub >= 1){

                                        $sql = "SELECT * FROM tbl_subcategoria WHERE idSubcategoria = $idsub;";

                                        $select = mysqli_query(ConexaoDb(), $sql);

                                        $rsSubCat = mysqli_fetch_array($select);
                                ?>
                                    <option value="<?php echo($idsub) ?>" selected>
                                        <?php echo($rsSubCat['nome'])?>
                                    </option>

                                    <?php }

                                        $sql = "SELECT * FROM tbl_subcategoria WHERE idSubcategoria != $idsub order by idCategoria;";

                                        $select = mysqli_query(ConexaoDb(), $sql);

                                        while($rsSubCat = mysqli_fetch_array($select)){
                                    ?>
                                            <option value="<?php echo($rsSubCat['idSubcategoria'])?>">
                                                <?php echo($rsSubCat['nome'])?>
                                            </option>
                                    <?php
                                        }
                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Preço(*):
                            </td>
                            <td class="txtHolder">
                                <input type="text" name="txtPreco" onkeypress="return(MascaraMoeda(this,'.',',',event))" value="<?php echo($preco) ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Ativo(*):
                            </td>
                            <td class="txtHolder">
                                <input type="checkbox" name="ckAtivo" <?php echo($checked); ?>>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Selecionar Imagem(*):
                            </td>
                            <td class="txtHolder">
                                <input type="file"  name="imgSuco" required>
                            </td>
                        </tr>
                            <?php if($nomeBotao == "btnEdit"){ ?>
                                <div class="mostrarImg">
                                    <img class="imgExemplo" src="<?php echo($imagem);?>">
                                </div>
                            <?php } ?>
                    </table>
                    <div id="btnEnvio">
                        <input type="submit" name="<?php echo($nomeBotao) ?>" value="Salvar">
                    </div>
                </form>
            </main>

            <footer>
                <p id="developed">Desenvolvido por: JSoftwares</p>
            </footer>
        </div>
    </body>
</html>
