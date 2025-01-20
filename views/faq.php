<section role="section">
    <div class="section_header container">
        <div class="row title_container">
            <div class="banner_sup">
                <h3 class="inter_title banner_text"><?= $layoutContent['sectionNom'] ?></h3>
                <img class="img_banner" src="<?= $layoutContent['banner'] ?>" alt="">
            </div>
        </div>
    </div>


    <div class="text">
        <?php
        foreach ($faqInfo as $content) {
        ?>
            <div class="text_part mb">
                <h2 class="inter_title uppercase mb"><?= $content['question'] ?></h2>
                <?= $content['reponse'] ?>
            </div>
        <?php
        }
        ?>
    </div>
</section>