<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    //Chama a função para criar a conexao com o banco
    conexaoDb();

    $btnNome = "btnSave";
    $txtDescricao = null;
    $titulo = "Adcionar";

    //Define se é para editar ou excluir se acordo com o modo

    if(isset($_GET["modo"])){
        $modo = $_GET["modo"];
        //Cria uma ariável de sessão para que o id não resete no submit
        $_SESSION["idNivel"] = $_GET["codigo"];

        if($modo == "deletar"){
            $sql = "DELETE FROM tbl_nivel WHERE idNivel = ".$_SESSION["idNivel"];

            mysqli_query(ConexaoDb(), $sql);
            header("location:gerenciamento-nivel.php");
        }

        if($modo == "editar"){
            $btnNome = "btnEditar";
            $titulo = "Editar";

            $sql = "SELECT * FROM tbl_nivel WHERE idNivel = ".$_SESSION["idNivel"];

            $select = mysqli_query(ConexaoDb(), $sql);
            $rsNivel = mysqli_fetch_array($select);

            $txtDescricao = $rsNivel['descricao'];
        }
    }

    //Verifica o nome do botão para chamar a ação correspondente
    if(isset($_POST["btnSave"])){
        $descricao = $_POST["txtDescricao"];

        if (verificaNivel($descricao)){
            echo("<script> alert('O nível informado já existe!')</script>");
        }else{
            $sql="INSERT INTO tbl_nivel (descricao) values ('".$descricao."');";

            mysqli_query(ConexaoDb(), $sql);
            header("location:cms-usuarios.php");
        }

    }else if(isset($_POST["btnEditar"])){
        $descricao = $_POST["txtDescricao"];

        $sql="UPDATE tbl_nivel SET descricao = '".$descricao."' WHERE idNivel = ".$_SESSION["idNivel"].";";

        echo($sql);
        mysqli_query(ConexaoDb(), $sql);
        header("location:gerenciamento-nivel.php");
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
            <?php criaMenu() ?>
            <main>
                <div id="formNivel" >
                    <h1 id="tituloPagina"><?php echo($titulo)?> Nivel</h1>
                    <form name="frmNivel" method="post" action="gerenciamento-nivel.php">
                        Descrição:
                        <input type="text" name="txtDescricao" value="<?php echo($txtDescricao)?>" required>

                        <input type="submit" name="<?php echo($btnNome)?>" value="Salvar">
                    </form>
                </div>
                <!--Tabela de niveis-->
                <div id="tblNiveis">
                    <div id="titlesNiveis">
                        <div class="categoria">
                            Descrição Nivel
                        </div>
                        <div class="categoriaOptions">
                            Opções
                        </div>

                    </div>

                    <?php
                        $sql = "select * from tbl_nivel order by idNivel desc";

                        $select = mysqli_query(ConexaoDb(), $sql);

                        while($rsNivel = mysqli_fetch_array($select)){
                    ?>

                    <div id="resultsNiveis">
                        <div class="result">
                            <?php echo($rsNivel['descricao']) ?>
                        </div>
                        <div class="iconOptions">
                            <a href="?modo=editar&codigo=<?php echo($rsNivel['idNivel']) ?>">
                                <img class="icon" src="imagens/sharingan.png" alt="">
                            <a href="?modo=deletar&codigo=<?php echo($rsNivel['idNivel']) ?>">
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
