<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
require_once(__DIR__ . "/../../model/enum/UsuarioPapel.php");
?>
<div>


    <div>
        <li><?= $dados['usuario']->getNome(); ?></li>
    </div>

    <div>
        <li><?= $dados['usuario']->getLogin(); ?></li>
    </div>

    <div>
        <li><?= $dados['usuario']->getPapeisStr(); ?></li>
    </div>

    <div>
        <li><?= $dados['usuario']->getSenha(); ?></li>
    </div>

<h1>Endereco </h1>
    <div>
        <li><?= $dados['usuario']->getEndereco()->getCep(); ?></li>
    </div>

    <div>
        <li><?=$dados['usuario']->getEndereco()->getLogradouro(); ?></li>
    </div>

    <div>
        <li><?= $dados['usuario']->getEndereco()->getNumeroEndereco(); ?></li>
    </div>

    <div>
        <li><?= $dados['usuario']->getEndereco()->getBairro(); ?></li>
    </div>

    <div>
        <li><?= $dados['usuario']->getEndereco()->getCidade(); ?></li>
    </div>

    <div>
        <li><?= $dados['usuario']->getEndereco()->getPais(); ?></li>
    </div>
    
    <h1>Contato </h1>
    <div>
        <li><?= $dados['usuario']->getContato()->getTelefone(); ?></li>
    </div>
    <div>
        <li><?= $dados['usuario']->getContato()->getCelular(); ?></li>
    </div>
    <div>
        <li><?= $dados['usuario']->getContato()->getEmail(); ?></li>
    </div>
</div>