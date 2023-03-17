<?php

require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioService{

    public function validarDados(Usuario $usuario, string $confSenha){
        $erros = array();

        //Validar campos
        if(! $usuario->getNome())
            array_push($erros, "O campo [Nome] e obrigatorio.");
        if(! $usuario->getLogin())
            array_push($erros, "O campo [Login] e obrigatorio.");
        if(! $usuario->getSenha())
            array_push($erros, "O campo [Senha] e obrigatorio.");
        if(! $confSenha)
            array_push($erros, "O campo [ConfSenha] e obrigatorio.");

    }

}