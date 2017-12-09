<?php
    //Inclusao do arquivo modulo na pagina atual
    require_once('modulo.php');

    //Chama a função para criar a conexao com o banco
    conexaoDb();

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

    if(isset($_GET['consulta'])){
        $codigo = $_GET['codigo'];
        $btnDel = "<a href='cms-faleconosco.php?consulta=true&delete=true&codigo=".$codigo."'><img src='imagens/close.png' alt=''></a>";


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


    }

    if(isset($_GET['delete'])){
        $sql = "DELETE FROM tbl_contato WHERE idContato=".$_GET['codigo'];

        echo($sql);
        mysqli_query(ConexaoDb(), $sql);


        header("location:cms-faleconosco.php");
    }


?>
<!DOCTYPE HTML>
<!--addslashes na string sql-->
<html lang="pt-BR">
    <head>
        <title>Cms - Delicias Geladas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".ver").click(function(){
                    $(".modalContainer").slideToggle(1000);
                });
            });

            function Modal(idIten){
                $.ajax({
                    type:"POST",
                    url: "modal.php",
                    data: {id:idIten},
                    success:function(dados){
                        $('.modal').html(dados);
                    }
                })
            }
        </script>
    </head>
    <body>
        <div class="modalContainer">
            <div class="modal">

            </div>
        </div>

        <div id="holder">
            <?php criaMenu() ?>
            <main>
                <!--Lista todas sugestões dos usuarios-->
                <div id="tblfaleConosco">
                    <div id="titles">
                        <div class="categoria">
                            Nome
                        </div>
                        <div class="categoria">
                            Email
                        </div>
                        <div class="categoriaPhone">
                            Profissão
                        </div>
                        <div class="categoriaPhone">
                            Celular
                        </div>
                        <div class="categoriaDetalhes">
                            View
                        </div>

                    </div>
                    <?php
                        $sql = "SELECT * FROM tbl_contato order by idContato desc";

                        $select = mysqli_query(ConexaoDb(), $sql);

                        while($rsContato = mysqli_fetch_array($select)){

                    ?>
                    <div id="results">

                        <div class="result">
                            <?php echo($rsContato['nome'])?>
                        </div>
                        <div class="result">
                            <?php echo($rsContato['email'])?>
                        </div>
                        <div class="phoneResult">
                            <?php echo($rsContato['profissao'])?>
                        </div>
                        <div class="phoneResult">
                            <?php echo($rsContato['celular'])?>
                        </div>
                        <div class="iconDetalhes">
                            <div id="imageHolder">
                                <a class="ver" href="#" onclick="Modal(<?php echo($rsContato['idContato'])?>)">
                                    <img src="imagens/sharingan.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </main>
            <footer>
                <p id="developed">Desenvolvido por: JSoftwares</p>
            </footer>
        </div>
    </body>
</html>
