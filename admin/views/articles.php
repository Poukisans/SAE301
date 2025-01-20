<div class="container-fluid">
    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-between">
        <div class="d-flex flex-column mx-3 justify-content-center">
            <form action="" method="POST">
                <button type="submit" name="changerVue" class="btn btn-primary">
                    Changer vue
                </button>
            </form>
        </div>
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
    <?php
    if ($_SESSION['vue_article'] == 1) {
    ?>
        <!-- ================== LISTE IMG ================== -->
        <div class="card">
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
    <?php
    } elseif ($_SESSION['vue_article'] == 0) {
    ?>
        <!-- ================== LISTE ================== -->
        <div class="card card-danger">
            <!-- Contenu carte -->
            <div class="card-body d-flex flex-column justify-content-between">
                <!-- Informations  -->
                <table id="table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Article</th>
                            <th>Categorie</th>
                            <th>Prix</th>
                            <th>En vente</th>
                            <th></th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($articleList as $content) {
                        ?>

                            <tr>
                                <td><?= $content['id'] ?></td>
                                <td><?= $content['nom'] ?></td>
                                <td><?= ucfirst($content['categorie']) ?></td>
                                <td>
                                    <?php
                                    if (!empty($content['promotion'])) {
                                    ?>
                                        <span style="text-decoration: line-through;"><?= $content['prix']; ?> €</span>
                                        &nbsp;
                                        <b class="text-danger"><i class="fas fa-tags"></i> <?= number_format($content['promotion'], 2, '.', ''); ?> €</b>
                                    <?php
                                    } else {
                                        echo $content['prix']." €";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($content['affichage'] == 0) {
                                        echo "Non";
                                    } elseif ($content['affichage'] == 1) {
                                        echo "Oui";
                                    }
                                    ?>
                                </td>
                                <td style="vertical-align: middle; text-align: right; white-space: nowrap;">
                                    <!-- Accéder -->
                                    <a href="articles/<?= $content['lien'] ?>" role="button" class="btn btn-primary py-2">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>


            </div>
        </div>
        <!-- Fin carte -->
    <?php
    }
    ?>




</div>