<?php

class Frequencia {
    
    private $id_frequencia; 
     
    private $usuario; 
    private $id_usuario;

    private $encontro;
    private $id_encontro;


    /**
     * Get the value of id_frequencia
     */ 
    public function getId_frequencia()
    {
        return $this->id_frequencia;
    }

    /**
     * Set the value of id_frequencia
     *
     * @return  self
     */ 
    public function setId_frequencia($id_frequencia)
    {
        $this->id_frequencia = $id_frequencia;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of id_usuario
     */ 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */ 
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of encontro
     */ 
    public function getEncontro()
    {
        return $this->encontro;
    }

    /**
     * Set the value of encontro
     *
     * @return  self
     */ 
    public function setEncontro($encontro)
    {
        $this->encontro = $encontro;

        return $this;
    }

    /**
     * Get the value of id_encontro
     */ 
    public function getId_encontro()
    {
        return $this->id_encontro;
    }

    /**
     * Set the value of id_encontro
     *
     * @return  self
     */ 
    public function setId_encontro($id_encontro)
    {
        $this->id_encontro = $id_encontro;

        return $this;
    }
}