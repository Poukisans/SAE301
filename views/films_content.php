<?php
$months = [
    'January' => 'Janvier',
    'February' => 'Février',
    'March' => 'Mars',
    'April' => 'Avril',
    'May' => 'Mai',
    'June' => 'Juin',
    'July' => 'Juillet',
    'August' => 'Août',
    'September' => 'Septembre',
    'October' => 'Octobre',
    'November' => 'Novembre',
    'December' => 'Décembre'
];

?>
<!-- ============ FILM HEADER ============ -->
<section role="section">
    <div class="section_header container film_header">
        <div class="row title_container">
            <div class="title container">
                <h2 class="dogma_title uppercase"><?= $filmInfo["nom"] ?></h2>
                <div class="info_film row">
                    <h3 class="inter_title dark_gray_text">
                        <?php
                                switch ($filmInfo['type_genre']) {
                                    case 0:
                                        echo "Un ";
                                        break;
                                    case 1:
                                        echo "Une ";
                                        break;
                                }
                        ?>
                                <?= $filmInfo['type_film'] ?> de <?= $filmInfo['realisateur'] ?>
                    </h3>
                    <p> <span class="dark_gray_text">Date de sortie : </span>
                        <b>
                            <?php
                            if ($filmInfo['affichage_date_sortie'] == 1) {
                                echo empty($filmInfo['date_sortie']) ? "Prochainement" : strtr(date("d F Y", strtotime($filmInfo["date_sortie"])), $months);
                            } else {
                                echo "Prochainement";
                            }
                            ?>
                        </b>
                    </p>
                </div>
            </div>
        </div>

        <div class="film_synopsis_container row">
            <div class="film_synopsis">
                <div class="synopsis inter_text">
                    <p><?= $filmInfo['synopsis'] ?></p>
                </div>
            </div>
            <div class="film_poster">
                <img src="<?= $filmInfo['affiche'] ?>" aria-label="Affiche du film <?= $filmInfo['nom'] ?>">
            </div>
        </div>
    </div>

    <!-- ============ DETAILS FILM ============ -->

    <div class="film_details">

        <div class="container">
            <div class="dogma_subtitle">
                <h3 class="uppercase">Bande-annonce</h3>
            </div>

            <div class="container">
                <div class="row">
                    <div class="ba container">
                        <?php
                        if (!empty($filmInfo['bande_annonce'])) {
                        ?>
                            <iframe src="https://www.youtube.com/embed/<?= $filmInfo['bande_annonce'] ?>" aria-label="Bande annonce <?= $filmInfo['nom'] ?>" title="Bande annonce <?= $filmInfo['nom'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <?php
                        } else {
                        ?>
                            <div class="noba">
                                <p class="inter-title white_text"><b>Prochainement</b></p>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if (!empty($filmSocialList[0]['nom']) && !empty($filmSocialList[0]['lien'])) {
                        ?>
                            <div class="socials container">
                                <p class="dogma_other uppercase">Suivre</p>
                                <div class="socials_buttons inter_secondary">
                                    <?php
                                    foreach ($filmSocialList as $social) {
                                    ?>
                                        <a class="button_white_border" href="<?= $social['lien'] ?>" target="_blank"><?= $social['nom'] ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="socials container">
                                <h3 class="dogma_other uppercase">Suivre</h3>
                                <div class="socials_buttons inter_secondary">
                                    <?php
                                    foreach ($layoutContent['socialList'] as $social) {
                                    ?>
                                            <a class="button_white_border" href="<?= $social['lien'] ?>" target="_blank"><?= $social['nom'] ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>

                    <div class="details container">
                        <ul>
                            <li>
                                <p class="gray_text">Genre : </p><b><?= $filmInfo['genre'] ?></b>
                            </li>
                            <li>
                                <p class="gray_text">Durée : </p><b><?= $filmInfo['duree'] ?></b>
                            </li>
                            <li>
                                <p class="gray_text">Format : </p><b><?= $filmInfo['format'] ?></b>
                            </li>
                            <li>
                                <p class="gray_text">Format de projection : </p><b><?= $filmInfo['format_projection'] ?></b>
                            </li>
                            <li>
                                <p class="gray_text">Pays : </p><b><?= $filmInfo['pays'] ?></b>
                            </li>
                            <li>
                                <p class="gray_text">Année de production : </p><b><?= $filmInfo['annee'] ?></b>
                            </li>
                            <li>
                                <p class="gray_text">Langue : </p><b><?= $filmInfo['langue'] ?></b>
                            </li>
                            <li>
                                <p class="gray_text">Sous-titres : </p><b><?= $filmInfo['sous_titre'] ?></b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="film_info row">
            <div class="casting container">
                <div class="dogma_subtitle">
                    <h3 class="uppercase">Casting</h3>
                </div>
                <div class="list">
                    <ul>
                        <?php
                        foreach ($filmRole as $content) {
                        ?>
                            <li>
                                <p class="gray_text"> <?= $content['role'] ?> :</p>
                                <b><?= $content['nom'] ?></b>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="liste_tech container">
                <div class="dogma_subtitle">
                    <h3 class="uppercase">Liste technique</h3>
                </div>
                <div class="list">
                    <ul>
                        <?php
                        foreach ($filmTechnicien as $content) {
                        ?>
                            <li>
                                <p class="gray_text"><?= $content['role'] ?> :<br></p>
                                <b><?= $content['nom'] ?></b>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="film_info row">
            <?php if ($filmInfo['affichage_materiel_presse'] == 1) {
            ?>
                <div class="materiel_presse container">
                    <div class="dogma_subtitle">
                        <h3 class="uppercase">Matériel de presse</h3>
                    </div>
                    <div class="list">
                        <ul id="materiel_presse_fr">
                            <?php if (!empty($filmInfo['dp'])) { ?>
                                <li><a class="link_underline" href="<?= $filmInfo['dp']; ?>">Dossier de presse</a></li>
                            <?php } ?>
                            <?php if (!empty($filmInfo['dp_photo'])) { ?>
                                <li><a class="link_underline" href="<?= $filmInfo['dp_photo']; ?>">Photos</a></li>
                            <?php } ?>
                            <?php if (!empty($filmInfo['dp_bande_annonce'])) { ?>
                                <li><a class="link_underline" href="<?= $filmInfo['dp_bande_annonce']; ?>">Bande-annonce</a></li>
                            <?php } ?>
                            <?php if (!empty($filmInfo['dp_extrait'])) { ?>
                                <li><a class="link_underline" href="<?= $filmInfo['dp_extrait']; ?>">Extraits</a></li>
                            <?php } ?>
                            <?php if (!empty($filmInfo['dp_affiche'])) { ?>
                                <li><a class="link_underline" href="<?= $filmInfo['dp_affiche']; ?>">Affiche</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="row english_assets">
                        <?php
                        if (!empty($filmInfo['dp_english'])) { ?>
                            <p><a class="link_underline" href="<?php echo $filmInfo['dp_english']; ?>">English Assets</a></p>
                        <?php } ?>
                    </div>
                </div>
            <?php
            }
            ?>


            <div class="contact container">
                <div class="dogma_subtitle">
                    <h3 class="uppercase">Contact</h3>
                </div>
                <div class="list">
                    <?php
                    if (empty($filmInfo['contact'])) {
                    ?>
                        <a class="link_underline" href="mailto:<?= $defaultFilmContact['film_contact'] ?>"><?= $defaultFilmContact['film_contact'] ?></a>
                    <?php
                    } else {
                    ?>
                        <a class="link_underline" href="mailto:<?= $filmInfo['contact'] ?>"><?= $filmInfo['contact'] ?></a>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="festivals container">
                <?php
                if ($filmInfo['affichage_festival'] == 1) {
                ?>
                    <div class="dogma_subtitle">
                        <h3 class="uppercase">Festivals</h3>
                    </div>
                    <div class="list">
                        <ul>
                            <?php
                            foreach ($filmFestival as $content) {
                            ?>
                                <li>
                                    <b><?= $content['festival'] ?> :</b>
                                    <?= $content['selection'] ?>
                                    <?= $content['annee'] ?>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="row plus_film">
            <a class="button_black inter_secondary" href="films">Voir tous les films</a>
        </div>
    </div>
</section>