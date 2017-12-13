<?php
    $codigo = $_POST['id'];
    require_once('cms/modulo.php');

		$sql = "UPDATE tbl_produto SET cliques = cliques + 1 WHERE idProduto = $codigo";
		mysqli_query(ConexaoDb(), $sql);

		$sql = "SELECT * FROM tbl_produto WHERE idProduto = $codigo;";
		$select = mysqli_query(ConexaoDb(), $sql);
		$rs=mysqli_fetch_array($select);

?>
<html>
	<head>
		<title> Teste Modal </title>
        <style>.btnDeletar{color: #ffffff;text-decoration: inherit;}</style>
	</head>

	<script>
        $(document).ready(function() {

          $(".fechar").click(function() {
            $(".modalContainer").slideToggle(1000);
          });
        });

	</script>
    <body>
        <div>
            <a href="#" class="fechar"><img src="cms/imagens/close.png"></a>
        </div>
        <div class="details">
					<div class="">
							<img src="cms/<?php echo($rs['imagem'])?>" alt="teste">
					</div>
					<div class="">
							<h2 class=""><?php echo($rs['nomeProduto'])?></h2>
							<div>
									<p>Ingredientes: <?php echo($rs['ingredientes'])?></p>
									<p>Preço: <?php echo($rs['preco'])?></p>
							</div>
					</div>

					<div class="">
									<?php echo($rs['descricao'])?>
					</div>
        </div>
    </body>
</html>
