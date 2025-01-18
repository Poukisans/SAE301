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
            <form enctype="multipart/form-data" name="add" action="./productions" method="post">

                <div class="d-flex align-items-center w-100">
                    <div class="d-flex flex-column flex-fill">

                        <!-- Nom  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="nom">Nom de la promotion</label>
                                <input name="nom" required class="form-control" type="text">
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
                                <input name="promotion" value="<?= $promotionInfo['promotion'] ?>" required class="form-control" type="text">
                            </div>
                        </div>

                        <!-- Par lot  -->
                        <div class="d-flex flex-row flex-fill my-3 mx-3 custom-control custom-switch custom-switch-on-danger align-items-center">
                            <div class="mr-2">
                                <input name="affichage_nav" <?= $content['affichage_nav'] == 1 ? "checked" : "" ?> id="affichage_nav<?= $content['id'] ?>" type="checkbox" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="affichage_nav<?= $content['id'] ?>">Promotion par lot</label>
                            </div>
                        </div>

                        <!-- Date  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="date_debut">Date début</label>
                                <input name="date_debut" value="<?= $promotionInfo['date_debut'] ?>" required class="form-control" type="date">
                            </div>

                            <div class="d-flex flex-column justify-content-center align-items-center mx-3 mb-2">
                                <i class="fas fa-arrow-right mt-4" style="font-size: 1.5rem;"></i>
                            </div>

                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="date_fin">Date fin</label>
                                <input name="date_fin" value="<?= $promotionInfo['date_fin'] ?>" class="form-control" type="date">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                    <div class="d-flex flex-column mx-3 justify-content-center">
                        <button name="add" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i> &nbsp; Mettre à jour</button>
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
                Art <?= $currentContent ?>
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
                        <th>Nouveau prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($promotionArticleInfo as $content) {
                    ?>

                        <tr>
                            <td><?= $content['nom'] ?></td>
                            <td><?= $content['categorie'] ?></td>
                            <td><?= $content['prix'] ?> €</td>
                            <td class="text-danger">
                                <b>
                                    <?php
                                    switch ($promotionInfo['type']) {
                                        case 0:
                                            $prix = $content['prix'] * (100 - $promotionInfo['promotion']) / 100;
                                            echo $prix . " €";
                                            break;
                                        case 1:
                                            echo $promotionInfo['promotion'] . " €";
                                            break;
                                        case 2:
                                            echo "Vente par lot (" . $promotionInfo['promotion'] . " €)";
                                            break;
                                    }
                                    ?>
                                </b>
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