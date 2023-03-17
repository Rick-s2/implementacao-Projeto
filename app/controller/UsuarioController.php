<?php
#Nome do arquivo: UsuarioController.php
#Objetivo: classe controller para Usuario

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class UsuarioController extends Controller {

    private UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();

        $this->handleAction();
    }

    /* Método para chamar a view com a listagem dos Usuarios */
    protected function list() {
        $usuarios = $this->usuarioDao->list();
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados);
    }


}

//Variável para criar um objeto da classe
$usuCont = new UsuarioController();