<!-- ============ FULL PRESTATIONS LIST ============ -->
<section role="section">
    <div class="prestation_list">

        <div class="section_header container">
            <div class="row title_container">
                <div class="title container">
                    <h2 class="dogma_title uppercase"><?= $layoutContent['sectionList'][2]['nom'] ?></h2>
                </div>
            </div>
        </div>

        <?php
        foreach ($prestationList as $prestation) {
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