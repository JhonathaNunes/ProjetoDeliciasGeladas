<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');
    

    
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
                <h2 class="titulo">Top Acessados</h2>
                <div class="grafico">
                    <?php
                        $sql = "SELECT sum(cliques) as total FROM tbl_produto;";
                        $select = mysqli_query(ConexaoDb(), $sql);
                        $rs = mysqli_fetch_array($select);
            
                        $sql = "SELECT * FROM tbl_produto where ativo = 1 order by cliques desc limit 5;";
                        $select = mysqli_query(ConexaoDb(), $sql);
                        while($rsProdutos=mysqli_fetch_array($select)){
                    ?>
                    <div>
                        <?php echo($rsProdutos['nomeProduto']); ?>
                    </div>
                    <div style="heigh=10px; width:<?php echo((100*$rsProdutos['cliques'])/$rs['total']); ?>%; background-color:green">
                        <span style="color:white;">Cliques:<?php echo(" ".$rsProdutos['cliques']) ?></span>
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