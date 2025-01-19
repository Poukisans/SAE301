<div class="container-fluid">
    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">
        <!-- Ajout -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addArticle"><i class="fas fa-plus"></i></i> &nbsp; Ajouter article</button>
    </div>

    <!-- Modal ajout -->
    <form action="" method="POST" class="align-items-center justify-content-center d-flex">
        <div id="addArticle" class="modal fade" tabindex="-1" aria-labelledby="addArticle" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 80vw; height:50vh;">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex flex-column flex-fill">

                            <table id="table2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Article</th>
                                        <th>Categorie</th>
                                        <th>Prix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($articleList as $content) {
                                    ?>

                                        <tr>
                                            <td>
                                                <?php
                                                if ($content['affichage_accueil'] == 1) {
                                                ?>
                                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cet article est déjà en sur la page d'accueil.">
                                                        <input type="checkbox" disabled checked style="pointer-events: none; cursor:not-allowed;">
                                                    </span>
                                                <?php
                                                } elseif ($content['affichage'] == 0) {
                                                ?>
                                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cet article n'est pas à la vente.">
                                                        <input type="checkbox" disabled style="pointer-events: none; cursor:not-allowed;">
                                                    </span>
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="checkbox" name="selected_articles[]" value="<?= $content['id'] ?>" class="articleCheckbox">
                                                <?php
                                                }
                                                ?>
                                            </td>
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
                                                    echo $content['prix'] . " €";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>


                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button name="addArticle" value="<?= $promotionInfo['id'] ?>" type="submit" class="btn btn-success">Ajouter article(s)</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- ================== MODIFICATIONS ================== -->
    <div class="card card-secondary color-palette-box mt-3">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-pencil-alt"></i>
                &nbsp;
                Articles à la une
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->

            <table id="table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Categorie</th>
                        <th>Prix</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($articleList as $content) {
                        if ($content['affichage_accueil'] == 1) {
                    ?>

                            <tr>
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
                                        echo $content['prix'] . " €";
                                    }
                                    ?>
                                </td>
                                <td class="d-flex justify-content-end">
                                    <form action="" method="post" class="m-0">
                                        <button type="submit" name="removeArticle" value="<?= $content['id'] ?>" class="btn btn-danger h-100">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- Fin carte -->

</div>