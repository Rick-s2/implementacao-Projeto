<?php
    
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/Endereco.php");
require_once(__DIR__ . "/../model/Contato.php");

class UsuarioService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Endereco $endereco, Contato $contato,Usuario $usuario,string $confSenha) {
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

        //Validar se a senha é igual a contra senha
        if($usuario->getSenha() != $confSenha)
            array_push($erros, "O campo [Senha] e [Confirmação da senha] devem ser iguais.");

        if(! $endereco->getCep())
            array_push($erros, "O campo [CEP] é obrigatório.");

        if(! $endereco->getLogradouro())
            array_push($erros, "O campo [Logradouro] é obrigatório.");

        if(! $endereco->getNumeroEndereco())
            array_push($erros, "O campo [Número] é obrigatório.");
        
        if(! $endereco->getBairro())
            array_push($erros, "O campo [Bairro] é obrigatório.");

        if(! $endereco->getCidade())
            array_push($erros, "O campo [Cidade] é obrigatório.");

        if(! $endereco->getPais())
            array_push($erros, "O campo [País] é obrigatório.");

        if(! $contato->getCelular())
            array_push($erros, "O campo [Celular] é obrigatório.");

        if(! $contato->getEmail())
            array_push($erros, "O campo [E-mail] é obrigatório.");
        return $erros;
    }


    public function insertUsu(Usuario $usuario){
        $usuarioDao = new UsuarioDAO();
        $usuarioDao->insert($usuario);
    }
    public function insertEnd(Endereco $endereco){
        $enderecoDao = new EnderecoDAO();
        $enderecoDao->insert($endereco);
    }
    public function insertCont(Contato $contato){
        $contatoDao = new ContatoDAO();
        $contatoDao->insert($contato);
    }

    public function updateUsu(Usuario $usuario){
        $usuarioDao = new UsuarioDAO();
        $usuarioDao->update($usuario);
    }
    public function updateEnd(Endereco $endereco){
        $enderecoDao = new EnderecoDAO();
        $enderecoDao->update($endereco);
    }
    public function updateCont(Contato $contato){
        $contatoDao = new ContatoDAO();
        $contatoDao->update($contato);
    }

}
