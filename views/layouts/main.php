<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $layoutContent['meta_desc'] ?>">

    <base href=<?= BASE_URL ?>>

    <link rel="stylesheet" href="assets/css/anim.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <title><?= isset($layoutContent['current_section']) ? $layoutContent['current_section'] . " | " : "" ?><?= SITE_NAME ?></title>

    <script src="assets/js/main.js"></script>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body class="inter_text">
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
                    <img class="logo_classic" src="assets/logo/logo_mezzanotte34.svg" alt="<?=SITE_NAME?>" aria-label="Logo <?=SITE_NAME?>">
                    <img class="logo_mobile" src="assets/logo/logo_mezzanotte34_mini.svg" alt="<?=SITE_NAME?>" aria-label="Logo <?=SITE_NAME?>">
                </a>
            </h1>
        </div>
    </header>

    <aside role="navigation" class="menu dogma_other" id="menu">
        <nav>
            <ul>
                <?php
                foreach ($layoutContent['sectionList'] as $section) {
                ?>
                    <li>
                        <a href=".<?= $section['lien'] ?>" class="uppercase"><?= $section["nom"] ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </aside>

    <main role="main">
        <div class="banner_container">
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
                            ?>
                                <li>
                                    <a class="link_nounderline" href=".<?= $section['lien'] ?>"><?= ($section['nom']) ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </nav>
                </div>

                <div class="container socials">
                    <h2 class="dogma_other uppercase" style="text-transform: uppercase;">
                        Réseaux sociaux
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

        </div>

        <div class="row mention">
            <div class="row">
                <a class="link_nounderline" href="./mentions-legales">Mentions légales</a>
            </div>
            <div>© <?= SITE_NAME ?> - Tous droits réservés</div>
        </div>
    </footer>
</body>

</html>