<div class="bread_crumb">
    <a class="grey" href="#">Accueil</a> > <a class="grey" href="tee-shirts">Tee-shirts</a>
    <?= !empty($currentCategory) ? "> <a class='grey' href='tee-shirts/" . $currentCategory . "'> " . ucfirst($currentCategory) . "</a>" : "" ?>
</div>

<div class="section_header container">
    <div class="row title_container">
        <div class="banner_sup">
            <h3 class="inter_title banner_text">Nos <?= strtolower($layoutContent['current_section']) ?></h3>
            <img class="img_banner" src="<?= $layoutContent['banner'] ?>" alt="">
        </div>
    </div>
</div>

<div class="mini_bar">
    <p class="nombre_article_list"><?= count($articleList) ?> articles</p>
    <div class="custom_filtre">
        <form action="" method="get">
            <select name="filtre" id="filtres" onchange="this.form.submit()">
                <option value="croissant">Prix croissant</option>
                <option value="decroissant">Prix décroissant</option>
            </select>
        </form>
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
    ?>
</div>