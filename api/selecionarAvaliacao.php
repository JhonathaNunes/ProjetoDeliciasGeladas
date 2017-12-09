<?php 

/*conexao com o Banco de Dados*/
    
    //Estabelece uma conexao com o BD MySQl
    

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        

        $conexao=mysqli_connect('localhost','root','bcd127','dbdeliciasgeladas');

        $idProduto=$_GET["idProduto"];
        
        $lstProdutos= array();

        $sql="select avg(avaliacao) as media from tbl_avaliacao where idProduto=$idProduto;";

        $resultado = mysqli_query ($conexao,$sql);

        $media = mysqli_fetch_assoc($resultado);
            $lstProdutos= array("media"=>$media["media"]);
            
        
            echo json_encode($lstProdutos);
        }
    
?>