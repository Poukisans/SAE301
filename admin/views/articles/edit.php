<div class="container-fluid">

    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">
        <!-- Acceder a -->
        <a href="<?= BASE_URL ?>articles/<?= $articleInfo['lien'] ?>" role="button" target="_blank" class="btn btn-primary h-100"> <i class="fas fa-external-link-alt mx-1"></i> &nbsp; Voir la page</a>

        <!-- Show/hide -->
        <form action="articles/<?= $articleInfo['lien'] ?>" method="POST" class="align-items-center justify-content-center d-flex mx-1">
            <label class="btn btn-success mx-1 font-weight-normal" for="<?= $articleInfo['id'] ?>" style="margin-bottom:0px;">
                <?= $articleInfo['affichage'] == 1 ? "<i class='fas fa-eye'></i> &nbsp; Masquer" : "<i class='far fa-eye-slash'></i> &nbsp; Afficher" ?>
            </label>

            <input value="<?= $articleInfo['id'] ?>" type="hidden" name="setDisplay">
            <input id="<?= $articleInfo['id'] ?>" <?= $articleInfo['affichage'] == 1 ? "checked" : "" ?>
                value="1" name="affichage" onchange="submit()" class="d-none" type="checkbox">
        </form>

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
                            Êtes-vous sûr de vouloir supprimer l'article <b><?= $articleInfo['nom'] ?></b> ? <br> <br>
                            <b>Cette action est irréversible.</b>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button name="delete" value="<?= $articleInfo['id'] ?>" type="submit" class="btn btn-danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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

    <!-- ================== GESTION STOCK ================== -->
    <div class="card card-danger color-palette-box">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-box-open"></i>
                &nbsp;
                Gestion stock
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <?php
            if (!empty($articleColorisList[0])) {
            ?>
                <form action="" method="post" class="d-flex flex-column flex-fill">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Coloris</th>
                                <th>XXS</th>
                                <th>XS</th>
                                <th>S</th>
                                <th>M</th>
                                <th>L</th>
                                <th>XL</th>
                                <th>XXL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($articleColorisList as $content) {
                            ?>
                                <tr>
                                    <td><?= $content['nom'] ?></td>
                                    <td><input name="quantite[<?= $content['id'] ?>][xxs]" value="<?= $content['quantite_xxs'] ?>" required class="form-control" type="number" min="0"></td>
                                    <td><input name="quantite[<?= $content['id'] ?>][xs]" value="<?= $content['quantite_xs'] ?>" required class="form-control" type="number" min="0"></td>
                                    <td><input name="quantite[<?= $content['id'] ?>][s]" value="<?= $content['quantite_s'] ?>" required class="form-control" type="number" min="0"></td>
                                    <td><input name="quantite[<?= $content['id'] ?>][m]" value="<?= $content['quantite_m'] ?>" required class="form-control" type="number" min="0"></td>
                                    <td><input name="quantite[<?= $content['id'] ?>][l]" value="<?= $content['quantite_l'] ?>" required class="form-control" type="number" min="0"></td>
                                    <td><input name="quantite[<?= $content['id'] ?>][xl]" value="<?= $content['quantite_xl'] ?>" required class="form-control" type="number" min="0"></td>
                                    <td><input name="quantite[<?= $content['id'] ?>][xxl]" value="<?= $content['quantite_xxl'] ?>" required class="form-control" type="number" min="0"></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                        <div class="d-flex flex-column mx-3 justify-content-center">
                            <button name="updateStock" value="<?= $articleInfo['id'] ?>" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i></i> &nbsp; Mettre à jour</button>
                        </div>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="d-flex justify-content-center align-items-center">
                    <h5>Veuillez enregistrer un premiers coloris pour entrer les stocks.</h5>
                </div>
            <?php
            }
            ?>

        </div>
    </div>


    <!-- Fin carte -->

    <!-- ================== GESTION COLORIS ================== -->
    <div class="card card-danger color-palette-box">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-palette"></i>
                &nbsp;
                Modifier coloris
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->

            <div class="row w-100 mb-2">
                <div class="col-xs-12 col-sm-5 d-flex flex-column justify-content-start">
                    <label for="nom">Nom coloris</label>
                </div>

                <div class="col-xs-12 col-sm-5 d-flex flex-column justify-content-start">
                    <label for="nom">Code coloris</label>
                </div>
            </div>

            <!-- Ajout coloris -->
            <form action="" method="post" class="d-flex flex-row flex-fill">
                <div class="row w-100 mb-4">

                    <div class="col-xs-12 col-sm-5 mb-2 d-flex flex-column justify-content-start">
                        <input name="nom" required class="form-control" type="text">
                    </div>

                    <div class="col-xs-12 col-sm-5 mb-2 d-flex flex-column justify-content-start">
                        <input name="coloris" class="form-control" type="color" value="#FFFFFF">
                    </div>

                    <div class="col-xs-12 col-sm-2 mb-2 d-flex justify-content-center align-items-end">
                        <button name="addColoris" value="<?= $articleInfo['id'] ?>" class="btn btn-success w-100" type="submit"><i class="fas fa-plus"></i></button> </button>
                    </div>
                </div>
            </form>

            <?php
            foreach ($articleColorisList as $content) {
            ?>
                <form action="" method="post" class="d-flex flex-row flex-fill">
                    <div class="row w-100">

                        <div class="col-xs-12 col-sm-5 mb-2 d-flex flex-column justify-content-start">
                            <input name="nom" value="<?= $content['nom'] ?>" required class="form-control" type="text">
                        </div>

                        <div class="col-xs-12 col-sm-5 mb-2 d-flex flex-column justify-content-start">
                            <input name="coloris" value="<?= $content['coloris'] ?>" class="form-control" type="color" value="#FFFFFF">
                        </div>

                        <div class="col-xs-6 col-sm-1 mb-2 d-flex justify-content-center align-items-end">
                            <button name="updateColoris" value="<?= $content['id'] ?>" class="btn bg-primary w-100" type="submit">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>

                        <div class="col-xs-6 col-sm-1 mb-2 d-flex justify-content-center align-items-end">
                            <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#deleteColoris<?= $content['id'] ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Modal suppression -->
                <form action="" method="POST" class="align-items-center justify-content-center d-flex">
                    <div id="deleteColoris<?= $content['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="deleteColoris<?= $content['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer le coloris <b><?= $content['nom'] ?></b> de l'article ? <br> <br>
                                    <b>Cette action supprimera aussi son stock associé !</b>
                                </div>
                                <div class="modal-footer d-flex justify-content-end">
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button name="deleteColoris" value="<?= $content['id'] ?>" type="submit" class="btn btn-danger">Supprimer</button>
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

    <!-- ================== GESTION PHOTO ================== -->
    <div class="card card-danger color-palette-box">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-images"></i>
                &nbsp;
                Gestion photos
            </h3>
        </div>

        <!-- Contenu carte -->

        <!-- Ajout photo -->
        <div class="d-flex flex-row flex-wrap justify-content-around p-3">
            <form action="articles/<?= $articleInfo['lien'] ?>" enctype="multipart/form-data" method="post" class="w-100">
                <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex my-3">
                    <div class="d-flex flex-column justify-content-end mx-3 flex-fill">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="photo_article" type="file" class="custom-file-input" id="formFile" accept="image/*">
                                <label class="custom-file-label" for="formFile" data-browse="Parcourir">
                                    <i class="fas fa-upload"></i> Ajouter une photo...
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                    <div class="d-flex flex-column mx-3 justify-content-between">
                        <button name="addImage" value="<?= $articleInfo['id'] ?>" class="btn btn-success" type="submit"><i class="fas fa-plus"></i> &nbsp; Ajouter</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Liste photos -->
        <div class="d-flex flex-row flex-wrap justify-content-around p-3">

            <?php
            foreach ($articlePhotoList as $content) {
            ?>
                <div class="card m-3" style="width: 18rem;">
                    <a class="d-flex justify-content-center align-items-center border bg-light" target="_blank" href="<?= BASE_URL ?><?= $content['img_article'] ?>">
                        <img src="<?= BASE_URL ?><?= $content['img_article'] ?>" class="img-fluid" style="height: 18rem; object-fit:contain;">
                    </a>
                    <div class="p-3 d-flex align-items-center justify-content-center bg-light elevation-1">
                        <!-- Suppression -->
                        <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#deleteImage<?= $content['id'] ?>">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Modal suppression -->
                        <form action="articles/<?= $articleInfo['lien'] ?>" method="POST" class="align-items-center justify-content-center d-flex">
                            <div id="deleteImage<?= $content['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="deleteImage<?= $content['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body d-flex flex-column">
                                            <img src="<?= BASE_URL ?><?= $content['img_article'] ?>" class="img-fluid my-3">
                                            Êtes-vous sûr de vouloir supprimer cette photo ? <br><br>
                                            <b>Cette action est irréversible.</b>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-end">
                                            <div>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <input name="img_article" value="<?= $content['img_article'] ?>" type="hidden">
                                                <button name="deleteImage" value="<?= $content['id'] ?>" type="submit" class="btn btn-danger">Supprimer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Fin carte -->

</div>