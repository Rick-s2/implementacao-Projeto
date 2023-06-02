<?php 

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Encontro.php");


class EncontroDao {
     public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros e ORDER BY e.data";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapEncontro($result);
    }

    public function findById(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros e" .
               " WHERE e.id_encontro = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $encontros = $this->mapEncontro($result);

        if(count($encontros) == 1)
            return $encontros[0];
        elseif(count($encontros) == 0)
            return null;

        die("encontroDAO.findById()" . 
            " - Erro: mais de uma encontro encontrado.");
    }

    public function mapEncontro($result){
        $encontros = array();
        foreach ($result as $reg) {
            $encontro = new Encontro();
            $encontro->setId_encontro($reg['id_encontro']);
            $encontro->setData($reg['data']);
            $encontro->setDescricao($reg['descricao']);

            array_push($encontros, $encontro);
        }

        return $encontros;
    }

    
    public function insert(encontro $encontro){
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_encontros (id_alcateia, data, descricao)" .
               " VALUES (:id_alcateia, :data, :descricao)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_alcateia', $encontro->getAlcateia()->getId_alcateia());
        $stm->bindValue(':data', $encontro->getData());
        $stm->bindValue(':descricao', $encontro->getDescricao());
        $stm->execute();
    }

    public function update(encontro $encontro) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_encontros SET id_alcateia = :id_alcateia , data = :data , descricao = :descricao" . 
               " WHERE id_encontro = :id";
           
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_alcateia", $encontro->getAlcateia()->getId_alcateia());
        $stm->bindValue("data", $encontro->getData());
        $stm->bindValue("descricao", $encontro->getDescricao());
        $stm->bindValue("id", $encontro->getId_encontro());
        $stm->execute();
    }
    
}