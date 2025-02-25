<?php
#Nome do arquivo: UsuarioDAO.php
#Objetivo: classe DAO para o model de Usuario

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u ORDER BY u.nome";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u" .
               " WHERE u.id_usuario = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }


    //Método para buscar um usuário por seu login e senha
    public function findByLoginSenha(string $login, string $senha) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u" .
               " WHERE u.login = ? AND u.senha = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$login, $senha]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByLoginSenha()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_usuarios (id_endereco, id_contato, nome, cpf, login, senha, papeis)" .
               " VALUES (:id_endereco, :id_contato, :nome, :cpf, :login, :senha, :papeis)";
        $stm = $conn->prepare($sql);
        
        $stm->bindValue("id_endereco", $usuario->getEndereco()->getId_endereco());
        $stm->bindValue("id_contato", $usuario->getContato()->getId_contato());
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("cpf", $usuario->getCpf());
        $stm->bindValue("login", $usuario->getLogin());
        $stm->bindValue("senha", $usuario->getSenha());
        $stm->bindValue("papeis", $usuario->getPapeis());
        //print_r($usuario);
        $stm->execute();

    }

    //Método para atualizar um Usuario
    public function update(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_usuarios SET nome = :nome, cpf = :cpf, login = :login," . 
               " senha = :senha, papeis = :papeis" .   
               " WHERE id_usuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("cpf", $usuario->getCpf());
        $stm->bindValue("login", $usuario->getLogin());
        $stm->bindValue("senha", $usuario->getSenha());
        $stm->bindValue("papeis", $usuario->getPapeis());
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM tb_usuarios WHERE id_usuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }
    public function updateToInativo(){
        $conn = Connection::getConn();
        $sql = "UPDATE tb_usuarios SET status_usuario = 'INATIVO' WHERE id_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $_GET['id']);
        $stm->execute();
    }
    public function updateToAtivo(){
        $conn = Connection::getConn();
        $sql = "UPDATE tb_usuarios SET status_usuario = 'ATIVO' WHERE id_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $_GET['id']);
        $stm->execute();
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    private function mapUsuarios($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id_usuario']);
            $usuario->setNome($reg['nome']);
            $usuario->setCpf($reg['cpf']);
            $usuario->setLogin($reg['login']);
            $usuario->setSenha($reg['senha']);
            $usuario->setPapeis($reg['papeis']);
            $usuario->setStatus($reg['status_usuario']);

            //Seta os campos provisórios
            $usuario->setIdEndereco($reg['id_endereco']);
            $usuario->setIdContato($reg['id_contato']);

            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

}