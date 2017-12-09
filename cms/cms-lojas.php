<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    $nome = '';
    $telefone = '';
    $logradouro = '';
    $idCidade = '';
    $hrAbrir = '--:--';
    $hrFechar = '--:--';
    $idCidade = 0;
    $idEstado = 0;

    $required = "required";
    $nomeBotao = 'btnSave';
    if(isset($_GET["codigo"])){
        //Verifica se é para ser feita a exclusão da loja
        if(isset($_GET["delete"])){
            $sql = "DELETE FROM tbl_loja WHERE idLoja = ".$_GET['codigo'];

            mysqli_query(ConexaoDb(), $sql);

        }else{
            $nomeBotao = "btnEdit";
            $_SESSION['codigo'] = $_GET["codigo"];

            $sql = "SELECT l.nomeLoja, l.logradouro, l.telefone, l.horario, l.imagem, c.idCidade, e.idEstado FROM tbl_loja as l inner join tbl_cidade as c on l.idCidade = c.idCidade INNER JOIN tbl_estado as e on c.idEstado = e.idEstado where idLoja = ".$_SESSION['codigo'].";";

            $select = mysqli_query(ConexaoDb(), $sql);
            $rsLoja = mysqli_fetch_array($select);

            $nome = $rsLoja['nomeLoja'];
            $telefone = $rsLoja['telefone'];
            $logradouro = $rsLoja['logradouro'];
            $idCidade = $rsLoja['idCidade'];
            $idEstado = $rsLoja['idEstado'];
            $imagem = $rsLoja['imagem'];
            $hrAbrir = substr($rsLoja['horario'],0 , strpos($rsLoja['horario'], '-'));
            $hrFechar = substr($rsLoja['horario'], strpos($rsLoja['horario'], '-')+1, 6);
        }
    }

    if(isset($_POST['btnEdit'])){
        //Código caso o modo seja de edição
        $uploadDir="arquivos/";

        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $logradouro = $_POST['txtLogradouro'];
        $idCidade = $_POST['cbCidade'];
        $hrOpen = $_POST['cbHoraOpen'];
        $hrClose = $_POST['cbHoraClose'];
        $imgLoja = basename($_FILES['imgLoja']['name']);

        if (strstr($imgLoja, '.jpg') || strstr($imgLoja, '.png')){
            $extensao = substr($imgLoja, strpos($imgLoja, '.'), 5);
            $prefixo = substr($imgLoja, 0, strpos($imgLoja, "."));

            $nomeImg = md5($prefixo).$extensao;

            $uploadFile = $uploadDir.$nomeImg;

            if(move_uploaded_file($_FILES['imgLoja']['tmp_name'], $uploadFile)){
                $sql="update tbl_loja set nomeLoja = '".$nome."', logradouro = '".$logradouro."', telefone = '".$telefone."', horario = '".$hrOpen." - ".$hrClose."', idCidade = ".$idCidade.", imagem = '".$uploadFile."' where idLoja = ".$_SESSION['codigo'].";";

                mysqli_query(ConexaoDb(), $sql);
                header('location:cms-lojas.php');
            }
        }else{
            echo("<script>alert('O arquivo escolhido deve ser do tipo .jpg ou .png! Tente novamente)</script>");
        }
    }

    if(isset($_POST['btnSave'])){
        $uploadDir="arquivos/";

        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $logradouro = $_POST['txtLogradouro'];
        $idCidade = $_POST['cbCidade'];
        $hrOpen = $_POST['cbHoraOpen'];
        $hrClose = $_POST['cbHoraClose'];
        $imgLoja = basename($_FILES['imgLoja']['name']);

        if (strstr($imgLoja, '.jpg') || strstr($imgLoja, '.png')){
            $extensao = substr($imgLoja, strpos($imgLoja, '.'), 5);
            $prefixo = substr($imgLoja, 0, strpos($imgLoja, "."));

            $nomeImg = md5($prefixo).$extensao;

            $uploadFile = $uploadDir.$nomeImg;

            if(move_uploaded_file($_FILES['imgLoja']['tmp_name'], $uploadFile)){
                $sql="INSERT INTO tbl_loja (nomeLoja, logradouro, telefone, horario, idCidade, imagem) values ('".$nome."', '".$logradouro."', '".$telefone."', '".$hrOpen." - ".$hrClose."', ".$idCidade.", '".$uploadFile."');";

                mysqli_query(ConexaoDb(), $sql);
                header('location:cms-lojas.php');
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
            /* Máscara Telefone */
            function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
            }
            function execmascara(){
                v_obj.value=v_fun(v_obj.value)
            }
            function mtel(v){
                v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function id( el ){
                return document.getElementById( el );
            }
            window.onload = function(){
                id('telefone').onkeypress = function(){
                    mascara( this, mtel );
                }
            }

            //Para bloquear numeros
            function validate(caracter){
                if (window.event){
                    var letra=caracter.charCode;
                }else{
                    var letra=caracter.which;
                }
                if (letra >= 48 && letra <=57){
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div id="holder">
            <!--Chama função para o menu-->
            <?php criaMenu() ?>
            <main>
                <h1 id="tituloPagina">Gerenciar Loja</h1>
                <form name="frmNivel" method="post" action="cms-lojas.php" enctype="multipart/form-data">
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
                                Telefone(*):
                            </td>
                            <td class="txtHolder">
                                <input id="telefone" type="text" name="txtTelefone" maxlength="14" value="<?php echo($telefone) ?>" placeholder="Ex.: (00) 0000-0000" required>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Logradouro(*):
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" type="text" name="txtLogradouro" value="<?php echo($logradouro) ?>" maxlength="40" required>
                            </td>
                        </tr>
                            <tr>
                            <td class=label>
                                Estado(*):
                            </td>
                            <td class="txtHolder">
                                <select name="cbEstado">
                                <?php
                                    if ($idEstado >= 1){

                                        $sql = "SELECT * FROM tbl_estado WHERE idEstado = ".$idEstado;

                                        $select = mysqli_query(ConexaoDb(), $sql);

                                        $rsEstado = mysqli_fetch_array($select);
                                ?>
                                    <option value="<?php echo($idEstado) ?>" selected>
                                        <?php echo($rsEstado['uf'])?>
                                    </option>

                                    <?php }

                                        $sql = "SELECT * FROM tbl_estado WHERE idEstado != ".$idEstado." order by uf asc;";

                                        $select = mysqli_query(ConexaoDb(), $sql);

                                        while($rsEstado = mysqli_fetch_array($select)){
                                    ?>
                                            <option value="<?php echo($rsEstado['idEstado']) ?>">
                                                <?php echo($rsEstado['uf'])?>
                                            </option>
                                    <?php
                                        }
                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Cidade(*):
                            </td>
                            <td class="txtHolder">
                                <select name="cbCidade">
                                    <?php
                                    if ($idCidade >= 1){

                                        $sql = "SELECT * FROM tbl_cidade WHERE idCidade = ".$idCidade;

                                        $select = mysqli_query(ConexaoDb(), $sql);

                                        $rsCidade = mysqli_fetch_array($select);
                                ?>
                                    <option value="<?php echo($idCidade) ?>" selected>
                                        <?php echo($rsCidade['nome'])?>
                                    </option>

                                    <?php }

                                        $sql = "SELECT * FROM tbl_cidade WHERE idCidade !=".$idCidade." order by nome asc;";

                                        $select = mysqli_query(ConexaoDb(), $sql);

                                        while($rsCidade = mysqli_fetch_array($select)){
                                    ?>
                                            <option value="<?php echo($rsCidade['idCidade']) ?>">
                                                <?php echo($rsCidade['nome'])?>
                                            </option>
                                    <?php
                                        }
                                    ?>
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td class=label>
                                Horario(*):
                            </td>
                            <td class="txtHolder">
                                <select name="cbHoraOpen" required>
                                    <option value="<?php echo($hrAbrir) ?>">
                                        <?php echo($hrAbrir)?>
                                    </option>
                                    <?php
                                        $hrAbertura = 8;
                                        while($hrAbertura <= 12){
                                            if($hrAbertura != substr($hrAbrir, 0, strpos($hrAbrir, ':'))){
                                    ?>
                                        <option value="<?php echo($hrAbertura) ?>:00">
                                            <?php echo($hrAbertura.":00")?>
                                        </option>
                                    <?php }$hrAbertura+=1; } ?>
                                </select>
                                -
                                <select name="cbHoraClose" required>
                                    <option value="<?php echo($hrFechar)?>">
                                       <?php echo($hrFechar)?>
                                    </option>
                                    <?php
                                        $hrFecha = 18;
                                        while($hrFecha <= 20){
                                            if($hrFecha != substr($hrFecha, 0, strpos($hrAbrir, ':'))){
                                    ?>
                                        <option value="<?php echo($hrFecha) ?>:00">
                                            <?php echo($hrFecha.":00")?>
                                        </option>
                                    <?php }$hrFecha+=1; } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Selecionar Imagem(*):
                            </td>
                            <td class="txtHolder">
                                <input type="file"  name="imgLoja" <?php echo($required)?> >
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
                    <div id="center">
                        <a href="adcionaLocal.php">
                            Adcionar Cidade
                        </a>
                    </div>
                </form>
                <div id="tblfaleConosco">
                    <div id="titles">
                        <div class="categoria">
                            Nome
                        </div>
                        <div class="categoria">
                            Horário
                        </div>
                        <div class="categoriaPhone">
                            Telefone
                        </div>
                        <div class="categoriaOptions">
                            Opções
                        </div>

                    </div>

                    <?php
                        $sql = "select * from tbl_loja order by idLoja desc";

                        $select = mysqli_query(ConexaoDb(), $sql);

                        while($rsUsuario = mysqli_fetch_array($select)){
                    ?>

                    <div class="results">
                        <div class="result">
                            <?php echo($rsUsuario['nomeLoja']) ?>
                        </div>
                        <div class="result">
                            <?php echo($rsUsuario['horario']) ?>
                        </div>
                        <div class="phoneResult">
                            <?php echo($rsUsuario['telefone']) ?>
                        </div>
                        <div class="iconOptions">
                            <a href="cms-lojas.php?codigo=<?php echo($rsUsuario['idLoja'])?>">
                                <img class="icon" src="imagens/sharingan.png" alt="">
                            </a>
                            <a href="?delete=true&codigo=<?php echo($rsUsuario['idLoja']) ?>">
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
