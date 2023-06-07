<?php

require_once(__DIR__ . "/Controller.php");

require_once(__DIR__ . "/../dao/FrequenciaDAO.php");
require_once(__DIR__ . "/../dao/EncontroDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

require_once(__DIR__ . "/../model/Frequencia.php");
require_once(__DIR__ . "/../model/Encontro.php");
require_once(__DIR__ . "/../model/Usuario.php");


class FrequenciaController extends Controller {

    private $usuarioDao;
    private $encontroDao;
    private $frequenciaDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
        $this->encontroDao = new EncontroDAO();
        $this->frequenciaDao = new FrequenciaDAO();

        $this->setActionDefault("list");    
        $this->handleAction();
    }
}

$freqCont = new FrequenciaController();
