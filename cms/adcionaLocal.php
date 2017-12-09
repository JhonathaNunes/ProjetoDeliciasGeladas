<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    conexaoDb();

    if(isset($_POST['btnSave'])){
        $cidade = $_POST['txtCidade'];
        $idEstado = $_POST['cbEstado'];

        $sql="insert into tbl_cidade (nome, idEstado) values ('".$cidade."', ".$idEstado.");";
        mysqli_query(ConexaoDb(), $sql);
        header('location:cms-lojas.php');
    }

?>
<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="holder">
            <!--Chama função para o menu-->
            <?php criaMenu() ?>
            <main>
                <h1 id="tituloPagina">Adcionar Cidade</h1>
                <!--Form para adcionar uma nova cidade-->
                <form name="frmNivel" method="post" action="adcionaLocal.php">
                        <table id="formUsuario" >
                        <tr>
                            <td class=label>
                                Cidade(*):
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" onkeypress="return validate(event)" type="text" name="txtCidade" maxlength="200" required>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Estado(*):
                            </td>
                            <td class="txtHolder">
                                <select name="cbEstado">
                                    <?php

                                        $sql = "SELECT * FROM tbl_estado order by uf asc;";

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
                    </table>
                    <div id="btnEnvio">
                        <input type="submit" name="btnSave" value="Salvar">
                    </div>
                </form>
            </main>

            <footer>
                <p id="developed">Desenvolvido por: JSoftwares</p>
            </footer>
        </div>
    </body>
</html>
