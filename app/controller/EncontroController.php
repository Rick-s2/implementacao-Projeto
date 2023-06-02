<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/EncontroDAO.php");
require_once(__DIR__ . "/../model/Encontro.php");
require_once(__DIR__ . "/../service/EncontroService.php");

require_once(__DIR__ . "/AlcateiaController.php");

class EncontroController extends Controller {

    private EncontroDAO $encontroDao;
    private EncontroService $encontroService;

    public function __construct()
    {
        $this->encontroDao = new EncontroDAO();
        $this->encontroService = new EncontroService();
        $this->setActionDefault("list");
        $this->handleAction();
    }

    public function list(string $msgErro = "", string $msgSucesso = ""){
        $encontros = $this->encontroDao->list();
        $dados["lista"] = $encontros;
        $this->loadView("encontro/listEncontro.php", $dados, $msgErro, $msgSucesso);
    }

    public function create(){
        $dados["id_encontro"] = 0;
        $this->loadView("encontro/formEncontro.php", $dados);
    }

    protected function edit() {
        $encontro = $this->findEncontroById();

        if($encontro){

            $dados["id_encontro"] = $encontro->getId_encontro();
            $dados["encontro"] = $encontro;        
            $this->loadView("encontro/formEncontro.php", $dados);
        } else {
            $this->list("Usuário não encontrado.");
        }
    }

    protected function findEncontroById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $dados["id_encontro"] = $id;

        $usuario = $this->encontroDao->findById($id);
        return $usuario;
    }

    public function save(){
        
       
       
       
        $dados["id_encontro"] = isset($_POST['id_encontro']) ? $_POST['id_encontro'] : 0;
        $dataEncontro = isset($_POST['dataEncontro']) ? trim($_POST['dataEncontro']) : NULL;
        $descricaoEncontro = isset($_POST['descricaoEncontro']) ? trim($_POST['descricaoEncontro']) : NULL;
        $AlcateiaEncontro = isset($_POST['idAlcateiaEncontro']) ? trim($_POST['idAlcateiaEncontro']) : NULL;

        $encontro = new encontro();
        $encontro->setData($dataEncontro);
        $encontro->setDescricao($descricaoEncontro);
        $encontro->setId_alcateia($Encontro);


        $erros = $this->encontroService->validarDados($encontro);

        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id_encontro"] == 0){ //Inserindo
                    $this->encontroService->insert($encontro);

                }
                else {//Alterando

                    $encontro->setId_encontro($dados["id_encontro"]);
                    $this->encontroService->update($encontro);
                }

                // - Enviar mensagem de sucesso
                $msg = "encontro salva com sucesso.";
                
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                $erros = ["[Erro ao salvar a encontro na base de dados.]"];
            }
        }
       
        $dados["dataEncontro"] = $dataEncontro;
        $dados["descricaoEncontro"] = $descricaoEncontro;
        $dados["alcateiaEncontro"] = $alcateiaEncontro;


        $msgsErro = implode("<br>", $erros);
        $this->loadView("encontro/formencontro.php", $dados, $msgsErro);
 
    }
}

$enctCont = new EncontroController();