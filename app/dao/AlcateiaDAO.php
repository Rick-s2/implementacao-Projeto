<?php
    
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/Alcateia.php");

class AlcateiaDao{

    public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_alcateias a ORDER BY a.nome";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapAlcateia($result);
    }

    public function findById(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_alcateias a" .
               " WHERE a.id_alcateia = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $alcateias = $this->mapAlcateia($result);

        if(count($alcateias) == 1)
            return $alcateias[0];
        elseif(count($alcateias) == 0)
            return null;

        die("AlcateiaDAO.findById()" . 
            " - Erro: mais de uma alcateia encontrada.");
    }

    public function mapAlcateia($result){
        $alcateias = array();
        foreach ($result as $reg) {
            $alcateia = new Alcateia();
            $alcateia->setId_alcateia($reg['id_alcateia']);
            $alcateia->setNome($reg['nome']);
            array_push($alcateias, $alcateia);
        }

        return $alcateias;
    }

    public function insert(Alcateia $alcateia){
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_alcateias (nome)" .
               " VALUES (:nome)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue(':nome', $alcateia->getNome());
        $stm->execute();
    }
}