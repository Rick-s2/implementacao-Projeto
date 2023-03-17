<?php
#Nome do arquivo: UsuarioController.php
#Objetivo: classe controller para Usuario

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/UsuarioService.php");
require_once(__DIR__ . "/../model/Usuario.php");

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

    protected function create(){
        $dados["id"] = 0;
        $this->loadView("usuario/form.php", $dados);
    }

    protected function edit(){
        $id = 0;
        if(isset($_GET['id']))
            $id= $_GET['id'];

        $dados["id"] = $id;
        $this->loadView("usuario/form.php", $dados);
    }

    protected function save(){
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0 ;
        $nome= isset($_POST['nome']) ? trim($_POST['nome']) : NULL ;
        $login= isset($_POST['login']) ? trim($_POST['login']) : NULL ;
        $senha= isset($_POST['senha']) ? trim($_POST['senha']) : NULL ;
        $confSenha= isset($_POST['conf_senha']) ? trim($_POST['conf_senha']) : NULL ;

        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setLogin($login);
        $usuario->setSenha($senha);

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $confSenha);
        if(! empty($erros)){
            $this->loadView("usuario/form.php", $dados, $erros[0]);
            exit;
        }


        //Persistir objeto
        try{
        if($dados['id'] == 0 ) //Inserindo
            $this->usuarioDao->insert($usuario);
        else //alterando
            $this->usuarioDao->update($usuario);

        $this->list();
        }catch (PDOException $e){
            $msgErro = "Erro ao salvar o Usuario";
            $this->loadView("usuario/form.php", $msgErro);
        }

    }

    }


//Variável para criar um objeto da classe
$usuCont = new UsuarioController();