<div class="bread_crumb">
    <a class="grey" href="#">Accueil</a>
    > <a class="grey" href="tee-shirts">Tee-shirts</a>
    > <a class="grey" href="tee-shirts/<?= $currentCategory ?>"><?= ucfirst($currentCategory) ?></a>
    > <a class="grey" href="tee-shirts/<?= $currentArticle ?>"><?= ucfirst($currentArticle) ?></a>
</div>

<section role="section">
    <div class="vue_article">
        <div class="galerie_article">
            <img id="image_article" class="image_article" src="<?= $articlePhotosInfo[0]['img_article'] ?>" alt="">

            <div class="row fleche">
                <button id="prev"><img src="assets/logo/fleche_gauche.svg" alt="" style="width: 1rem;"></button>
                <button id="next"><img src="assets/logo/fleche_droite.svg" alt="" style="width: 1rem;"></button>
            </div>
        </div>

        <div class="infos_article">
            <h2 class="inter_title"><?= $articleInfo['nom'] ?></h2>
            <div class="infos_row">
                <div class="container_note">
                    <div class="star"></div>
                    <p class="note"><?= $articleInfo['note'] ?></p>
                </div>
                <p class="avis"><?= count($articleCommentaireInfo) ?> avis</p>
            </div>
            <p class="desc_article">
                <?= $articleInfo['description'] ?>
            </p>
            <div class="infos_row">
                <p class="coloris">Coloris</p>
                <p id="nom_coloris" class="couleur"> </p>
            </div>
            <form class="column" action="commande" method="post">
                <div class="infos_row">
                    <?php
                    foreach ($articleColorisInfo as $coloris) {
                    ?>
                        <label class="row" for="<?= $coloris['nom'] ?>">
                            <input type="radio" name="coloris" id="<?= $coloris['nom'] ?>" value="<?= $coloris['id'] ?>" hidden="" <?= $first ? 'checked' : '' ?> class="checkbox-input">
                            <span class="checkbox" style="background-color: <?= $coloris['coloris'] ?>;"></span>
                        </label>
                    <?php
                    }
                    ?>
                </div>
                <div>
                    <p class="coloris mb">Taille</p>
                    <div class="custom_taille">
                        <select name="taille" id="taille">
                            <option value="null" selected="selected">Choisir</option>
                            <option value="1">XXS</option>
                            <option value="2">XS</option>
                            <option value="3">S</option>
                            <option value="4">M</option>
                            <option value="5">L</option>
                            <option value="6">XL</option>
                            <option value="7">XXL</option>
                        </select>
                    </div>
                </div>
                <div class="container_prix">

                    <?php
                    if (!empty($articleInfo['promotion'])) {

                        if ($articleInfo['type_promotion'] == 0) {
                    ?>
                            <p class="prix_prom_details"><?= number_format($articleInfo['promotion'], 2) ?>€</p>
                            <p class="prix_barre_details"><?= $articleInfo['prix'] ?>€</p>
                            <p class="tag_solde_details">-<?= $articleInfo['taux_promotion'] ?>%</p>

                        <?php
                        } elseif ($articleInfo['type_promotion'] == 1) {
                        ?>
                            <p class="prix_prom_details"><?= $articleInfo['promotion'] ?>€</p>
                            <p class="prix_barre_details"><?= $articleInfo['prix'] ?>€</p>

                        <?php
                        } elseif ($articleInfo['type_promotion'] == 2) {
                        ?>
                            <p class="prix_details"><?= $articleInfo['prix'] ?>€</p>
                        <?php
                        }
                    } else {
                        ?>
                        <p class="prix_details"><?= $articleInfo['prix'] ?>€</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="infos_row">
                    <button type="submit" class="button_red large">Ajouter au panier</button>
                </div>
            </form>
        </div>
    </div>
    <p class="inter_other mb p">Détails</p>
    <div class="details_article mb">
        <div class="details_row">
            <p class="b">Livraison</p>
            <p>Sous 3 à 5 jours ouvrés.</p>
        </div>
        <div class="details_row">
            <p class="b">Garantie</p>
            <p>2 ans</p>
        </div>
        <div class="details_row">
            <p class="b">Retour</p>
            <p>Sous 30 jours.</p>
        </div>
        <div class="details_row">
            <p class="b">Composition</p>
            <p><?= $articleInfo['composition'] ?></p>
        </div>
        <div class="details_row">
            <p class="b">Taille</p>
            <p><?= $articleInfo['taille'] ?></p>
        </div>
        <div class="details_row">
            <p class="b">Entretien</p>
            <p><?= $articleInfo['entretien'] ?></p>
        </div>
        <div class="details_row">
            <p class="b">Fabrication</p>
            <p><?= $articleInfo['fabrication'] ?></p>
        </div>
    </div>
    <p class="inter_other mb p">Avis</p>
    <div class="details_article mb">
        <div class="details_row">
            <p class="inter_other_2 italic b mb"><?= $articleInfo['note'] ?> sur 5</p>
            <a class="link_underline red_text" href="">Voir <?= count($articleCommentaireInfo) ?> avis</a>
        </div>
        <?php
        foreach ($articleCommentaireInfo as $commentaire) {
        ?>
            <div class="avis_row mb">
                <div class="avis_titre">
                    <p class="inter_text b"><?= $commentaire['commentaire'] ?></p>
                </div>
                <div class="avis_down">
                    <p><?= $commentaire['note'] ?> sur 5</p>
                    <p>
                        <?= $commentaire['prenom'] ?> <?= $commentaire['nom'] ?> |

                        <?php
                        // Différence entre ajd et date comm
                        $interval = (new DateTime())->diff(new DateTime($commentaire['date']));

                        // Choix texte en fonction date
                        if ($interval->y > 0) {
                            $timeAgo = "il y a " . $interval->y . " an(s)";
                        } elseif ($interval->m > 0) {
                            $timeAgo = "il y a " . $interval->m . " mois";
                        } elseif ($interval->d > 0) {
                            if ($interval->d > 7) {
                                $weeks = floor($interval->d / 7);
                                $timeAgo = "il y a " . $weeks . " semaine(s)";
                            } else {
                                $timeAgo = "il y a " . $interval->d . " jour(s)";
                            }
                        } elseif ($interval->h > 0) {
                            $timeAgo = "il y a " . $interval->h . " heure(s)";
                        } elseif ($interval->i > 0) {
                            $timeAgo = "il y a " . $interval->i . " minute(s)";
                        } else {
                            $timeAgo = "il y a quelques secondes";
                        }

                        echo $timeAgo;
                        ?>

                    </p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>

<script>
    // tableau des images
    const images = <?php echo json_encode(array_column($articlePhotosInfo, 'img_article')); ?>;
    let currentIndex = 0; // index de l'image 0

    const imageElement = document.getElementById('image_article');

    function showImage(index) {
        imageElement.src = images[index];
    }

    //bouton précédent
    document.getElementById('prev').addEventListener('click', function() {
        if (currentIndex === 0) {
            currentIndex = images.length - 1;
        } else {
            currentIndex--;
        }
        showImage(currentIndex);
    });

    // bouton suivant
    document.getElementById('next').addEventListener('click', function() {
        if (currentIndex === images.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }
        showImage(currentIndex);
    });
</script>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        const nomColorisElement = document.getElementById('nom_coloris');
        nomColorisElement.textContent = "<?= $articleColorisInfo[0]['nom'] ?>";

        const radios = document.querySelectorAll('.checkbox-input');
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked) {
                    nomColorisElement.textContent = radio.id;
                }
            });
        });
    });
</script>