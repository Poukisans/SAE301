<!-- ============ FULL PRESTATIONS LIST ============ -->
<section role="section">
    <div class="section_header container">
        <div class="row title_container">
            <div class="title container">
            <h2 class="dogma_title uppercase"><?= $layoutContent['sectionList'][2]['nom'] ?></h2>
            </div>
        </div>
    </div>

    <div class="prestation_list">
        <?php
        foreach ($prestationList as $prestation) {
        ?>
            <div class="prestation_container container">
                <div class="thumbnail_container">
                    <img src="<?= $prestation['banner'] ?>" alt="">
                </div>
                <div class="prestation row">
                    <div class="prestation_title container">
                        <p class="dogma_subtitle"><?= $prestation['titre_projet'] ?></p>
                        <p class="dark_gray_text"><?= $prestation['client'] ?></p>
                    </div>

                    <div class="prestation_description container">
                        <div class="type inter_title row">
                            <p><b><?= $prestation['type_projet'] ?></b></p>
                            <a class="button_white_border inter_secondary" href="prestations/<?= $prestation['lien'] ?>">En savoir plus</a>
                        </div>
                        <div class="description row">
                            <p><?= $prestation['short_description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>