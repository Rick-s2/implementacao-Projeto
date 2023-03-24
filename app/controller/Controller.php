<?php
#Classe controller padrão

require_once(__DIR__ . "/../util/config.php");

class Controller {

    protected function handleAction() {
        //Captura a ação do parâmetro GET
        $action = NULL;
        if(isset($_GET['action']))
            $action = $_GET['action'];
        
        //Chama a ação
        $this->callAction($action);
    }

    protected function callAction($methodName) {
        $methodNoAction = "noAction";

        //Verifica se o método existe na classe
        if($methodName && method_exists($this, $methodName))
            $this->$methodName();
        
        elseif(method_exists($this, $methodNoAction))
            $this->$methodNoAction();

        else {
            throw new BadFunctionCallException("Ação não implementada");
        }

    }

    protected function loadView(string $path, array $dados, string $msgErro = "") {
        
        //Verificar os dados que estão sendo recebidos na função
        //print_r($dados);
        //exit;

        $caminho = __DIR__ . "/../view/" . $path;
        //echo $caminho;
        if(file_exists($caminho)) {
            require $caminho;
        } else {
            echo "Erro ao carrega a view solicitada<br>";
            echo "Caminho: " . $caminho;
        }
    }

    //Método executado para ação inexistente
    private function noAction() {
        echo "Ação não encontrada no controller.<br>";
        echo "Verifique com o administrador do sistema.";
    }

}