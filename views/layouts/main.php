<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $layoutContent['meta_desc'] ?>">

    <base href="<?=BASE_URL?>">

    <link rel="stylesheet" href="assets/css/anim.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <title><?= isset($layoutContent['current_section']) ? $layoutContent['current_section'] . " | " : "" ?><?=SITE_NAME?></title>

    <script src="assets/js/main.js"></script>

    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="assets/favicon/favicon-48x48.png" type="image/png" />
    <link rel="icon" href="assets/favicon/favicon.svg" type="image/svg+xml" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="<?=SITE_NAME?>" />
    <link rel="manifest" href="assets/favicon/site.webmanifest" />

    <meta name="theme-color" content="<?= $layoutContent['couleur_site'] ?>" />
    <?php
    if (isset($no_index) && $no_index == 1) {
    ?>
        <meta name="robots" content="noindex, nofollow">
    <?php
    }
    ?>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Dogma Font -->
    <link rel="stylesheet" href="https://use.typekit.net/lyz7vnt.css">
</head>

<body class="inter_text">
    <?php if (isset($layoutContent['formOutput'])) : ?>
        <div class="row form_output inter_title">
            <p><?= $layoutContent['formOutput'] ?></p>
        </div>
    <?php endif; ?>

    <?php if (isset($previewInfo)) : ?>
        <div class="row form_output inter_title" style="position:fixed; background-color: #ff4800b0;">
            <p><?= $previewInfo ?></p>
        </div>
    <?php endif; ?>

    <header role="banner">
        <div class="navbar">
            <div class="menu_logo white_text">
                <button class="menu_button" id="menu_button" aria-label="Menu navigation">
                    <span class="bg_menu_top"></span>
                    <span class="bg_menu_down"></span>
                </button>

                <div class="current_page inter_secondary" id="current_page">
                    <p>Menu <?= isset($layoutContent['current_section']) ? "| " . $layoutContent['current_section'] : "" ?></p>
                </div>
            </div>

            <h1 class="logo" id="logo">
                <a href="/">
                    <img class="logo_classic" src="assets/logo/logo_mezzanotte34.svg" alt="Mezzanotte 34" aria-label="Logo Mezzannote 34">
                    <img class="logo_mobile" src="assets/logo/logo_mezzanotte34_mini.svg" alt="Mezzanotte 34" aria-label="Logo Mezzannote 34">
                </a>
            </h1>
        </div>
    </header>

    <aside role="navigation" class="menu dogma_other" id="menu">
        <nav>
            <ul>
                <?php
                foreach ($layoutContent['sectionList'] as $section) {
                    if ($section['show_section'] == 1) {
                ?>
                        <li>
                            <a href=".<?= $section['lien'] ?>" class="uppercase"><?= $section["nom"] ?></a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </nav>
    </aside>

    <main role="main">
        <div class="banner_container" style="background-color: <?= $layoutContent['couleur_site'] ?>;">
            <?php
            if (!empty($layoutContent['banner'])) {
            ?>
                <img src="<?= $layoutContent['banner'] ?>" alt="Bannière page <?= isset($layoutContent['current_section']) ? $layoutContent['current_section'] : "Accueil" ?>">
            <?php
            }
            ?>
        </div>

        <?php
        echo $content;
        ?>
    </main>

    <footer role="contentinfo" class="container inter_secondary white_text" aria-label="Footer site">

        <div class="row footer">
            <div class="row footer_links">
                <div class="container plan_site">
                    <h2 class="dogma_other uppercase">
                        Plan du site
                    </h2>

                    <nav class="list">
                        <ul>
                            <?php
                            foreach ($layoutContent['sectionList'] as $section) {
                                if ($section['show_section'] == 1) {
                            ?>
                                    <li>
                                        <a class="link_nounderline" href=".<?= $section['lien'] ?>"><?= ($section['nom']) ?></a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>

                <div class="container socials">
                    <h2 class="dogma_other uppercase" style="text-transform: uppercase;">
                        Sur les réseaux
                    </h2>
                    <div class="list">
                        <ul>
                            <?php
                            foreach ($layoutContent['socialList'] as $social) {
                            ?>
                                <li><a class="link_nounderline" href="<?= $social['lien'] ?>" target="_blank"><?= $social['nom'] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="container newsletter" role="form">
                <h2 class="dogma_other uppercase">
                    Plus de cinéma et de la Corse
                </h2>

                <div>
                    <p class="newsletter_text"><?= $layoutContent['newsletterDesc'] ?></p>
                </div>

                <div class="container newsletter_input">
                    <form class="row" action="" method="POST">
                        <input class="input_black inter_secondary" type="newsletter_mail" name="newsletter_mail" id="newsletter_mail" placeholder="Email" required aria-label="Inscription newsletter">
                        <button class="button_white inter_secondary" type="submit">S'inscrire</button>
                    </form>
                    <p class="newsletter_info"><?= $layoutContent['newsletterWarn'] ?></p>
                </div>
            </div>
        </div>

        <div class="row mention">
            <div class="row">
                <a class="link_nounderline" href="./mentions-legales">Mentions légales</a> <a class="link_nounderline" href="./politique-confidentialite">Politique de confidentialité</a>
            </div>
            <div>© <?=SITE_NAME?> - Tous droits réservés</div>
        </div>
    </footer>
</body>

</html>