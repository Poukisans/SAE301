<div class="container-fluid">

    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">
        <!-- Acceder a -->
        <a href="<?= BASE_URL ?>faq" role="button" target="_blank" class="btn btn-primary h-100"> <i class="fas fa-external-link-alt mx-1"></i> &nbsp; Voir la page</a>
    </div>

    <!-- ================== MODIF FAQ ================== -->
    <div class="card card-secondary color-palette-box mt-3">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-th-list"></i>
                &nbsp;
                Modifier <?= $currentContent ?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <div class="d-flex flex-row mx-1 justify-content-end mb-3">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></i> &nbsp; Ajouter question</button>
            </div>

            <!-- Modal ajout -->
            <form action="" method="POST" class="align-items-center justify-content-center d-flex">
                <div id="add" class="modal fade" tabindex="-1" aria-labelledby="add" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 80vw; height:50vh;">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex flex-column flex-fill">

                                    <!-- Titre Question  -->
                                    <div class="d-flex flex-row flex-fill">
                                        <div class="d-flex flex-column justify-content-end mx-3 mb-3 flex-fill">
                                            <label for="meta_desc">Intitulé question</label>
                                            <input name="question" required class="form-control" type="text">
                                        </div>
                                    </div>

                                    <!-- Qiuestion -->
                                    <div class="d-flex flex-row flex-fill">
                                        <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                            <label for="meta_desc">Réponse</label>
                                            <textarea name="reponse" class="summernote"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-end">
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button name="add" type="submit" class="btn btn-success">Ajouter question</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <?php
            foreach ($faqList as $content) {
            ?>
                <form action="" method="post">
                    <div class="d-flex align-items-center w-100">
                        <div class="d-flex flex-column flex-fill">

                            <!-- Titre Question  -->
                            <div class="d-flex flex-row flex-fill">
                                <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                    <input name="question" value="<?= $content['question'] ?>" required class="form-control" type="text">
                                </div>
                            </div>

                            <!-- Qiuestion -->
                            <div class="d-flex flex-row flex-fill">
                                <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                    <textarea name="reponse" class="summernote"><?= $content['reponse'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row w-100 justify-content-end align-items-center d-flex mb-4">
                        <div class="d-flex flex-column mx-1 justify-content-center">
                            <button name="update" value="<?=$content['id']?>" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i></i> &nbsp; Mettre à jour</button>
                        </div>
                        <div class="d-flex flex-column mx-1 justify-content-center">
                            <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#delete<?= $content['id'] ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                    </div>
                </form>

                <!-- Modal suppression -->
                <form action="" method="POST" class="align-items-center justify-content-center d-flex">
                    <div id="delete<?= $content['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="delete<?= $content['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer la question <b>"<?= $content['question'] ?>"</b> ? <br> <br>
                                    <b>Cette action est irréversible.</b>
                                </div>
                                <div class="modal-footer d-flex justify-content-end">
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button name="delete" value="<?= $content['id'] ?>" type="submit" class="btn btn-danger">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            <?php
            }

            ?>

        </div>
    </div>
    <!-- Fin carte -->
</div>