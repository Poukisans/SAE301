<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $layoutContent['meta_desc'] ?>">

    <base href="<?= BASE_URL ?>">

    <link rel="stylesheet" href="assets/css/anim.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="icon" type="image/png" href="assets/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="assets/favicon/favicon.svg" />
    <link rel="shortcut icon" href="assets/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Panel | <?= SITE_NAME ?>" />
    <link rel="manifest" href="assets/favicon/site.webmanifest" />

    <title><?= isset($layoutContent['current_section']) ? $layoutContent['current_section'] . " | " : "" ?><?= SITE_NAME ?></title>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body class="inter_text">
    <header role="banner">
        <div class="navbar">
            <h1 class="logo" id="logo">
                <a href="./">
                    <img class="logo_classic" src="assets/logo/Logo_Birbone.svg" alt="<?= SITE_NAME ?>" aria-label="Logo <?= SITE_NAME ?>">
                </a>
            </h1>
            <a href="./panier">
                <img class="panier" src="assets/logo/panier.svg" alt="accédez au panier" aria-label="Icon de panier">
                <!-- <img class="panier_mobile" src="assets/logo/panier.svg" alt="accédez au panier" aria-label="Icon de panier"> -->
            </a>
        </div>
        <div class="navbar_down">
            <div class="list_menu">
                <?php
                foreach ($layoutContent['sectionList'] as $section) {
                    if ($section['affichage_nav'] == 1) { ?>
                        <a class="link_nounderline a_menu" href="<?= $section['lien'] ?>"><?= ($section['nom']) ?></a>
                <?php
                    }
                };
                ?>
            </div>
            <div class="search_filter row">
                <form action="recherche" method="get">
                    <input name="q" class="input_white inter_secondary" type="text" placeholder="Rechercher un article" aria-label="Rechercher un article">
                    <button class="button_red inter_secondary" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </header>


    <main role="main">
        <div class="banner_container">

        </div>

        <?php
        echo $content;
        ?>
    </main>

    <footer role="contentinfo" class="container inter_secondary black_text" aria-label="Footer site">
        <h1 class="logo_footer" id="logo">
            <a href="./">
                <img class="logo_classic" src="assets/logo/Logo_Birbone.svg" alt="<?= SITE_NAME ?>" aria-label="Logo <?= SITE_NAME ?>">
                <!-- <img class="logo_mobile" src="assets/logo/logo_mezzanotte34_mini.svg" alt="<?= SITE_NAME ?>" aria-label="Logo <?= SITE_NAME ?>"> -->
            </a>
        </h1>
        <div class="row footer">
            <div class="row footer_links">
                <div class="container plan_site">
                    <h2 class="inter_other uppercase mb">
                        Plan du site
                    </h2>

                    <nav class="list">
                        <ul>
                            <?php
                            foreach ($layoutContent['sectionList'] as $section) {
                                if ($section['affichage_footer'] == 1) {
                            ?>
                                    <li>
                                        <a class="link_nounderline" href="<?= $section['lien'] ?>"><?= ($section['nom']) ?></a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>

                <div class="container socials">
                    <h2 class="inter_other uppercase mb" style="text-transform: uppercase;">
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
            <div>© 2024-2025 <?= SITE_NAME ?> - Tous droits réservés</div>
        </div>
    </footer>
    <script src="assets/js/main.js"></script>
</body>

</html>