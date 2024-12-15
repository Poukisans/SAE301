<div class="container-fluid">

    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">

        <!-- Suppression -->
        <button type="button" class="btn btn-danger h-100" data-toggle="modal" data-target="#delete">
            <i class="fas fa-trash"></i> &nbsp; Supprimer
        </button>

        <!-- Modal suppression -->
        <form action="articles" method="POST" class="align-items-center justify-content-center d-flex">
            <div id="delete" class="modal fade" tabindex="-1" aria-labelledby="delete" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer la promotion <b><?= $promotionInfo['nom'] ?></b> ? <br> <br>
                            <b>Cette action est irréversible.</b>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button name="delete" value="<?= $promotionInfo['id'] ?>" type="submit" class="btn btn-danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- ================== CARTE AJOUT REALISATIONS ================== -->
    <div class="container d-flex flex-rox flexwrap">

    </div>
    <div class="card card-success color-palette-box">

        <!-- Titre carte -->
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-plus"></i>
                &nbsp;
                Nouvelle <?= $currentContent ?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <form enctype="multipart/form-data" name="add" action="./productions" method="post">

                <div class="d-flex align-items-center w-100">
                    <div class="d-flex flex-column flex-fill">

                        <!-- Titre et Réalisateur  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="nom">Nom de la production</label>
                                <input name="nom" required class="form-control" type="text">
                            </div>

                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="realisateur">Réalisateur(s)</label>
                                <input name="realisateur" required class="form-control" type="text">
                            </div>
                        </div>

                        <!-- Annee et type -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="annee">Année de production</label>
                                <input name="annee" required class="form-control" type="number" max="9999" placeholder="0000">
                            </div>

                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="annee">Type de production</label>
                                <select name="type" class="form-control" required>
                                    <?php
                                    foreach ($filmType as $content) {
                                    ?>
                                        <option value="<?= $content['id'] ?>"><?= ucfirst($content['type']) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                    <div class="d-flex flex-column mx-3 justify-content-center">
                        <button name="add" class="btn btn-success" type="submit"><i class="fas fa-plus"></i> &nbsp; Ajouter <?= $currentContent ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fin carte -->

</div>