<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Alcateia.php");
require_once(__DIR__ . "/../dao/AlcateiaDAO.php");
    
class AlcateiaController extends Controller{

    private AlcateiaDAO $alcateiaDao;

    public function __construct(){
        $this->alcateiaDao = new AlcateiaDAO();
        $this->setActionDefault("list");
        $this->handleAction();
    }

    public function list(string $msgErro = "", string $msgSucesso = ""){
        $alcateias = $this->alcateiaDao->list();
        $dados["lista"] = $alcateias;
        $this->loadView("usuario/listAlcateia.php", $dados, $msgErro, $msgSucesso);
    }

    public function create(){
        $dados["id_alcateia"] = "";
        $this->loadView("usuario/formAlcateia.php", $dados);
    }
}