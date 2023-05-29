<?php
    require_once(__DIR__ . "/../include/header.php");
    require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container">
    <div class="col-9">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>

    <div class="row" style="margin-top: 10px;">
            <div class="col-12">
                <table id="tabAlcateias" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados["lista"] as $alc): ?>
                            <tr>
                                <td><?php echo $alc->getId_alcateia(); ?></td>
                                <td><?= $alc->getNome(); ?></td>
                                <td><a class="btn btn-primary" 
                                    href="<?= BASEURL ?>/controller/AlcateiaController.php?action=edit&id=<?= $alc->getId_alcateia() ?>">
                                    Alterar</a> 
                                </td>
                                <td><a class="btn btn-danger" onclick="return confirm('Deseja excluir a alcateia?')" href="<?= BASEURL ?>/controller/AlcateiaController.php?action=delete&id=<?= $alc->getId_alcateia() ?>">
                                    Excluir</a> 
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