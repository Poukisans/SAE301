<div class="section_header container">
    <div class="row title_container">
        <div class="title container">
            <h2 class="inter_title"><?=count($searchResult)?> résultats pour <span class="grey">"<?=$_GET['q']?>"</span></h2>
        </div>
    </div>
</div>

<div class="article_list">
    <?php
    foreach ($searchResult as $content) {
    ?>
        <div class="article">
            <a class="nom_article" href="tee-shirts/<?= $content['categorie'] ?>/<?= $content['lien'] ?>">
                <img class="miniature" src="<?= $content['miniature'] ?>"></a>
            <div class="article_text">
                <div class="nom_prix">
                    <a class="nom_article" href="tee-shirts/<?= $content['categorie'] ?>/<?= $content['lien'] ?>"><?= $content['nom'] ?></a>
                    <div class="container_prix">
                        <?php
                        if (!empty($content['promotion'])) {

                            if ($content['type_promotion'] == 0) {
                        ?>
                                <p class="prix_prom"><?= number_format($content['promotion'], 2) ?>€</p>
                                <p class="prix_barre"><?= $content['prix'] ?>€</p>
                                <p class="tag_solde">-<?= $content['taux_promotion'] ?>%</p>

                            <?php
                            } elseif ($content['type_promotion'] == 1) {
                            ?>
                                <p class="prix_prom"><?= number_format($content['promotion'], 2) ?>€</p>
                                <p class="prix_barre"><?= $content['prix'] ?>€</p>

                            <?php
                            } elseif ($content['type_promotion'] == 2) {
                            ?>
                                <p class="prix"><?= $content['prix'] ?>€</p>
                            <?php
                            }
                        } else {
                            ?>
                            <p class="prix"><?= $content['prix'] ?>€</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                if (!empty($content['commentaire'])) {
                ?>
                    <div class="note_avis">
                        <div class="container_note">
                            <div class="star"></div>
                            <p class="note"><?= $content['note'] ?></p>
                        </div>
                        <p class="avis"><?= $content['commentaire'] ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>