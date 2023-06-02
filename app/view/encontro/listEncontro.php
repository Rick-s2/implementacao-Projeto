<?php
    require_once(__DIR__ . "/../include/header.php");
    require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" href="<?= BASEURL ?>/controller/EncontroController.php?action=create">Inserir</a>
        </div>
        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
            <div class="col-12">
                <table id="tabencontros" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados["lista"] as $alc): ?>
                            <tr>
                                <td><?php echo $alc->getData(); ?></td>
                                <td><?= $alc->getDescricao(); ?></td>
                                <td><a class="btn btn-primary" 
                                    href="<?= BASEURL ?>/controller/EncontroController.php?action=edit&id=<?= $alc->getId_encontro() ?>">
                                    Alterar</a> 
                                </td>
                                <td><a class="btn btn-danger" onclick="return confirm('Deseja excluir ?')" href="<?= BASEURL ?>/controller/encontroController.php?action=delete&id=<?= $alc->getId_encontro() ?>">
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