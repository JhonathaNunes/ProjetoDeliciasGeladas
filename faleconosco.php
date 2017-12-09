<!DOCTYPE html>
<?php
    $nome=null;
    $email=null;
    $profissao=null;
    $homepage=null;
    $facebook=null;
    $telefone=null;
    $celular=null;
    $sexo=null;
    $sugestao=null;
    $infProdutos=null;

    $conexao = mysql_connect('localhost', 'root', 'bcd127');
    mysql_select_db("dbdeliciasgeladas");
    if(isset($_POST["btnEnviar"])){
        $nome=$_POST["txtNome"];
        $email=$_POST["txtEmail"];
        $profissao=$_POST["txtProfissao"];
        $homepage=$_POST["txtHomepage"];
        $facebook=$_POST["txtFacebook"];
        $telefone=$_POST["txtTelefone"];
        $celular=$_POST["txtCelular"];
        $sexo=$_POST["rdSexo"];
        $sugestao=$_POST["txtSugestao"];
        $infProdutos=$_POST["txtInfProdutos"];

        $sql="insert into tbl_contato (nome, email, profissao, homepage, facebook, telefone, celular, sexo, sugestoes, infProdutos) values('".$nome."','".$email."','".$profissao."','".$homepage."','".$facebook."','".$telefone."','".$celular."','".$sexo."','".$sugestao."','".$infProdutos."');";

        mysql_query($sql);

        header('location:faleconosco.php');
    }
?>
<html lang="pt-br">
    <head>
        <title>
            Delicias Geladas - Fale Conosco
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="imagens/logoBeta.png" type="image/x-icon">
        <script src="biblioteca/jquery-3.2.1.js"></script>
        <script type="text/javascript">
            /* Máscara Telefone */
            function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
            }
            function execmascara(){
                v_obj.value=v_fun(v_obj.value)
            }
            function mtel(v){
                v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
                return v;
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
                id('telefone').onkeypress = function(){
                    mascara( this, mtel );
                }

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
        <header id="header">
            <div id="menuBox">
                <div class="logo">
                    <img alt="logo" src="imagens/logoBeta.png" class="logoImage">
                </div>
                <nav id="menu">
                    <a href="index.php">
                        <div class="menuItem">
                            Home
                        </div>
                    </a>
                    <a href="destaques.php">
                        <div class="menuItem">
                            Destaques
                        </div>
                    </a>
                    <a href="promocoes.php">
                        <div class="menuItem">
                            Promoções
                        </div>
                    </a>
                    <a href="verao.php">
                        <div class="menuItem">
                            Verão
                        </div>
                    </a>
                    <a href="suco.php">
                        <div class="menuItem">
                            Sobre Suco
                        </div>
                    </a>
                    <a href="locais.php">
                        <div class="menuItem">
                        Locais
                        </div>
                    </a>
                    <a href="faleconosco.php">
                        <div class="menuItem">
                        Fale Conosco
                        </div>
                    </a>
                </nav>
                <form name="frmLogin" method="post" action="login.php">
                    <div id="login">
                        <div id="labels">
                            <div class="caixa">
                                Usuário:
                                <input class="loginBox" type="text" name="txtUsuario">
                            </div>
                            <div class="caixa">
                                Senha:
                                <input class="loginBox" type="password" name="txtSenha">
                            </div>
                        </div>
                        <div id="btn">
                            <input type="submit" name="btnLogin" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </header>
        <div id="xpto"></div>
        <main id="conteudo">
            <div id="redesSociais">
                <img alt="Facebook" class="logoSocial" src="imagens/facebook.png">
                <img alt="Twitter" class="logoSocial" src="imagens/twitter.png">
                <img alt="Instagram" class="logoSocial" src="imagens/instagram.png">
            </div>
            <h1 id="pagTitle">Fale Conosco</h1>
            <form name="frmFaleConosco" method="post" action="faleconosco.php">
                <table id="form" >
                    <tr>
                        <td class=label>
                            Nome(*):
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" onkeypress="return validate(event)" type="text" name="txtNome" maxlength="200" required>
                        </td>
                    </tr>

                    <tr>
                        <td class=label>
                            Email(*):
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" type="email" name="txtEmail" maxlength="200" required>
                        </td>
                    </tr>

                    <tr>
                        <td class=label>
                            Profissão(*):
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" type="text" name="txtProfissao" maxlength="50" required>
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Homepage:
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" type="text" name="txtHomepage" maxlength="200">
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Link no Facebook:
                        </td>
                        <td class="txtHolder">
                            <input class="txtBox" type="text" name="txtFacebook" maxlength="200">
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Telefone:
                        </td>
                        <td class="txtHolder">
                            <input id="telefone" type="text" name="txtTelefone" maxlength="14" placeholder="Ex.: (00) 0000-0000">
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Celular(*):
                        </td>
                        <td class="txtHolder">
                            <input id="celular" type="text" name="txtCelular" maxlength="15" placeholder="Ex.: (00) 00000-0000" required>
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Sexo(*):
                        </td>
                        <td class="txtHolder">
                            <input type="radio" name="rdSexo" value="m" checked>Masculino
                            <input type="radio" name="rdSexo" value="f">Feminino

                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Sugestões/Criticas:
                        </td>
                        <td class="txtHolder">
                            <textarea class="txtArea" name="txtSugestao"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class=label>
                            Informações de Produtos:
                        </td>
                        <td class="txtHolder">
                            <textarea class="txtArea" name="txtInfProdutos"></textarea>
                        </td>
                    </tr>
                </table>
                <div id="btnContato">
                    <input type="submit" name="btnEnviar" value="Enviar">
                </div>
            </form>
        </main>
        <footer id="rodape">
            <div id="footerContentHolder">
                <nav id="siteMap">
                    <h1 id="footerTitle">Explore o Site!</h1>
                    <ul id="mapaSite">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="destaques.php">Sucos em Destaque</a></li>
                        <li><a href="promocoes.php">Sucos em Promoção</a></li>
                        <li><a href="verao.php">Desvende o Verão</a></li>
                        <li><a href="destaques.php">Importância do Suco Natural</a></li>
                        <li><a href="suco.php">Encontre nossos sucos</a></li>
                        <li><a href="faleconosco.php">Fale Conosco</a></li>
                    </ul>
                </nav>
                <div id="unamed">
                    <p>Av. Buz Buzzard, nº 666</p>
                    <p>deliciagelada@gelada.com</p>
                </div>
                <div id="logo">
                    <img alt="Logo" src="imagens/logoBeta.png" class="logoImage">
                </div>
            </div>
        </footer>
    </body>
</html>
