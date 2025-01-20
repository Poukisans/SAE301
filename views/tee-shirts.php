<div class="bread_crumb">
    <a class="grey" href="#">Accueil</a> > <a class="grey" href="tee-shirts">Tee-shirts</a>
    <?=!empty($currentCategory) ? "> <a class='grey' href='tee-shirts/".$currentCategory."'> ".ucfirst($currentCategory)."</a>" : ""?>
</div>

<div class="section_header container">
    <div class="row title_container">
        <div class="banner_sup">
            <h3 class="inter_title banner_text">Nos tee-shirts</h3>
            <img class="img_banner" src="<?= $layoutContent['banner'] ?>" alt="">
        </div>
    </div>
</div>

<div class="mini_bar">
    <p class="nombre_article_list"><?= count($articleList) ?> articles</p>
    <div class="custom_filtre">
        <select name="filtres" id="filtres">
            <option value="prix_croissant">Prix croissant </option>
            <option value="prix_decroissant">Prix décroissant </option>
        </select>
    </div>
</div>

<div class="article_list">
    <?php
    foreach ($articleList as $content) {
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