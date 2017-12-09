<?php	

    //Verifica o Metodo
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$conn = mysqli_connect("localhost","root","bcd127", "dbdeliciasgeladas");
	
		$avaliacao=$_POST["nota"];
		$idProduto=$_POST["idProduto"];
		
		$sql="insert into tbl_avaliacao set avaliacao='$avaliacao'
			, idProduto='$idProduto';";
		
		if (mysqli_query($conn, $sql)) {
			
			echo json_encode(array(
					"sucesso" => true ,
					"mensagem"=> "Inserido com sucesso"));
		} else {
			
			echo json_encode(array(
					"sucesso" => false ,
					"mensagem" => mysqli_error($conn)));				
		}
	
		
	}else{
		
		echo json_encode(array(
		"sucesso" => false ,
		"mensagem"=> "Método não suportado"));		
	}
?>