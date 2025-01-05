<div class="container-fluid">

    <!-- ================== MODIF TECHNICIENS ================== -->
    <div class="card card-secondary color-palette-box">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-hashtag"></i>
                &nbsp;
                Modifier <?=$currentContent?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <div class="row w-100 mb-2">
                <div class="col">
                    <label for="role">Nom</label>
                </div>

                <div class="col">
                    <label for="acteur">Lien</label>
                </div>

                <div class="col-lg-1">
                </div>
            </div>


            <?php
            foreach ($socialList as $content) {
            ?>
                <div class="row w-100 mb-2">

                    <form action="reseaux" method="post" class="d-flex flex-row flex-fill">

                        <div class="col d-flex justify-content-start">
                            <input name="nom" value="<?= $content['nom'] ?>" required class="form-control bg-light" type="text">
                        </div>

                        <div class="col d-flex justify-content-start">
                            <input name="lien" value="<?= $content['lien'] ?>" required class="form-control bg-light" type="url" placeholder="https://...">
                        </div>

                        <div class="col-lg-1 d-flex justify-content-between">
                            <button name="update" value="<?= $content['id'] ?>" class="btn bg-primary mx-1" type="submit"><i class="fas fa-sync-alt"></i></i></button>
                            <button type="button" class="btn btn-danger mx-1" data-toggle="modal" data-target="#delete<?= $content['id'] ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Modal suppression -->
                    <form action="reseaux" method="POST" class="align-items-center justify-content-center d-flex">
                        <div id="delete<?= $content['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="delete<?= $content['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer <b><?= $content['nom'] ?></b> ? <br> <br>
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
                </div>
            <?php
            }
            ?>
            <div class="row w-100 mb-2">
                <form action="reseaux" method="POST" class="d-flex flex-row flex-fill">

                    <div class="col">
                        <input name="nom" class="form-control" type="text">
                    </div>

                    <div class="col">
                        <input name="lien" class="form-control" type="url" placeholder="https://...">
                    </div>

                    <div class="col-lg-1 d-flex justify-content-center">
                        <button name="add" class="btn btn-success w-100" type="submit"><i class="fas fa-plus"></i></button> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin carte -->

</div>