<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
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

?>

<div class="container-fluid">
   
    <div class= "row " id = "cabecalho">
        <div class ="col-3 ">
        
                <aside id ="menu_oculto" class ="menu_oculto">
                    <a href = "javascript:void(0)" class = "btn_fechar" onclick ="fechar_nav()">&times;</a>
                    <a href = "<?php HOME_PAGE?>"> Home</a>
                    <?php if($nome !== "(Sessão expirada)"){ 
                        echo "<a class='nav-link' href='". LOGOUT_PAGE ."'>Sair</a>";
                            }
                        else{
                            echo "<a class='nav-link' href='". LOGIN_PAGE ."'>Login</a>";
                            }
                    ?>
                    <?php if($isAdministrador): ?>
                        <a href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>">Usuários</a>
                    <?php endif; ?>
                    <a href = "#"> Sobre</a>
                    <a href = "#" input="checkbox" id="">Modo Escuro</a>
                </aside>

                <section id="principal">
                    <span style="font-size:30px;cursor:pointer " onclick = "abrir_nav()">&#9776;</span>
                    <p></p>
                </section>
        </div>

            <div class ="col-6 border" id = "bloco_titulo"><img src="../view/home/images/madeira_titulo.png"><p id="p_titulo">Escoteiros Guairacá </p></div>
            <div class ="col-3 "></div>

    </div>

                <div class="container p-2 border cx_meio">
                        <div class= "row" id = "apresentacao">
                            <div class ="col-12 border "></div>
                        </div>
                </div>


    <div class="container-fluid border">
        <div class ="col-12 border"id="rodape_invisivel">
            <div class= "row border" id = "rodape">
                        
                        

                <div class ="col-3 border">
                    <div class= "row border linha_nome">Nome</div>
                    <div class= "row border linha_foto">imagem</div>
                    <div class= "row border linha_num" >Numero</div>
                </div>

                <div class ="col-3 border">
                    <div class= "row border linha_nome">Nome</div>
                    <div class= "row border linha_foto">imagem</div>
                    <div class= "row border linha_num" >Numero</div>
                </div>


                <div class ="col-3 border">
                        <div class= "row border linha_nome">Nome</div>
                        <div class= "row border linha_foto">imagem</div>
                        <div class= "row border linha_num">Numero</div>
                 </div>


                <div class ="col-3 border">
                        <div class= "row border linha_nome">Nome</div>
                        <div class= "row border linha_foto">imagem</div>
                        <div class= "row border linha_num">Numero</div>
                </div>

    </div> 
        </div> 
            </div>
                       

</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>