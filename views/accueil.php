<section role="section">
    <div class="section_header container">
        <div class="row title_container">
            <div class="title container">
                <h2 class="dogma_title uppercase"><?= $layoutContent['sectionList'][1]['nom'] ?></h2>
            </div>
            <div class="row plus_accueil">
                <a class="button_black inter_secondary" href="films">Voir tous les films</a>
            </div>
        </div>
    </div>

    <div class="film_list">
        <div class="row film_list_row">

            <?php
            foreach ($filmLatest as $film) {
                if ($film['affichage'] == 1) {
            ?>
                    <a href="films/<?= $film['lien'] ?>" class="film container">
                        <div class="film_thumbnail">
                            <img src="<?= $film['miniature'] ?>" alt="Miniature <?= $film['type'] ?> <?= $film['nom'] ?>">
                            <div class="film_info container inter_secondary">
                                <div class="info container">
                                    <p class="light_gray_text">Réalisé par</p>
                                    <p class="white_text"><b><?= $film['realisateur'] ?></b></p>
                                </div>
                                <div class="info container">
                                    <p class="light_gray_text">Avec</p>
                                    <p class="white_text">
                                        <b>
                                            <?= $film['role_1'] ?><br>
                                            <?= $film['role_2'] ?><br>
                                            <?= $film['role_3'] ?><br>
                                        </b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="detail container">
                            <p class="gray_text inter_secondary"><?= $film['annee'] ?></p>
                            <h3 class="inter_title"><b><?= $film['nom'] ?></b></h3>
                        </div>
                    </a>
            <?php
                }
            }
            ?>

        </div>
    </div>
</section>

<section role="section">
    <div class="prestation_list">

        <div class="section_header container">
            <div class="row title_container">
                <div class="title container">
                    <h2 class="dogma_title uppercase"><?= $layoutContent['sectionList'][2]['nom'] ?></h2>
                </div>
                <div class="row plus_accueil">
                    <a class="button_black inter_secondary" href="prestations">Voir toutes les prestations</a>
                </div>
            </div>
        </div>

        <?php
        foreach ($prestationLatest as $prestation) {
            if ($prestation['affichage'] == 1) {
        ?>
                <a href="prestations/<?= $prestation['lien'] ?>">
                    <div class="prestation_container container">
                        <div class="thumbnail_container">
                            <img src="<?= $prestation['banner'] ?>" alt="Illustration de la prestation <?= $prestation["nom"] ?>">
                        </div>
                        <div class="prestation row">
                            <div class="prestation_title container">
                                <h3 class="dogma_subtitle uppercase"><?= $prestation["nom"] ?></h3>
                                <p class="dark_gray_text"><?= $prestation['client'] ?></p>
                            </div>

                            <div class="prestation_description container">
                                <div class="type inter_title row">
                                    <p><b><?= $prestation['type'] ?></b></p>
                                    <div class="button_white_border inter_secondary" href="prestations/<?= $prestation['lien'] ?>">En savoir plus</div>
                                </div>
                                <div class="description row">
                                    <p><?= $prestation['short_description'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
        <?php
            }
        }
        ?>

    </div>
</section>