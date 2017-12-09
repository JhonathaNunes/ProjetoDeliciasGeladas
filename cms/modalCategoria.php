<?php
    $id = $_GET['id'];
    require_once('modulo.php');

        $sql;
        if(isset($_POST['btnSave'])){
            $categoria = $_POST['txtCategoria'];

            $sql="INSERT INTO tbl_categoria set nome ='".$categoria."';";

            mysqli_query(ConexaoDb(), $sql);
            header('location:cms-gerenciamento-subcategoria.php');
        }
?>
<html>
	<head>
		<title> Modal </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<script>
        $(document).ready(function(){
            $(".fechar").click(function(){
                $(".modalContainer").slideToggle(1000);
            });
        });

	</script>
    <body>
        <div>
            <a href="#" class="fechar"><img src="imagens/close.png"></a>
        </div>
        <form name="frmFaleConosco" method="post" action="modalCategoria.php">
            <h1 id="tituloPagina">Adicionar Categoria</h1>
            <span style="margin-left:20px;">Nome:
            <input type="text" name="txtCategoria" value=""></span><br><br>
            <input style="margin-left:20px;" type="submit" name="btnSave" value="Salvar">

        </form>
    </body>
</html>
