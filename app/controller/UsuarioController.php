<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/UsuarioPapel.php");

class UsuarioController extends Controller {

    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();

        $this->handleAction();
    }

    /* Método para chamar a view com a listagem dos Usuarios */
    protected function list(string $msgErro = "", string $msgSucesso = "") {
        $usuarios = $this->usuarioDao->list();
        //print_r($usuarios);
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados,$msgErro, $msgSucesso);
    }

    protected function create() {
        $dados["id"] = 0;
        $dados["papeis"] = UsuarioPapel::getAllAsArray();
        $this->loadView("usuario/form.php", $dados);
    }

    protected function edit() {
        $usuario = $this->findUsuarioById();

        if($usuario){
            $dados["id"] = $usuario->getId();
            $dados["papeis"] = UsuarioPapel::getAllAsArray();
            $usuario->setSenha("");
            $dados["usuario"] = $usuario;        
            $this->loadView("usuario/form.php", $dados);
        } else {
            $this->list("Usuário não encontrado.");
        }

    }
    

    protected function save() {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : NULL;
        $login = isset($_POST['login']) ? trim($_POST['login']) : NULL;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $confSenha = isset($_POST['conf_senha']) ? trim($_POST['conf_senha']) : NULL;

        //Captura os papeis do formulário
        $papeis = array();
        foreach(UsuarioPapel::getAllAsArray() as $papel) {
            if(isset($_POST[$papel]))
                array_push($papeis, $papel);
        }

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCpf($cpf);
        $usuario->setLogin($login);
        $usuario->setSenha($senha);
        $usuario->setPapeisAsArray($papeis);

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $confSenha);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                if($dados["id"] == 0) //Inserindo
                    $this->usuarioDao->insert($usuario);
                else //Alterando
                    $usuario->setId($dados["id"]);
                    $this->usuarioDao->update($usuario);

                //TODO - Enviar mensagem de sucesso
                $msg = "Usuário salvo com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                $erros = "[Erro ao salvar o usuário na base de dados.]";                
            }
        }

        //Se há erros, volta para o formulário
        
        //TODO - Transformar o array de erros em string
        $dados["usuario"] = $usuario;
        $dados["nome"] = $nome;
        $dados["login"] = $login;
        $dados["senha"] = $senha;
        $dados["confSenha"] = $confSenha;
        $dados["papeis"] = UsuarioPapel::getAllAsArray();

        $msgsErro = implode("<br>", $erros);
        $this->loadView("usuario/form.php", $dados, $msgsErro);
    }

    protected function delete(){
        $usuario = $this->findUsuarioById();
        if($usuario){
           $this->usuarioDao->deleteById($usuario->getId());
           $this->list("","Usuário excluído com sucesso.");
        } else {
            $this->list("Usuário não encontrado.");
        }
    }
    protected function findUsuarioById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $dados["id"] = $id;

        $usuario = $this->usuarioDao->findById($id);
        return $usuario;
    }

}

#Criar objeto da classe
$usuCont = new UsuarioController();
