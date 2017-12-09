<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    if (isset($_POST['btnSalvar'])){
        //Caminho da pasta onde as imagens serão armazenadas
        $uploadDir="arquivos/";

        //Recupera os textos
        $texto1 = $_POST['txt1'];
        $texto2 = $_POST['txt2'];
        $texto3 = $_POST['txt3'];

        //Armazenando o nome e extensão do arquivo selecionado
        $nomeArq1 = basename($_FILES['fleFoto1']['name']);
        $nomeArq2 = basename($_FILES['fleFoto2']['name']);
        $nomeArq3 = basename($_FILES['fleFoto3']['name']);

        //Verifica a extensão
        if ($nomeArq1 != null){
            if(strstr($nomeArq1, '.jpg') || strstr($nomeArq1, '.png')){
                $extensao = substr($nomeArq1, strpos($nomeArq1, '.'), 5);
                $prefixo = substr($nomeArq1, 0, strpos($nomeArq1, "."));

                $nomeImg = md5($prefixo).$extensao;

                $uploadFile = $uploadDir.$nomeImg;

                if(move_uploaded_file($_FILES['fleFoto1']['tmp_name'], $uploadFile)){
                    $sql = "UPDATE tbl_verao set imagem1 ='".$uploadFile."' WHERE idVerao = 1;";

                    mysqli_query(ConexaoDb(), $sql);
                }

            }else{
                echo("<script> alert('O arquivo selecionado não é permitido.
                Por favor escolha um arquivo de imagem .jpg ou .png)");
            }
        }

        if ($nomeArq2 != null){
            if(strstr($nomeArq2, '.jpg') || strstr($nomeArq2, '.png')){
                $extensao = substr($nomeArq2, strpos($nomeArq2, '.'), 5);
                $prefixo = substr($nomeArq2, 0, strpos($nomeArq2, "."));

                $nomeImg = md5($prefixo).$extensao;

                $uploadFile = $uploadDir.$nomeImg;

                if(move_uploaded_file($_FILES['fleFoto2']['tmp_name'], $uploadFile)){
                    $sql = "UPDATE tbl_verao set imagem2='".$uploadFile."' WHERE idVerao = 1;";

                    mysqli_query(ConexaoDb(), $sql);
                }
            }else{
                echo("<script> alert('O arquivo selecionado não é permitido.
                Por favor escolha um arquivo de imagem .jpg ou .png)");
            }
        }

        if ($nomeArq3 != null){
            if(strstr($nomeArq3, '.jpg') || strstr($nomeArq3, '.png')){
                $extensao = substr($nomeArq3, strpos($nomeArq3, '.'), 5);
                $prefixo = substr($nomeArq3, 0, strpos($nomeArq3, "."));

                $nomeImg = md5($prefixo).$extensao;

                $uploadFile = $uploadDir.$nomeImg;

                if(move_uploaded_file($_FILES['fleFoto3']['tmp_name'], $uploadFile)){
                    $sql = "UPDATE tbl_verao set imagem3 = '".$uploadFile."' WHERE idVerao = 1;";

                    mysqli_query(ConexaoDb(), $sql);
                }
            }else{
                echo("<script> alert('O arquivo selecionado não é permitido.
                Por favor escolha um arquivo de imagem .jpg ou .png)");
            }
        }

        if($texto1 != null){
            $sql = "UPDATE tbl_verao set texto1 = '".$texto1."' WHERE idVerao = 1;";

            mysqli_query(ConexaoDb(), $sql);
        }

        if($texto2 != null){
            $sql = "UPDATE tbl_verao set texto2 = '".$texto2."' WHERE idVerao = 1;";

            mysqli_query(ConexaoDb(), $sql);
        }

        if($texto3 != null){
            $sql = "UPDATE tbl_verao set texto3 = '".$texto3."' WHERE idVerao = 1;";

            mysqli_query(ConexaoDb(), $sql);
        }
    }
?>

<!DOCTYPE HTML>
<!--addslashes na string sql-->
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="holder">
            <!--Chama o módulo de menu-->
            <?php criaMenu() ?>
            <main>
                <h1 id="tituloPagina">Página Verão</h1>

                <form name="frmVerao" method="post" action="cms-verao.php" enctype="multipart/form-data">
                    <!--Select para preencher os campos com os dados cadastrados no site-->
                    <?php
                        $sql = "SELECT * FROM tbl_verao WHERE idVerao = 1";

                        $select = mysqli_query(ConexaoDb(), $sql);
                        $rs = mysqli_fetch_array($select);
                    ?>
                    <div id="editaConteudo">
                        <div class="fotos">
                            <div class="insertImg">
                                Escolha a imagem: <input type="file" name="fleFoto1">
                            </div>
                            <div class="mostrarImg">
                                <img src="<?php echo($rs['imagem1'])?>" alt="">
                            </div>
                            </div>
                        </div>

                        <div class="textos">
                            <textarea name="txt1" cols="59" rows="8" maxlength="500" class="textBox"><?php echo($rs['texto1']) ?></textarea>
                        </div>

                        <div class="fotos">
                            <div class="insertImg">
                                Escolha a imagem: <input type="file" name="fleFoto2">
                            </div>
                            <div class="mostrarImg">
                                <img src="<?php echo($rs['imagem2'])?>" alt="">
                            </div>
                        </div>
                        <div class="textos">
                            <textarea name="txt2" cols="59" rows="8" maxlength="926" class="textBox"<?php echo($rs['texto2']) ?>></textarea>
                        </div>

                        <div class="fotos">
                            <div class="insertImg">
                                Escolha a imagem: <input type="file" name="fleFoto3">
                            </div>
                            <div class="mostrarImg">
                                <img src="<?php echo($rs['imagem3'])?>" alt="">
                            </div>
                        </div>
                        <div class="textos">
                            <textarea name="txt3" cols="59" rows="8" maxlength="926" class="textBox"><?php echo($rs['texto3']) ?></textarea>
                        </div>
                        <div id="btnEnvio">
                            <input type="submit" name="btnSalvar" value="Salvar">
                        </div>
                    </div>
                </form>
            </main>
            <footer>
                <p id="developed">Desenvolvido por: JSoftwares</p>
            </footer>
        </div>
    </body>
</html>
