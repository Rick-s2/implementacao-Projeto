<?php
    
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, string $confSenha) {
        $erros = array();

        //Validar campos vazios
        if(! $usuario->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if(! $usuario->getLogin())
            array_push($erros, "O campo [Login] é obrigatório.");

        if(! $usuario->getSenha())
            array_push($erros, "O campo [Senha] é obrigatório.");

        if(! $confSenha)
            array_push($erros, "O campo [Confirmação da senha] é obrigatório.");
        
        if(! $usuario->getCpf())
            array_push($erros, "O campo [CPF] é obrigatório.");

        if(! $usuario->getPapeis())
            array_push($erros, "Selecione pelo menos um papel no campo [Papéis do Usuário].");

        if(! $usuario->getStatus())
            array_push($erros, "Campo [Status] é obrigatório.");

        //Validar se a senha é igual a contra senha
        if($usuario->getSenha() != $confSenha)
            array_push($erros, "O campo [Senha] e [Confirmação da senha] devem ser iguais.");

        return $erros;
    }

}
