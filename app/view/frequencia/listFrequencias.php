<?php

    require_once(__DIR__ . "/../include/header.php");
    require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container">
    <div class="row">
     
        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
            <div class="col-12">
                <table id="tabfrequencias" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>frequencia</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados["lista"] as $freq): ?>
                            <tr>
                                <td><?php echo $freq->getUsuario()->getNome(); ?></td>
                                <td>
                                    <?php 
                                    if ($freq->getFrequencia() == 1) {
                                        echo "<a class='btn btn-outline-success'
                                         onclick=\"return confirm('Deseja alterar o status do usuário para INATIVO?')\" href='". BASEURL .
                                         "/controller/FrequenciaController.php?action=updateToFalse&id=". $freq->getId_frequencia() .
                                         "&idAlcateia=". $freq->getUsuario()->getIdAlcateia() ."&idEncontro=". $freq->getId_encontro() ."'>C</a>";
                                    } else {
                                        echo "<a class='btn btn-outline-danger'
                                         onclick=\"return confirm('Deseja alterar o status do usuário para ATIVO?')\" href='". BASEURL .
                                         "/controller/FrequenciaController.php?action=updateToTrue&id=". $freq->getId_frequencia() .
                                         "&idAlcateia=". $freq->getUsuario()->getIdAlcateia() ."&idEncontro=". $freq->getId_encontro() ."'>F</a>";
                                    }
                                    ?>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>

<?php
    require_once(__DIR__ . "/../include/footer.php");
?>