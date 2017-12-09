<?php
    $codigo = $_POST['id'];
    //require_once('modulo.php');

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
        
        <style>
            span{
                color: aqua;
                margin-top: 500px;
            }
        </style>
        <div class="vitas">
            <span>fadsfashaklfkajhfjkla</span>
        </div>
    </body>
</html>
