<?php 

/*conexao com o Banco de Dados*/
    
    //Estabelece uma conexao com o BD MySQl
$conexao=mysqli_connect('localhost','root','bcd127','dbdeliciasgeladas');

$sql="select * from tbl_produto;";

$resultado = mysqli_query ($conexao,$sql);

$lstProdutos = array();

    while ($produto = mysqli_fetch_assoc($resultado)){
       $lstProdutos[]= $produto;
        $lstContatos[]= array("nome"=>$produto["nomeProduto"], "preco"=>$produto["preco"], "imagem"=>$produto["imagem"], "promocao"=>$produto["promocao"],
                             "desconto"=>$produto["desconto"], "descricao"=>$produto["descricao"], "id"=>$produto["idProduto"], "ingredientes"=>$produto["ingredientes"]);
    }    
echo json_encode($lstContatos);
?>