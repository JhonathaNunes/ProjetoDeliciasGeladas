<?php
    /*Módulo de Login*/
    session_start();
    //Inclusao do arquivo modulo na pagina atual
    require_once('cms/modulo.php');

    $usuario = $_POST['txtUsuario'];
    $senha = md5($_POST['txtSenha']);

    addslashes($sql = "SELECT * from tbl_usuario WHERE usuario = '".$usuario."' AND senha = '".$senha."';");

    $select = mysqli_query(ConexaoDb(), $sql);

    if ($rs = mysqli_fetch_array($select)){
        /*Autentica o usuário se haver retorno*/
        $_SESSION["nomeUsuario"] = $rs['nome'];
        $_SESSION["nivelUsuario"] = $rs['idNivel'];
        header("location:cms/cms-main.php");
    }else{
        /*Manda uma mensagem e redireciona o usuário para a home se a autenticação falhar*/
        echo('<script> alert("Falha na autenticação!");
        window.location.href = "index.php"</script>');
    }
?>
