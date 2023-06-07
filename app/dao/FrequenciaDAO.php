<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Frequencia.php");


class FrequenciaDAO {

    public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_frequencias e ORDER BY e.id_encontro";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapFrequencia($result);
    }

    public function findById(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_frequencias e" .
               " WHERE e.id_encontro = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $frequencias = $this->mapFrequencia($result);

        if(count($frequencias) == 1)
            return $frequencias[0];
        elseif(count($frequencias) == 0)
            return null;

        die("frequenciaDAO.findById()" . 
            " - Erro: mais de uma frequencia encontrado.");
    }
    
    public function mapFrequencia($result){
        $frequencias = array();
        foreach ($result as $reg) {
            $frequencia = new frequencia();
            $frequencia->setId_frequencia($reg['id_frequencia']);
            $frequencia->setId_encontro($reg['id_encontro']);
            $frequencia->setId_usuario($reg['id_usuario']);
            $frequencia->setFrequencia($reg['frequencia']);


            array_push($frequencias, $frequencia);
        }

        return $frequencias;
    }
   
}