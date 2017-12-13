<?php
    session_start();

    if(isset($_GET['logout'])){
        session_destroy();
        header('location:../index.php');
    }

    /*Função para conectar ao banco de dados*/
    function ConexaoDb(){
        //Conexão local
        $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'dbdeliciasgeladas');

        //Conexão Servidor
        //$conexao = mysqli_connect('192.168.0.2', 'pc19', 'senai127', 'dbpc19');

        return $conexao;
    }

    /*Função para verificar se o usuário já existe*/
    function verificaUsuario($usuario){
        $existe = "";
        $sql = "SELECT usuario FROM tbl_usuario";

        $select = mysqli_query(ConexaoDb(), $sql);

        while ($rs = mysqli_fetch_array($select)){
            if ($usuario == $rs['usuario']){
                $existe = true;
                break;
            }else{
                $existe = false;
            }
        }

        return $existe;
    }

    /*Função para verificar se o nivel já existe*/
    function verificaNivel($descricao){
        $existe = "";
        $sql = "SELECT descricao FROM tbl_nivel";

        $select = mysqli_query(ConexaoDb(), $sql);

        while ($rs = mysqli_fetch_array($select)){
            if ($descricao == $rs['descricao']){
                $existe = true;
                break;
            }else{
                $existe = false;
            }
        }

        return $existe;
    }

    /*Função para criar o menu, para evitar a repetção dos códigos*/
    function criaMenu(){
        if (isset($_SESSION['nomeUsuario'])){ ?>
            <header>
                <!--Área de apresntação-->
                <div id="head">
                    <h1 id="titulo">
                        CMS - Sistema de Gerenciamento de Site
                    </h1>
                    <div id="logo">
                        <img src="imagens/logoBeta.png" alt="" id="logoImg">
                    </div>
                </div>
                <div id="areaMenu">
                    <!--Área do menu-->
                    <nav>
                        <a <?php if ($_SESSION["nivelUsuario"] == 2 or $_SESSION["nivelUsuario"] == 3){?> href="cms-conteudo.php"<?php } ?>>
                            <div class="menuItem">
                                <div class="iconeMenu">
                                    <img class="icons" src="imagens/conteudo.png" alt="">
                                </div>
                                <h2 class="tituloOpcao">Adm.Conteudo</h2>
                            </div>
                        </a>
                        <a <?php if ($_SESSION["nivelUsuario"] == 2 or $_SESSION["nivelUsuario"] == 3){?>href="cms-faleconosco.php"<?php } ?>>
                            <div class="menuItem">
                                <div class="iconeMenu">
                                    <img class="icons" src="imagens/faleconosco.png" alt="">
                                </div>
                                <h2 class="tituloOpcao">Adm.Fale Conosco</h2>
                            </div>
                        </a>
                        <a <?php if ($_SESSION["nivelUsuario"] == 2 or $_SESSION["nivelUsuario"] == 4){?> href="cms-produtos.php" <?php } ?>>
                            <div class="menuItem">
                                <div class="iconeMenu">
                                    <img class="icons" src="imagens/produto.png" alt="">
                                </div>
                                <h2 class="tituloOpcao">Adm.Produtos</h2>
                            </div>
                        </a>
                        <a <?php if ($_SESSION["nivelUsuario"] == 2 or $_SESSION["nivelUsuario"] == 3){ ?> href="cms-usuarios.php" <?php } ?>>
                            <div class="menuItem">
                                <div class="iconeMenu">
                                    <img class="icons" src="imagens/usuarios.png" alt="">
                                </div>
                                <h2 class="tituloOpcao">Adm.Usuários</h2>
                            </div>
                        </a>
                    </nav>
                    <!--Caixa de logout-->
                    <div id="direita">
                        <p id="welcome">Bem Vindo, <?php echo($_SESSION["nomeUsuario"]) ?></p>
                        <a href="modulo.php?logout=true">
                        <p id="logout">Logout</p></a>
                    </div>
                </div>
            </header>
        <?php }else{
            echo('<script>alert("Não é possivel retornar a essa página sem login!");
            window.location.href = "../index.php"  </script>');
        }

    }

    function menuUser(){?>
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
                          <input class="loginBox" type="text" name="txtUsuario" size="15">
                      </div>
                      <div class="caixa">
                          Senha:
                          <input class="loginBox" type="password" name="txtSenha" size="15">
                      </div>
                  </div>
                  <div id="btn">
                      <input type="submit" name="btnLogin" value="Login">
                  </div>
              </div>
          </form>

      </div>
      <div class="barraPesquisa">
        <form action="index.php" method="GET">
          <input class="n" type="text" name="txtPesquisa">
          <input class="n" type="submit" name="btnSearch" value="Pesquisar">
        </form>
      </div>
    <?php } ?>
