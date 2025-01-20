<div class="container-fluid">

    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">
        <!-- Acceder a -->
        <a href="<?= BASE_URL ?>mentions-legales" role="button" target="_blank" class="btn btn-primary h-100"> <i class="fas fa-external-link-alt mx-1"></i> &nbsp; Voir la page</a>
    </div>

    <!-- ================== MODIF FAQ ================== -->
    <div class="card card-secondary color-palette-box mt-3">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-phone-alt"></i>
                &nbsp;
                Modifier <?= $currentContent ?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <form action="" method="post">
                <div class="d-flex align-items-center w-100">
                    <div class="d-flex flex-column flex-fill">
                        <!-- Mentions legales -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                <label for="mentions_legales">Informations contact</label>
                                <textarea name="mentions_legales" class="summernote"><?= $legalInfo['mentions_legales'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row w-100 justify-content-end align-items-center d-flex mb-4">
                    <div class="d-flex flex-column mx-1 justify-content-center">
                        <button name="update" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i></i> &nbsp; Mettre à jour</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fin carte -->
</div>