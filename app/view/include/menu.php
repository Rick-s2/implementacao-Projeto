<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

require_once(__DIR__ . "/../../controller/AcessoController.php");
require_once(__DIR__ . "/../../model/enum/UsuarioPapel.php");

session_status();
if(session_status() !== PHP_SESSION_ACTIVE) 
{
    session_start();
}

$nome = "(Sessão expirada)";
if(isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];

//Variável para validar o acesso
$acessoCont = new AcessoController();
$isAdministrador = $acessoCont->usuarioPossuiPapel([UsuarioPapel::ADMINISTRADOR]);

?>
<div class= "row " id = "cabecalho">
        <div class ="col-3 ">
        
                <aside id ="menu_oculto" class ="menu_oculto">
                    <a href = "javascript:void(0)" class = "btn_fechar" onclick ="fechar_nav()">&times;</a>
                    <?php echo"<a href = " .HOME_PAGE. "> Home</a>"; ?>
                    <?php if($nome === "(Sessão expirada)") { 
                            echo "<a href = " .LOGIN_PAGE."> Login</a>";
                        }
                        else {
                            echo "<a href = " .LOGOUT_PAGE."> Sair</a>";
                        }
                    ?>
                    <?php if($isAdministrador) { 
                            echo "<a href = " .BASEURL. "/controller/UsuarioController.php?action=list> Cadastro</a>";
                        }
                    ?>
                    <a href = "#"> Sobre</a>
                    <a href = "#" input="checkbox" id="">Modo Escuro</a>
                </aside>

                <section id="principal">
                    <span style="font-size:30px;cursor:pointer " onclick = "abrir_nav()">&#9776;</span>
                    <p></p>
                </section>

                <script type="text/javascript" src="../view/home/scripts/scripts.js"></script>
        </div>

            <div class ="col-6" id = "bloco_titulo">
                <img src="../view/home/images/madeira_titulo.png">
                <p id="p_titulo">Escoteiros Guairacá </p>
            </div>
            <div class ="col-3 "></div>

    </div>
    <div class="nomeUsu">
        <a href=<?php BASEURL. "controller/UsuarioController.php?action=profile"?>><?php echo $nome; ?></a>
    </div>
