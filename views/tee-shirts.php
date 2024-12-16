<?php
foreach ($articleList as $content) {
?>
    <div>
        <img src=".<?= $content['miniature'] ?>" style="width: 30px;">
        <a href="<?= $content['categorie'] ?>/<?= $content['lien'] ?>"><?= $content['nom'] ?></a>
        <p><?= number_format($content['prix'],2) ?> €</p>
        <?php
        if (!empty($content['rabais'])) {
        ?>
            <p>-<?= $content['rabais'] ?>%</p>
        <?php
        } elseif (!empty($content['prix_force'])) {
        ?>
            <p><?= $content['prix_force'] ?></p>
        <?php
        }
        ?>

    </div>
<?php
}
?>