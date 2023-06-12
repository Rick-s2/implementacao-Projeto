<?php

require_once(__DIR__ . "/../model/Encontro.php");

class EncontroService {
   
    public function validarDados(Encontro $encontro) {
        $erros = array();

        if(! $encontro->getDescricao())
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