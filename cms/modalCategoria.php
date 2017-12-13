<?php
    require_once('modulo.php');
    $id = null;
    $nome = null;

    //Verifico se a variavel mode existe, se sim sera feito o select
    if(isset($_GET['mode'])){
        $id = $_GET['id'];
        
        $sql="select * from tbl_categoria where idCategoria=".$id;
        $select = mysqli_query(ConexaoDb(), $sql);
        
        if($rsCat=mysqli_fetch_array($select)){
            $nome=$rsCat['nome'];
        }
    }

    $sql;
    //Verifica se o formulario foi acionado e o modo se é inserir ou update
    if(isset($_POST['txtCategoria'])){
        $nome = $_POST['txtCategoria'];
        echo('fhadsjkl');
        if($_GET["modo"]=='inserir'){

            $sql="INSERT INTO tbl_categoria set nome ='".$nome."';";
            
        }elseif($_GET["modo"]=='atualizar'){
            $id = $_GET["id"];
            $sql = "update tbl_categoria set nome='$nome' where idCategoria=$id";
        }
        mysqli_query(ConexaoDb(), $sql);
        
        echo("<script>
            location.reload();
        </script>");
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
    <script>
        $(document).ready(function(){
            $("form").submit(function(event){
                    event.preventDefault();

                    var id =$(this).data("id");

                    var modo = "";

                    if(id==''){
                        modo = 'inserir';
                    }else{
                        modo = 'atualizar';
                    }

                    $.ajax({
                        type:"POST",
                        url:"modalCategoria.php?modo="+modo+"&id="+id,
                        data: new FormData($('#form')[0]),
                        cache: false,
                        contentType: false,
                        processData:false,
                        async:true,
                        success: function(dados){
                            $('.modal1').html(dados);
                        }
                    });
                });
            });
    </script>
    <body>
        <div>
            <a href="#" class="fechar"><img src="imagens/close.png"></a>
        </div>
        <form id="form" name="frmFaleConosco" method="post" action="modalCategoria.php" data-id="<?php echo($id); ?>">
            <h1 id="tituloPagina">Adicionar Categoria</h1>
            <span style="margin-left:20px;">Nome:
            <input type="text" name="txtCategoria" value="<?php echo($nome);?>"></span><br><br>
            <input style="margin-left:20px;" type="submit" name="btnSave" value="Salvar">

        </form>
    </body>
</html>
