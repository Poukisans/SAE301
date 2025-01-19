<div class="container-fluid">
    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">
        <!-- Ajout -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></i> &nbsp; Nouvelle promotion</button>
    </div>

    <!-- Modal ajout -->
    <form action="" method="POST" class="align-items-center justify-content-center d-flex">
        <div id="add" class="modal fade" tabindex="-1" aria-labelledby="add" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 80vw; height:50vh;">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex flex-column flex-fill">

                            <!-- Nom  -->
                            <div class="d-flex flex-row flex-fill">
                                <div class="d-flex flex-column justify-content-end mx-3 mb-3 flex-fill">
                                    <label for="nom">Nom promotion</label>
                                    <input name="nom" required class="form-control" type="text">
                                </div>
                            </div>


                            <!-- Type  -->
                            <div class="d-flex flex-row flex-fill">
                                <div class="d-flex flex-column justify-content-end mx-3 mb-3 flex-fill">
                                    <label for="type">Type de promotion</label>
                                    <select name="type" class="form-control" required>
                                        <option value="0">Promotion</option>
                                        <option value="1">Prix forcé</option>
                                        <option value="2">Prix de lot</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex flex-row flex-fill">
                                <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                    <label for="date_debut">Date début (inclus)</label>
                                    <input name="date_debut" required class="form-control" type="date">
                                </div>

                                <div class="d-flex flex-column justify-content-center align-items-center mx-3 mb-2">
                                    <i class="fas fa-arrow-right mt-4" style="font-size: 1.5rem;"></i>
                                </div>

                                <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                    <label for="date_fin">Date fin (inclus)</label>
                                    <input name="date_fin" class="form-control" type="date">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button name="add" type="submit" class="btn btn-success">Ajouter promotion</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- ================== LISTE ================== -->
    <div class="card card-danger color-palette-box mb-5">

        <!-- Titre carte -->
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-exclamation-circle"></i>
                &nbsp;
                <?= ucfirst($currentContent) ?>s en cours
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body py-1 d-flex flex-column justify-content-around py-3">
            <!-- Informations  -->
            <div class="list-group list-group-flush">
                <?php
                foreach ($promotionListCurrent as $content) {
                ?>
                    <div class="list-group-item py-2 px-0 d-flex flex-wrap justify-content-between" style="gap: 10px;">
                        <div class="d-flex flex-row flex-grow-1 align-items-start">
                            <a href="promotions/<?= $content['id'] ?>" class="m-0 btn btn-default elevation-1 text-left flex-grow-1">
                                <b class="text-nowrap">#<?= $content['id'] ?> | <?= $content['nom'] ?></b>
                                (
                                <?php
                                switch ($content['type']) {
                                    case 0:
                                        echo "Promotion";
                                        break;
                                    case 1:
                                        echo "Prix forcé";
                                        break;
                                    case 2:
                                        echo "Prix de lot";
                                        break;
                                }
                                ?>
                                )

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

    <!-- ================== LISTE ================== -->
    <div class="card card-success color-palette-box">

        <!-- Titre carte -->
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-arrow-alt-circle-right"></i>
                &nbsp;
                <?= ucfirst($currentContent) ?>s à venir
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body py-1 d-flex flex-column justify-content-around py-3">
            <!-- Informations  -->
            <div class="list-group list-group-flush">
                <?php
                foreach ($promotionListCurrent as $content) {
                ?>
                    <div class="list-group-item py-2 px-0 d-flex flex-wrap justify-content-between" style="gap: 10px;">
                        <div class="d-flex flex-row flex-grow-1 align-items-start">
                            <a href="promotions/<?= $content['id'] ?>" class="m-0 btn btn-default elevation-1 text-left flex-grow-1">
                                <b class="text-nowrap">#<?= $content['id'] ?> | <?= $content['nom'] ?></b>
                                (
                                <?php
                                switch ($content['type']) {
                                    case 0:
                                        echo "Promotion";
                                        break;
                                    case 1:
                                        echo "Prix forcé";
                                        break;
                                    case 2:
                                        echo "Prix de lot";
                                        break;
                                }
                                ?>
                                )

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

    <!-- ================== LISTE ================== -->
    <div class="card card-secondary color-palette-box">

        <!-- Titre carte -->
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-arrow-alt-circle-left"></i>
                &nbsp;
                <?= ucfirst($currentContent) ?>s passées
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body py-1 d-flex flex-column justify-content-around py-3">
            <!-- Informations  -->
            <div class="list-group list-group-flush">
                <?php
                foreach ($promotionListArchived as $content) {
                ?>
                    <div class="list-group-item py-2 px-0 d-flex flex-wrap justify-content-between" style="gap: 10px;">
                        <div class="d-flex flex-row flex-grow-1 align-items-start">
                            <a href="promotions/<?= $content['id'] ?>" class="m-0 btn btn-default elevation-1 text-left flex-grow-1">
                                <b class="text-nowrap">#<?= $content['id'] ?> | <?= $content['nom'] ?></b>
                                (
                                <?php
                                switch ($content['type']) {
                                    case 0:
                                        echo "Promotion";
                                        break;
                                    case 1:
                                        echo "Prix forcé";
                                        break;
                                    case 2:
                                        echo "Prix de lot";
                                        break;
                                }
                                ?>
                                )

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