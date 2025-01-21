<section role="section">
    <div class="section_header container">
        <div class="row title_container">
            <div class="banner_sup">
                <h3 class="inter_title banner_text">Découvrez Birbone</h3>
                <img class="img_banner" src="<?= $layoutContent['banner'] ?>" alt="">
            </div>
        </div>
    </div>

    <div class="section_header container">
        <div class="row title_container">
            <div class="title container">
                <h2 class="inter_title uppercase">Promotions</h2>
            </div>
            <div class="row plus_accueil">
                <a class="button_red inter_secondary" href=".<?= $section['lien'] ?>">Voir toutes les promotions</a>
            </div>
        </div>
    </div>

    <!-- PROMOTION -->
    <div class="article_list">
        <?php
        foreach ($articleList as $content) {
            if (!is_null($content['type_promotion'])) {
        ?>
                <div class="article">
                    <a class="nom_article" href="tee-shirts/<?= $content['categorie'] ?>/<?= $content['lien'] ?>">
                        <img class="miniature" src="<?= $content['miniature'] ?>"></a>
                    <div class="article_text">
                        <div class="nom_prix">
                            <a class="nom_article" href="tee-shirts/<?= $content['categorie'] ?>/<?= $content['lien'] ?>"><?= $content['nom'] ?></a>
                            <div class="container_prix">
                                <?php
                                if ($content['type_promotion'] == 0 && !is_null($content['type_promotion'])) {
                                ?>
                                    <p class="prix_prom"><?= $content['prix'] ?>€</p>
                                    <p class="prix_barre"><?= $content['prix_origine'] ?>€</p>
                                    <p class="tag_solde">-<?= $content['taux_promotion'] ?>%</p>

                                <?php
                                } elseif ($content['type_promotion'] == 1 && !is_null($content['type_promotion'])) {
                                ?>
                                    <p class="prix_prom"><?= $content['prix'] ?>€</p>
                                    <p class="prix_barre"><?= $content['prix_origine'] ?>€</p>
                                <?php

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
        }
        ?>
    </div>

    <!-- A LA UNE -->
    <div class="section_header container">
        <div class="row title_container">
            <div class="title container">
                <h2 class="inter_title uppercase">Nos Tee-shirts</h2>
            </div>
            <div class="row plus_accueil">
                <a class="button_red inter_secondary" href=".<?= $section['lien'] ?>">Voir tous les tee-shirts</a>
            </div>
        </div>
    </div>

    <div class="article_list">
        <?php
        foreach ($articleList as $content) {
            if ($content['affichage_accueil'] == 1) {
        ?>
                <div class="article">
                    <a class="nom_article" href="tee-shirts/<?= $content['categorie'] ?>/<?= $content['lien'] ?>">
                        <img class="miniature" src="<?= $content['miniature'] ?>"></a>
                    <div class="article_text">
                        <div class="nom_prix">
                            <a class="nom_article" href="tee-shirts/<?= $content['categorie'] ?>/<?= $content['lien'] ?>"><?= $content['nom'] ?></a>
                            <div class="container_prix">
                                <?php
                                if ($content['type_promotion'] == 0 && !is_null($content['type_promotion'])) {
                                ?>
                                    <p class="prix_prom"><?= $content['prix'] ?>€</p>
                                    <p class="prix_barre"><?= $content['prix_origine'] ?>€</p>
                                    <p class="tag_solde">-<?= $content['taux_promotion'] ?>%</p>

                                <?php
                                } elseif ($content['type_promotion'] == 1 && !is_null($content['type_promotion'])) {
                                ?>
                                    <p class="prix_prom"><?= $content['prix'] ?>€</p>
                                    <p class="prix_barre"><?= $content['prix_origine'] ?>€</p>
                                <?php

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
        }
        ?>
    </div>
</section>