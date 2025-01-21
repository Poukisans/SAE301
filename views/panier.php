<section role="section">
    <div class="header_panier container">
        <div class="title container">
            <h2 class="inter_title">Panier</h2>
        </div>
        <div class="title container">
            <h2 class="inter_title">Récapitulatif</h2>
        </div>
    </div>

    <div class="vue_article">
        <div class="column">

            <div class="infos_article">
                <p class="inter_other2 grey b"><?= isset($_SESSION['basket']) ? count($_SESSION['basket']) : "0" ?> articles</p>

                <?php
                if (isset($_SESSION['basket'])) {
                    foreach ($_SESSION['basket'] as $content) {
                ?>

                        <div class="infos_row mb">
                            <img class="image_panier" src="<?= $content['miniature'] ?>" alt="">
                            <div class="infos_article">
                                <div class="nom_prix">
                                    <a class="nom_article mb" href="tee-shirts/<?= $content['categorie'] ?>/<?= $content['lien'] ?>"><?= $content['nom'] ?></a>
                                    <p class="inter_text grey">Coloris : <?= $content['coloris'] ?></p>
                                    <p class="inter_text grey mb">Taille :
                                        <?php
                                        switch ($content['taille']) {
                                            case 1:
                                                echo "XXS";
                                                break;
                                            case 2:
                                                echo "XS";
                                                break;
                                            case 3:
                                                echo "S";
                                                break;
                                            case 4:
                                                echo "M";
                                                break;
                                            case 5:
                                                echo "L";
                                                break;
                                            case 6:
                                                echo "XL";
                                                break;
                                            case 7:
                                                echo "XXL";
                                                break;
                                        }
                                        ?>
                                    </p>
                                    <div class="container_prix">
                                        <?php
                                        if (!is_null($content['type_promotion'])) {

                                            if ($content['type_promotion'] == 0) {
                                        ?>
                                                <p class="prix_prom"><?= $content['prix'] ?>€</p>
                                                <p class="prix_barre"><?= $content['prix_origine'] ?>€</p>
                                                <p class="tag_solde">-<?= $content['taux_promotion'] ?>%</p>

                                            <?php
                                            } elseif ($content['type_promotion'] == 1) {
                                            ?>
                                                <p class="prix_prom"><?= $content['prix'] ?>€</p>
                                                <p class="prix_barre"><?= $content['prix_origine'] ?>€</p>

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
                                <div class="counter-container" data-id="<?= $content['id_article'] ?>">
                                    <button class="counter-button" id="decrement">-</button>
                                    <p class="counter-value" id="counter"><?= $content['quantite'] ?></p>
                                    <button class="counter-button" id="increment">+</button>
                                </div>
                                <form action="" method="post">
                                    <button class="link_underline" name="removeArticle" value="<?= $content['id_article'] ?>" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <?php
        $totalPrice = 0;
        if (isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $item) {
                $totalPrice += $item['prix'] * $item['quantite'];
            }
        }
        ?>

        <div class="grid_recap">
            <p class="inter_other2"><?= isset($_SESSION['basket']) ? count($_SESSION['basket']) : "0" ?> articles</p>
            <div class="recap_row">
                <p class="inter_other2 b">Sous total</p>
                <p class="inter_other2 b"><?= $totalPrice ?>€</p>
            </div>
            <div class="recap_row">
                <p class="inter_other2 b">Livraison</p>
                <p class="small_text">Calculée lors du paiement</p>
            </div>
            <div class="recap_row_total">
                <p class="inter_other2 b">Total</p>
                <p class="inter_other b"><?= $totalPrice ?>€</p>
            </div>
            <button type="submit" class="button_red large">Payer</button>
        </div>
    </div>
</section>

<script>
    const counterElement = document.getElementById('counter');
    const decrementButton = document.getElementById('decrement');
    const incrementButton = document.getElementById('increment');

    let counterValue = 0;

    decrementButton.addEventListener('click', () => {
        if (counterValue > 0) {
            counterValue--;
            counterElement.textContent = counterValue;
        }
    });

    incrementButton.addEventListener('click', () => {
        counterValue++;
        counterElement.textContent = counterValue;
    });
</script>