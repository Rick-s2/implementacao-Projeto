<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../model/Encontro.php");

class EncontroService {
   
    public function validarDados(Encontro $encontro) {
        $erros = array();
        if(!$encontro->getDescricao())
            array_push($erros, "O campo [Descricao] é obrigatório.");
        if(! $encontro->getData())
            array_push($erros, "O campo [Data] é obrigatório.");
        if(! $encontro->getAlcateia())
            array_push($erros, "O campo [Alcateia] é obrigatório.");

        return $erros;
    }
    public function insert(Encontro $encontro){
        $encontroDao = new EncontroDAO();
        $encontroDao->insert($encontro);
    }
    public function update(Encontro $encontro){
        $encontroDao = new EncontroDAO();
        $encontroDao->update($encontro);
    }
}