<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioController extends Controller {

    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();

        $this->handleAction();
    }

    /* Método para chamar a view com a listagem dos Usuarios */
    protected function list() {
        $usuarios = $this->usuarioDao->list();
        //print_r($usuarios);
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados);
    }

    protected function create() {
        $dados["id"] = 0;
        $this->loadView("usuario/form.php", $dados);
    }

    protected function edit() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $dados["id"] = $id;
        $this->loadView("usuario/form.php", $dados);
    }

    protected function save() {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $login = isset($_POST['login']) ? trim($_POST['login']) : NULL;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $confSenha = isset($_POST['conf_senha']) ? trim($_POST['conf_senha']) : NULL;

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setLogin($login);
        $usuario->setSenha($senha);

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $confSenha);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                if($dados["id"] == 0) //Inserindo
                    $this->usuarioDao->insert($usuario);
                else //Alterando
                    $this->usuarioDao->update($usuario);

                //TODO - Enviar mensagem de sucesso
                $this->list();
                exit;
            } catch (PDOException $e) {
                $erros = "[Erro ao salvar o usuário na base de dados.]";                
            }
        }

        //Se há erros, volta para o formulário
        
        //TODO - Transformar o array de erros em string
        //TODO - Carregar os valores recebidos por POST de volta para o formulário
        $this->loadView("usuario/form.php", $dados, $erros[0]);
    }

}

#Criar objeto da classe
$usuCont = new UsuarioController();
