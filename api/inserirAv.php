<?php	

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$conn = mysqli_connect("localhost","root","bcd127", "dbdeliciasgeladas");
	
		$idProduto=$_POST["idProduto"];
		$avaliacao=$_POST["avaliacao"];
		
		$sql="insert into tbl_avaliacao set idProduto='$idProduto'
			, avaliacao='$avaliacao';";
		
		if(mysqli_query($conn, $sql)){
			
			echo json_encode(array(
					"sucesso" => true ,
					"mensagem"=> "Inserido com sucesso"));
            
		}else{
            
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