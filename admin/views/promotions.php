<div class="container-fluid">
    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">
        <!-- Acceder a -->
        <a href="/articles/nouvel_article" role="button" class="btn btn-success h-100"> <i class="fas fa-plus mx-1"></i> &nbsp; Nouvelle promotion</a>
    </div>

    <!-- ================== LISTE ================== -->
    <div class="card card-primary color-palette-box">

        <!-- Titre carte -->
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-cog"></i>
                &nbsp;
                Gestion <?= $currentContent ?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body py-1 d-flex flex-column justify-content-around">
            <!-- Informations  -->
            <div class="list-group list-group-flush">
                <?php
                foreach ($promotionList as $content) {
                ?>
                    <div class="list-group-item py-2 px-0 d-flex flex-wrap justify-content-between" style="gap: 10px;">
                        <div class="d-flex flex-row flex-grow-1 align-items-start">
                            <a href="promotions/<?= $content['id'] ?>" class="m-0 btn btn-default elevation-1 text-left flex-grow-1">
                                <b class="text-nowrap">#<?= $content['id'] ?> | <?= $content['nom'] ?></b>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Fin carte -->

</div>