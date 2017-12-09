<?php
    $codigo = $_POST['id'];
    require_once('modulo.php');

        $nome=null;
        $email=null;
        $profissao=null;
        $homepage=null;
        $facebook=null;
        $telefone=null;
        $celular=null;
        $sexo=null;
        $sugest=null;
        $infProd=null;
        $rdFeminino = null;
        $rdMasculino = null;
        $btnDel = null;

        $modo = null;

        $sql="SELECT * FROM tbl_contato WHERE idContato=".$codigo;

        mysqli_query(ConexaoDb(), $sql);

        $select = mysqli_query(ConexaoDb(), $sql);

        if($rsConsulta=mysqli_fetch_array($select)){
            $nome=$rsConsulta['nome'];
            $email=$rsConsulta['email'];
            $profissao=$rsConsulta['profissao'];
            $homepage=$rsConsulta['homepage'];
            $facebook=$rsConsulta['facebook'];
            $telefone=$rsConsulta['telefone'];
            $celular=$rsConsulta['celular'];
            $sexo=$rsConsulta['sexo'];
            $sugest=$rsConsulta['sugestoes'];
            $infProd=$rsConsulta['infProdutos'];

            if($sexo=="f"){
                $rdFeminino = "checked";
            }else{
                $rdMasculino = "checked";
            }
        }

        if(isset($_GET['delete'])){
            $sql = "DELETE FROM tbl_contato WHERE idContato=".$codigo;
            mysqli_query(ConexaoDb(), $sql);

            header("location:cms-faleconosco.php");
        }


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
            <a href="#" class="fechar"><img src="imagens/close.png"></a>
        </div>
        <div>
            <!--Mostra detalhadamente a sugestão do cliente conforme a opção selecionada-->
            <form name="frmFaleConosco" method="post" action="modal.php#">
                    <table id="form" >
                        <tr>
                            <td class=label>
                                Nome:
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" onkeypress="return validate(event)" type="text" name="txtNome" maxlength="200" value="<?php echo($nome)?>" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td class=label>
                                Email:
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" type="email" name="txtEmail" maxlength="200" value="<?php echo($email)?>" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td class=label>
                                Profissão:
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" type="text" name="txtProfissao" maxlength="50" value="<?php echo($profissao)?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Homepage:
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" type="text" name="txtHomepage" maxlength="200" value="<?php echo($homepage)?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Link no Facebook:
                            </td>
                            <td class="txtHolder">
                                <input class="txtBox" type="text" name="txtFacebook" maxlength="200" value="<?php echo($facebook)?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Telefone:
                            </td>
                            <td class="txtHolder">
                                <input id="telefone" type="text" name="txtTelefone" maxlength="14" placeholder="Ex.: (00) 0000-0000" value="<?php echo($telefone)?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Celular:
                            </td>
                            <td class="txtHolder">
                                <input id="celular" type="text" name="txtCelular" maxlength="15" placeholder="Ex.: (00) 00000-0000" value="<?php echo($celular)?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Sexo:
                            </td>
                            <td class="txtHolder">
                                <input type="radio" name="rdSexo" value="m" disabled <?php echo($rdMasculino)?>>Masculino
                                <input type="radio" name="rdSexo" value="f" disabled <?php echo($rdFeminino)?>>Feminino

                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Sugestões/Criticas:
                            </td>
                            <td class="txtHolder">
                                <textarea class="txtArea" name="txtSugestao" readonly><?php echo($sugest)?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class=label>
                                Informações de Produtos:
                            </td>
                            <td class="txtHolder">
                                <textarea class="txtArea" name="txtInfProdutos" readonly><?php echo($infProd)?></textarea>
                            </td>
                        </tr>
                    </table>
                    <div id="deleteSpace">
                        <a class="btnDeletar" href="?delete=true&codigo=<?php echo($codigo) ?>" >Deletar</a>
                    </div>
            </form>
        </div>
    </body>
</html>
