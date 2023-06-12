<?php


require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/FrequenciaDAO.php");
require_once(__DIR__ . "/../model/Frequencia.php");



class FrequenciaController extends Controller {

    private $frequenciaDao;

    public function __construct() {
        $this->frequenciaDao = new FrequenciaDAO();

        $this->setActionDefault("list", false);    
        $this->handleAction();
    }

    public function list(string $msgErro = "", string $msgSucesso = "") {
       
        $frequencias = $this->findFrequenciasByIdEncontro();
        $usuarios = $this->findUsuariosById();
        $i = 0;
        foreach ($usuarios as $us) {
            $frequencias[$i]->setUsuario($usuarios[$i]);
            $i++;
        }
        $dados["lista"] = $frequencias;


        $this->loadView("frequencia/listFrequencias.php", $dados,$msgErro, $msgSucesso, false);
    }

    public function findUsuariosById(){
        $id = 0;
        $id = $_GET['idAlcateia'];

        $usuarios = $this->frequenciaDao->findUsuariosByIdAcateia($id);
        return $usuarios;
    }

    public function findFrequenciasByIdEncontro(){
        $id = 0;
        $id = $_GET['idEncontro'];
        $frequencias = $this->frequenciaDao->findFrequenciaByIdEncontro($id);
        return $frequencias;
    }

    protected function updateToFalse(){
        $frequencia = $this->findFrequenciaById();
        if($frequencia){
            $this->frequenciaDao->updateToFalse($frequencia->getId_frequencia());
            $this->list("","Frequencia alterada com sucesso.");
        } else {
            $this->list("","Frequencia não encontrada.");
        }
    }
    protected function updateToTrue(){
        $frequencia = $this->findFrequenciaById();
        if($frequencia){
            $this->frequenciaDao->updateToTrue($frequencia->getId_frequencia());
            $this->list("","Frequencia alterada com sucesso.");
        } else {
            $this->list("Frequencia não encontrada.");
        }
    }

    protected function findFrequenciaById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];
        $dados["id"] = $id;

        $frequencia = $this->frequenciaDao->findById($id);
        return $frequencia;
    }
}

$freqCont = new FrequenciaController();
