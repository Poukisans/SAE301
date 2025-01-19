<?php
var_dump($_POST);
?>
<div class="container-fluid">

    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">

        <!-- Suppression -->
        <button type="button" class="btn btn-danger h-100" data-toggle="modal" data-target="#delete">
            <i class="fas fa-trash"></i> &nbsp; Supprimer
        </button>

        <!-- Modal suppression -->
        <form action="promotions" method="POST" class="align-items-center justify-content-center d-flex">
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

    <!-- ================== CARTE ================== -->
    <div class="container d-flex flex-rox flexwrap">

    </div>
    <div class="card card-secondary color-palette-box">

        <!-- Titre carte -->
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-plus"></i>
                &nbsp;
                Gestion <?= $currentContent ?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <form action="" method="post">

                <div class="d-flex align-items-center w-100">
                    <div class="d-flex flex-column flex-fill">

                        <!-- Nom  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="nom">Nom de la promotion</label>
                                <input name="nom" value="<?= $promotionInfo["nom"] ?>" required class="form-control" type="text">
                            </div>
                        </div>

                        <!-- Type  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-3 flex-fill">
                                <label for="type">Type de promotion</label>
                                <select name="type" class="form-control" required>
                                    <option value="0" <?= $promotionInfo["type"] == 0 ? "selected" : "" ?>>Promotion</option>
                                    <option value="1" <?= $promotionInfo["type"] == 1 ? "selected" : "" ?>>Prix forcé</option>
                                    <option value="2" <?= $promotionInfo["type"] == 2 ? "selected" : "" ?>>Prix de lot</option>
                                </select>
                            </div>
                        </div>

                        <!-- Promotion  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <?php
                                if ($promotionInfo["type"] == 0) {
                                ?>
                                    <label for="promotion">Rabais (%)</label>
                                <?php
                                } elseif ($promotionInfo["type"] == 1) {
                                ?>
                                    <label for="promotion">Prix forcé (€)</label>
                                <?php
                                } elseif ($promotionInfo["type"] == 2) {
                                ?>
                                    <label for="promotion">Prix du lot (€)</label>
                                <?php
                                }
                                ?>
                                <input name="promotion" value="<?= number_format($promotionInfo['promotion'], 2, '.', '') ?>" required class="form-control" type="number">
                            </div>
                        </div>

                        <!-- Date  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="date_debut">Date début (inclus)</label>
                                <input name="date_debut" value="<?= $promotionInfo['date_debut'] ?>" required class="form-control" type="date">
                            </div>

                            <div class="d-flex flex-column justify-content-center align-items-center mx-3 mb-2">
                                <i class="fas fa-arrow-right mt-4" style="font-size: 1.5rem;"></i>
                            </div>

                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="date_fin">Date fin (inclus)</label>
                                <input name="date_fin" value="<?= $promotionInfo['date_fin'] ?>" class="form-control" type="date">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                    <div class="d-flex flex-column mx-3 justify-content-center">
                        <button name="update" value="<?= $promotionInfo['id'] ?>" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i> &nbsp; Mettre à jour</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fin carte -->

    <!-- ================== MODIFICATIONS ================== -->
    <div class="card card-secondary color-palette-box mt-3">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-pencil-alt"></i>
                &nbsp;
                Articles en <?= $currentContent ?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->

            <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex my-2">
                <div class="d-flex flex-column mx-3 justify-content-center">
                    <button type="button" class="btn btn-success h-100" data-toggle="modal" data-target="#addArticle">
                        <i class="fas fa-plus"></i> &nbsp; Ajouter article
                    </button>
                </div>
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
                                                        //vérification si autre promotion déja active à la même date
                                                        if (
                                                            !empty($content['id_promotion'])
                                                            && $content['id_promotion'] != $promotionInfo['id']
                                                            && (
                                                                strtotime($content['date_debut']) <= strtotime($promotionInfo['date_fin']) && strtotime($content['date_fin']) >= strtotime($promotionInfo['date_debut'])
                                                            )
                                                        ) {
                                                        ?>
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cet article est déjà en promotion sur une autre promotion pour les mêmes dates.">
                                                                <input type="checkbox" disabled checked style="pointer-events: none; cursor:not-allowed;">
                                                            </span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <input type="checkbox" name="selected_articles[]" value="<?= $content['id'] ?>" <?= $content['id_promotion'] == $promotionInfo['id'] ? "checked disabled" : "" ?> class="articleCheckbox">
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $content['nom'] ?></td>
                                                    <td><?= ucfirst($content['categorie']) ?></td>
                                                    <td><?= $content['prix'] ?> €</td>
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

            <table id="table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Categorie</th>
                        <th>Prix</th>
                        <th>Nouveau prix</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($promotionArticleInfo as $content) {
                    ?>

                        <tr>
                            <td><?= $content['nom'] ?></td>
                            <td><?= ucfirst($content['categorie']) ?></td>
                            <td><?= $content['prix'] ?> €</td>
                            <td class="text-danger">
                                <b>
                                    <?php
                                    switch ($content['type']) {
                                        case 0:
                                            echo number_format($content['prix_promotion'], 2, '.', '') . " €";
                                            break;
                                        case 1:
                                            echo number_format($content['prix_promotion'], 2, '.', '') . " €";
                                            break;
                                        case 2:
                                            echo "Vente par lot (" . number_format($content['prix_promotion'], 2, '.', '') . " € le lot)";
                                            break;
                                    }
                                    ?>
                                </b>
                            </td>
                            <td class="d-flex justify-content-end">
                                <form action="" method="post" class="m-0">
                                    <input type="hidden" name="id_promotion" value="<?=$promotionInfo['id']?>">
                                    <button type="submit" name="deleteArticle" value="<?=$content['id_article']?>" class="btn btn-danger h-100">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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

</div>