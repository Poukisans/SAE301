<div class="container-fluid">
    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">
        <!-- Nouvel Article -->
        <div class="d-flex flex-column mx-3 justify-content-center">
            <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#add<?= $content['id'] ?>">
                <i class="fas fa-plus mx-1"></i> &nbsp; Nouvel article
            </button>

            <!-- Modal ajout -->
            <form action="articles/<?= $articleInfo['lien'] ?>" method="POST" class="align-items-center justify-content-center d-flex">
                <div id="add" class="modal fade" tabindex="-1" aria-labelledby="add" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body d-flex flex-column">
                                <div class="d-flex flex-column">
                                    <!-- Nom -->
                                    <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                        <label for="nom">Nom de l'article</label>
                                        <input name="nom" value="<?= $articleInfo['nom'] ?>" required class="form-control" type="text">
                                    </div>

                                    <!-- Categorie -->
                                    <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                        <label for="categorie">Catégorie</label>
                                        <select name="categorie" class="form-control" required>
                                            <option value="homme" <?= $articleInfo['categorie'] == "homme" ? "selected" : "" ?>>Homme</option>
                                            <option value="femme" <?= $articleInfo['categorie'] == "femme" ? "selected" : "" ?>>Femme</option>
                                            <option value="enfant" <?= $articleInfo['categorie'] == "enfant" ? "selected" : "" ?>>Enfant</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-end">
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button name="add" value="<?= $content['id'] ?>" type="submit" class="btn btn-success">Ajouter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ================== LISTE ================== -->
    <div class="card card-primary">
        <!-- /.card-header -->
        <div class="row d-flex justify-content-around p-3">
            <?php
            foreach ($articleList as $content) {
            ?>
                <div class="d-flex flex-row mx-2 mb-3">
                    <a href="articles/<?= $content['lien'] ?>" class="d-flex flex-column bg-white shadow-sm rounded" style="cursor:pointer;">
                        <?php
                        if (isset($content['miniature'])) {
                        ?>
                            <img src="<?= BASE_URL ?><?= $content['miniature'] ?>" style="width: 200px; height:200px; object-fit:cover;">
                        <?php
                        } else {
                        ?>
                            <div class="bg-secondary d-flex justify-content-center align-items-center" style="width: 200px; height:200px;">
                                <p>Aucune miniature</p>
                            </div>
                        <?php
                        }
                        ?>
                        <h6 class="my-3 mx-2 text-break"><?= $content['nom'] ?></h6>
                    </a>
                </div>
            <?php
            }
            ?>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- Fin carte -->

</div>