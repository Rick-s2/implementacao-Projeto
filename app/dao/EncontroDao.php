<?php 

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Encontro.php");


class EncontroDao {
     public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros a ORDER BY a.data";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapEncontro($result);
    }

    public function findById(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros a" .
               " WHERE a.id_encontro = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $encontros = $this->mapEncontro($result);

        if(count($encontros) == 1)
            return $encontros[0];
        elseif(count($encontros) == 0)
            return null;

        die("encontroDAO.findById()" . 
            " - Erro: mais de uma encontro encontrada.");
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

    /*
    public function insert(encontro $encontro){
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_encontros (nome)" .
               " VALUES (:nome)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue(':nome', $encontro->getNome());
        $stm->execute();
    }

    public function update(encontro $encontro) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_encontros SET nome = :nome" . 
               " WHERE id_encontro = :id";
           
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $encontro->getNome());
        $stm->bindValue("id", $encontro->getId_encontro());
        $stm->execute();
    }
    
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM tb_encontros WHERE id_encontro = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }
    */
}