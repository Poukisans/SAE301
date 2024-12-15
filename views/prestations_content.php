<section role="section">
    <!-- ============ PRESTATION HEADER ============ -->
    <div class="section_header container prestation_header">
        <div class="row title_container">
            <div class="title container">
                <h2 class="dogma_title uppercase"><?= $prestationInfo["nom"] ?></h2>
            </div>
            <div class="info_prestation container">
                <div class="row info">
                    <div class="row_text">
                        <h3 class="gray_text">Type de projet : </h3>
                        <p><b class="black_text"><?= $prestationInfo['type'] ?></b></p>
                    </div>

                    <div class="row_text">
                        <p class="gray_text">Année : <b class="black_text"><?= $prestationInfo['annee'] ?></b></p>
                    </div>
                </div>

                <?php
                if (isset($prestationInfo['client'])) {
                ?>

                    <div class="row">
                        <div class="row_text">
                            <h3 class="gray_text">Client : </h3>
                            <p><b class="black_text"><?= $prestationInfo['client'] ?></b></p>
                        </div>
                        <?php
                        if (isset($prestationInfo['site_client'])) {
                        ?>
                            <div class="row_text">
                                <a class="link_underline" href="<?= $prestationInfo['site_client'] ?>" target="_blank"><b>Site Web</b></a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>

    <!-- ============ DETAILS PRESTATION ============ -->

    <div class="prestation_details">
        <div class="row prestation_container">
            <div class="container video_container white_text">
                <h3 class="dogma_subtitle uppercase">Détails</h3>

                <?php
                if (!empty($prestationInfo['video'])) {
                ?>
                    <div class="video">
                        <iframe src="https://www.youtube.com/embed/<?= $prestationInfo['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                <?php
                }
                ?>
                <?php
                if (!empty($prestationInfo['texte'])) {
                ?>
                    <div class="text inter_secondary">
                        <?= $prestationInfo['texte'] ?>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="container description">
                <h4 class="inter_title">Description</h4>
                <?= $prestationInfo['description'] ?>
            </div>
        </div>

        <!-- Gallerie image -->
        <div class="gallery container">
            <div class="row gallery_title">
                <h3 class="dogma_subtitle white_text uppercase"><b>Galerie du projet</b></h3>
            </div>

            <?php
            foreach ($prestationPicture as $picture) {
            ?>
                <div class="container">
                    <img src="<?= $picture['img_projet'] ?>" aria-label="Illustration de la prestation">
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Contact -->
        <div class="row contact">
            <div class="row">
                <h2 class="dogma_title uppercase">Devis sur mesure</h2>
                <a class="button_black inter_secondary" href="./contact">Contact</a>
            </div>

            <div class="row">
                <a class="button_white_border inter_secondary" href="./prestations">Plus de projets</a>
            </div>
        </div>
    </div>
</section>