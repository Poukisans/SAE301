<section role="section">
    <div class="section_header container">
        <div class="row title_container">
            <div class="banner_sup">
                <h3 class="inter_title banner_text"><?= $layoutContent['current_section'] ?></h3>
                <img class="img_banner" src="<?= $layoutContent['banner'] ?>" alt="">
            </div>
        </div>
    </div>

    <div class="text mb">
        <div class="text_part mb">
            <h2 class="inter_title uppercase mb"><?= $contactInfo['contact_title'] ?></h2>
            <?= $contactInfo['contact'] ?>
        </div>
        <a class="button_red inter_secondary mb" href="./<?= $layoutContent['sectionList'][9]['lien'] ?>">FAQ</a>
    </div>
</section>