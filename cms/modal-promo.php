<?php
    //$codigo = $_POST['id'];
    require_once('modulo.php');

        $sql;

        if(isset($_POST['btnSave'])){
            $desconto = $_POST['txtDesconto'];
            if($desconto > 0){
                if($_POST['ckAtivo']){
                $sql = "update tbl_produto set desconto = ".$desconto.", promocao = 1 where idProduto = ".$_SESSION['id'];
                }else{
                    $sql = "update tbl_produto set desconto = ".$desconto.", promocao = 0 where idProduto = ".$_SESSION['id'];
                }

                mysqli_query(ConexaoDb(), $sql);
                header('location:cms-produtos.php');
            }else{
                echo("<script>alert('O desconto tem que ser superior a 0')</script>");
            }

        }

?>
<html>
	<head>
		<title> Modal </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<script>
        $(document).ready(function() {

          $(".fechar").click(function() {
            $(".modalPromo").slideToggle(1000);
          });
        });

	</script>
    <body>
        <!--div>
            <a href="#" class="fechar"><img src="imagens/close.png"></a>
        </div-->
        <div id="xpto">
            <form name="frmFaleConosco" method="post" action="modal-promo.php#">
                <?php
                    $_SESSION['id'] = $_GET['id'];

                    $sql = "select * from tbl_produto where idProduto = ".$_SESSION['id'];
                    $select = mysqli_query(ConexaoDb(), $sql);
                    $rs = mysqli_fetch_array($select);
                ?>
                <h1>Definir Promoção</h1>

                Desconto:
                <input type="text" name="txtDesconto" value="<?php echo($rs["desconto"]) ?>"><br><br>

                Ativo<input type="checkbox" name="ckAtivo" <?php if($rs["promocao"]){ echo("checked");} ?>><br><br>
                <div id="btnEnvio">
                    <input type="submit" name="btnSave" value="Salvar">
                </div>

            </form>
        </div>
    </body>
</html>
