<div class="container-fluid">
    <!-- ================== MODIFICATIONS ================== -->
    <div class="card card-secondary color-palette-box">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-pencil-alt"></i>
                &nbsp;
                Informations <?= $currentContent ?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <form action="articles/<?= $articleInfo['lien'] ?>" enctype="multipart/form-data" method="post">
                <div class="row w-100">
                    <div class="col-xs-12 col-sm-12 col-md-4 d-flex flex-column justify-content-center">
                        <div class="w-100 h-auto d-flex justify-content-center align-items-center" style="aspect-ratio: 1/1;">
                            <?php
                            if (!empty($articleInfo['miniature'])) {
                            ?>
                                <img src="<?= BASE_URL ?><?= $articleInfo['miniature'] ?>" class="w-100 h-auto">
                            <?php
                            } else {
                            ?>
                                <p>Aucune miniature</p>
                            <?php
                            }
                            ?>
                        </div>

                        <div>
                            <!-- Maj Miniature  -->
                            <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex my-3">
                                <div class="d-flex flex-column justify-content-end flex-fill">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="miniature" value="<?= $articleInfo['miniature'] ?>" type="hidden">
                                            <input name="miniature" type="file" class="custom-file-input" id="formFile" accept="image/*">
                                            <label class="custom-file-label" for="formFile" data-browse="Parcourir">
                                                <i class="fas fa-upload"></i> Choisir une miniature...
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-8 d-flex flex-column flex-fill">
                        <div class="d-flex flex-column">
                            <!-- Nom -->
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                <label for="nom">Nom de l'article</label>
                                <input name="nom" value="<?= $articleInfo['nom'] ?>" required class="form-control" type="text">
                                <p class="font-weight-light font-italic mx-2 my-1">Le nom de l'article doit être unique</p>
                            </div>

                            <!-- Tarif -->
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                <label for="prix">Prix</label>
                                <input name="prix" value="<?= $articleInfo['prix'] ?>" required class="form-control" type="number">
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

                            <!-- Description -->
                            <div class="d-flex flex-column justify-content-end mx-3 my-4 flex-fill">
                                <label for="description">Description</label>
                                <textarea name="description" required class="form-control" maxlength="300" style="height: 200px;"><?= $articleInfo['description'] ?></textarea>
                                <p class="font-weight-light font-italic mx-2 my-1">Max 300 caractères</p>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                            <div class="d-flex flex-column mx-3 justify-content-center">
                                <button name="update" value="<?= $articleInfo['id'] ?>" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i></i> &nbsp; Mettre à jour</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fin carte -->
</div>