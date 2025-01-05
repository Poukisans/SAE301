<div class="container-fluid">

    <!-- ================== MODIF FILM ================== -->
    <?php
    foreach ($sectionList as $content) {
    ?>

        <!-- Fin carte -->

        <div class="accordion my-3">
            <!-- Début Collapse -->
            <div class="card card-secondary text-secondary color-palette-box">
                <!-- Head Collapse-->
                <div class="card-header d-flex align-items-center justify-content-between w-100">
                    <h3 class="mb-0 justify-content-between">
                        <button data-target="#section<?= $content['id'] ?>" aria-controls="section<?= $content['id'] ?>" class="btn card-title text-left" type="button" data-toggle="collapse" aria-expanded="false" style="padding: 0px; line-height:0;">
                            <i class="fas fa-chevron-down"></i>
                            &nbsp;
                            <?= $content['nom'] ?>
                        </button>
                    </h3>

                    <!-- Acceder a -->
                    <div class="d-flex justify-content-end flex-fill">
                        <a href="<?= BASE_URL ?><?= $content['lien'] ?>" role="button" target="_blank" class="btn btn-light text-body"> <i class="fas fa-external-link-alt mx-1"></i> &nbsp; Voir la page</a>
                    </div>

                </div>

                <div id="section<?= $content['id'] ?>" class="collapse">
                    <!-- Contenu Collapse -->
                    <div class="card-body">

                        <form action="sections" method="post" enctype="multipart/form-data">

                            <div class="d-flex align-items-center w-100">
                                <div class="d-flex flex-column flex-fill">

                                    <!-- Nom  -->
                                    <div class="d-flex flex-row flex-fill">
                                        <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                            <label for="nom">Nom section</label>
                                            <input name="nom" value="<?= $content['nom'] ?>" required class="form-control" type="text">
                                        </div>
                                    </div>

                                    <!-- ID et Lien  -->
                                    <div class="d-flex flex-row flex-fill">
                                        <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                            <label for="id">ID</label>
                                            <input name="id" value="<?= $content['id'] ?>" disabled class="form-control" type="text">
                                        </div>

                                        <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                            <label for="lien">Lien</label>
                                            <input name="lien" value="<?= $content['lien'] ?>" disabled class="form-control" type="text">
                                        </div>
                                    </div>

                                    <!-- Affichage  -->
                                    <div class="d-flex flex-row flex-fill">
                                        <div class="d-flex flex-column justify-content-end mx-3 my-2 flex-fill">
                                            <div class="d-flex flex-row flex-fill custom-control custom-switch custom-switch-on-danger align-items-center">
                                                <div class="mr-2">
                                                    <input name="affichage_nav" <?= $content['affichage_nav'] == 1 ? "checked" : "" ?> id="affichage_nav<?=$content['id']?>" type="checkbox" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="affichage_nav<?=$content['id']?>">Afficher dans le menu de navigation</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row flex-fill custom-control custom-switch custom-switch-on-danger align-items-center">
                                                <div class="mr-2">
                                                    <input name="affichage_footer" <?= $content['affichage_footer'] == 1 ? "checked" : "" ?> id="affichage_footer<?=$content['id']?>" type="checkbox" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="affichage_footer<?=$content['id']?>">Afficher dans le pied de page (plan du site)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================== MAJ BANNIERE ================== -->
                            <?php
                            if (!empty($content['banner'])) {
                            ?>
                                <div class="mx-3">
                                    <img src="<?= BASE_URL ?><?= $content['banner'] ?>" style="aspect-ratio: 16/4;height: 35vw;object-fit: cover;" class="img-fluid elevation-1">
                                </div>
                            <?php
                            } else {
                                echo "Aucune bannière.";
                            }

                            ?>

                            <!-- Maj Banniere  -->
                            <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex my-3">
                                <div class="d-flex flex-column justify-content-end mx-3 flex-fill">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="banner" type="file" class="custom-file-input" id="formFile" accept="image/*">
                                            <label class="custom-file-label" for="formFile" data-browse="Parcourir">
                                                <i class="fas fa-upload"></i> Choisir une bannière...
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                                <div class="d-flex flex-column mx-3 justify-content-between">
                                    <input value="<?= $content['banner'] ?>" name="banner" type="hidden">
                                    <button name="update" value="<?= $content['id'] ?>" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i> &nbsp; Mettre à jour</button>
                                </div>

                                <div class="d-flex flex-column mx-3 justify-content-between">
                                    <!-- Suppression -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBanner<?= $content['id'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Modal suppression -->
                                    <form action="sections" method="POST" class="align-items-center justify-content-center d-flex">
                                        <div id="deleteBanner<?= $content['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="deleteBanner<?= $content['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir supprimer la bannière pour <b><?= $content['nom'] ?></b> ? <br> <br>
                                                        <b>Cette action est irréversible.</b>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-end">
                                                        <div>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button name="deleteBanner" value="<?= $content['id'] ?>" type="submit" class="btn btn-danger">Supprimer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </form>
                        <!-- Fin contenu collapse -->
                    </div>
                </div>
            </div>
            <!-- Fin Collapse -->

        </div>

    <?php
    }
    ?>
</div>