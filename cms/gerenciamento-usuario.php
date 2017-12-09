<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    $nomeBotao="btnSave";

    //Variáveis que irão inserir os dados no campo
    $txtNome = null;
    $txtEmail = null;
    $txtUsuario = null;
    $senhaRequired = "requested";
    $txtCpf = null;
    $txtCelular = null;
    $idNiveldb = 0;
    $idUsuario = 0;

    //PEGANDO O CÓDIGO PARA A EDIÇÃO, E MUDANDO O NOME DO BOTÃO PARA SER DE EDIÇÃO
    if(isset($_GET["codigo"])){
        $nomeBotao = "btnEdit";
        //Cria uma ariável de sessão para que o id não resete no submit
        $_SESSION['idUsuario'] = $_GET["codigo"];

        $senhaRequired = "";

        $sql = "SELECT * FROM tbl_usuario WHERE idUsuario = ".$_SESSION['idUsuario'];
        $select = mysqli_query(ConexaoDb(), $sql);

        $rsUsuario = mysqli_fetch_array($select);

        $txtNome = $rsUsuario['nome'];
        $txtEmail = $rsUsuario['email'];
        $txtUsuario = $rsUsuario['usuario'];
        $txtCpf = $rsUsuario['cpf'];
        $txtCelular = $rsUsuario['celular'];
        $idNiveldb = $rsUsuario['idNivel'];
        $idUsuario = $rsUsuario['idUsuario'];
    }

    if(isset($_POST["btnEdit"])){
        $nome = $_POST["txtNome"];
        $email = $_POST["txtEmail"];
        $usuario = $_POST["txtUsuario"];
        $senha = $_POST["txtSenha"];
        $cpf = $_POST["txtCpf"];
        $celular = $_POST["txtCelular"];
        $idNivel = $_POST["cbNivel"];

        if ($senha != ""){
            $sql="UPDATE tbl_usuario set nome = '".$nome."', email = '".$email."', usuario = '".$usuario."', senha = '".md5($senha)."', cpf = '".$cpf."', celular = '".$celular."', idNivel = ".$idNivel." where idUsuario = ".$_SESSION["idUsuario"].";";
        }else{
            $sql="UPDATE tbl_usuario set nome = '".$nome."', email = '".$email."', usuario = '".$usuario."', cpf = '".$cpf."', celular = '".$celular."', idNivel = where idUsuario = ".$_SESSION["idUsuario"].";";
        }

        echo($sql);
        mysqli_query(ConexaoDb(), $sql);
        header("location:cms-usuarios.php");
    }



    if(isset($_POST["btnSave"])){
        $nome = $_POST["txtNome"];
        $email = $_POST["txtEmail"];
        $usuario = $_POST["txtUsuario"];
        $senha = md5($_POST["txtSenha"]);
        $cpf = $_POST["txtCpf"];
        $celular = $_POST["txtCelular"];
        $idNivel = $_POST["cbNivel"];

        if (verificaUsuario($usuario)){
            echo("<script> alert('O nome de usuário informado já existe! Por favor escolha outro nome')</script>");
        }else{
            $sql="INSERT INTO tbl_usuario (nome, email, usuario, senha, cpf, celular, idNivel)
            values ('".$nome."', '".$email."', '".$usuario."', '".$senha."', '".$cpf."', '".$celular."', ".$idNivel.");";

            mysqli_query(ConexaoDb(), $sql);
            header("location:cms-usuarios.php");
        }
    }
?>

<!DOCTYPE HTML>
<!--addslashes na string sql-->
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript">
            /*Script para máscara de telefone*/
            function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
            }
            function execmascara(){
                v_obj.value=v_fun(v_obj.value)
            }

            function mcel(v){
                v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function id( el ){
                return document.getElementById( el );
            }
            window.onload = function(){

                id('celular').onkeypress = function(){
                    mascara( this, mcel );
                }
            }

            //Para bloquear numeros
            function validate(caracter){
                if (window.event){
                    var letra=caracter.charCode;
                }else{
                    var letra=caracter.which;
                }
                if (letra >= 48 && letra <=57){
                    return false;
                }
            }
        </script>

    </head>
    <body>
        <div id="holder">
            <?php criaMenu() ?>
            <main>
                <h1 id="tituloPagina">Adcionar Usuario</h1>
                <form name="frmNivel" method="post" action="gerenciamento-usuario.php">
                    <table id="formUsuario" >
                    <tr>
                        <td class=label>
                            Nome(*):
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" onkeypress="return validate(event)" type="text" name="txtNome" maxlength="200" value="<?php echo($txtNome)?>" required>
                        </td>
                    </tr>

                    <tr>
                        <td class=label>
                            Email(*):
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" type="email" name="txtEmail" maxlength="200" value="<?php echo($txtEmail)?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                           Usuario(*):
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" type="text" name="txtUsuario" maxlength="200" value="<?php echo($txtUsuario)?>" required>

                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                           Senha(*):
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" type="password" name="txtSenha" maxlength="200" <?php echo($senhaRequired)?>>
                        </td>
                    </tr>

                    <tr>
                        <td class=label>
                           CPF(*):
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" type="text" name="txtCpf" maxlength="50" value="<?php echo($txtCpf)?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Celular(*):
                        </td>
                        <td class="txtHolder">
                            <input id="celular" type="text" name="txtCelular" maxlength="15" placeholder="Ex.: (00) 00000-0000" value="<?php echo($txtCelular)?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Nivel(*):
                        </td>
                        <td class="txtHolder">
                            <select name="cbNivel">
                                <?php
                                    if ($idNiveldb >= 1){

                                        $sql = "SELECT * FROM tbl_nivel WHERE idNivel = ".$idNiveldb;

                                        $select = mysqli_query(ConexaoDb(), $sql);

                                        $rsNivel = mysqli_fetch_array($select);
                                ?>
                                    <option value="<?php echo($idNiveldb) ?>" selected>
                                        <?php echo($rsNivel["descricao"])?>
                                    </option>
                                <?php }

                                    $sql = "SELECT * FROM tbl_nivel WHERE idNivel !=".$idNiveldb.";";

                                    $select = mysqli_query(ConexaoDb(), $sql);

                                    while($rsNivel = mysqli_fetch_array($select)){
                                ?>
                                        <option value="<?php echo($rsNivel['idNivel']) ?>">
                                            <?php echo($rsNivel['descricao'])?>
                                        </option>
                                <?php
                                    }
                                ?>
                            </select>

                        </td>
                    </tr>
            </table>
            <div id="btnEnvio">
                <input type="submit" name="<?php echo($nomeBotao)?>" value="Salvar">
            </div>
                </form>
            </main>
            <footer>
                <p id="developed">Desenvolvido por: LuanSoftwares</p>
            </footer>
        </div>
    </body>
</html>
