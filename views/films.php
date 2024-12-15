<!-- ============ FULL FILM LIST ============ -->

<section role="section">
    <div class="section_header container">
        <div class="row title_container">
            <div class="title container">
                <h2 class="dogma_title uppercase"><?= $layoutContent['sectionList'][1]['nom'] ?></h2>
            </div>
            <div class="search_filter row">
                <form action="films" method="get">
                    <input name="q" class="input_white inter_secondary" type="text" placeholder="Film, genre, réalisateur, comédiens..." aria-label="Rechercher parmis les films">
                    <button class="button_black inter_secondary" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
        <?php
        if (isset($_GET['q'])) {
        ?>
            <div class="search_title row">
                <p class="inter_secondary">Résultats de la recherche pour <b>"<?= $_GET['q'] ?>"</b></p>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="film_list">

        <?php
        if (isset($_GET['q'])) {
        ?>

            <?php
            if (empty($searchResult)) {
            ?>
                <div class="row">
                    <p class="result dogma_subtitle uppercase">Aucun résultat</p>
                </div>
            <?php
            } else {
            ?>

                <div class="row film_list_row">

                    <?php
                    foreach ($searchResult as $film) {
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
                }
            } else {
                ?>

                <div class="row film_list_row">
                    <?php
                    foreach ($filmList as $film) {
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
                }
                ?>
                </div>

                </div>
    </div>
</section>