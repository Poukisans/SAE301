<div class="container-fluid">
    <!-- ================== MODIFICATIONS ================== -->
    <div class="card card-secondary color-palette-box mt-3">
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
            <div class="row w-100">
                <div class="col-xs-12 col-sm-12 col-md-7 d-flex flex-column justify-content-center  p-3">
                    <h4 class="mb-3">Informations client</h4>
                    <div class="bg-light h-100 d-flex flex-column justify-content-center p-4">
                        <div class="d-flex">
                            <p class="m-0"><b><?= $commandeInfo['prenom'] ?></b></p>
                            &nbsp;
                            <p class="m-0"><b><?= $commandeInfo['nom'] ?></b></p>
                        </div>

                        <div class="d-flex flex-column">
                            <p class="m-0"><?= $commandeInfo['adresse'] ?></p>
                            <p class="m-0"><?= isset($commandeInfo['complement_adresse']) ? $commandeInfo['complement_adresse'] : "" ?></p>
                        </div>

                        <div class="d-flex">
                            <p class="m-0"><?= $commandeInfo['code_postal'] ?>,</p>
                            &nbsp;
                            <p class="m-0"><?= $commandeInfo['region'] ?>,</p>
                            &nbsp;
                            <p class="m-0"><?= $commandeInfo['pays'] ?></p>
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-5 d-flex flex-column flex-fill">
                    <h4 class="mb-3">Statut commande</h4>
                    <?php
                    if ($commandeInfo['statut'] == 3) {
                    ?>
                        <div class="d-flex flex-column">
                            <button disabled name="statut" value="0" type="submit" class='btn btn-outline-secondary my-2'>Non traitée</button>
                            <button disabled name="statut" value="1" type="submit" class='btn btn-outline-secondary my-2'>Préparée</button>
                            <button disabled name="statut" value="2" type="submit" class='btn btn-outline-secondary my-2'>Expédiée</button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <form action="" method="post" class="d-flex flex-column">
                            <input type="hidden" name="id" value="<?= $commandeInfo['id'] ?>">
                            <button name="statut" value="0" type="submit" class='btn <?= $commandeInfo['statut'] == 0 ? 'btn-danger' : 'btn-outline-danger my-2' ?> my-2'>Non traitée</button>
                            <button name="statut" value="1" type="submit" class='btn <?= $commandeInfo['statut'] == 1 ? 'btn-warning' : 'btn-outline-warning my-2' ?> my-2'>Préparée</button>
                            <button name="statut" value="2" type="submit" class='btn <?= $commandeInfo['statut'] == 2 ? 'btn-success' : 'btn-outline-success my-2' ?> my-2'>Expédiée</button>
                        </form>

                    <?php

                    }
                    ?>
                </div>
            </div>

            <div class="row w-100">
                <?php
                if ($commandeInfo['statut'] == 3) {
                ?>
                    <button disabled class="btn btn-danger my-2 w-100">
                        Commande annulée
                    </button>
                <?php
                } else {
                ?>
                    <button type="button" class="btn <?= $commandeInfo['statut'] == 3 ? 'btn-danger' : 'btn-outline-danger' ?> my-2 w-100" data-toggle="modal" data-target="#cancel">Annuler la commande</button>
                <?php
                }
                ?>

                <!-- Modal suppression -->
                <form action="" method="POST" class="align-items-center justify-content-center d-flex">
                    <div id="cancel" class="modal fade" tabindex="-1" aria-labelledby="cancel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir annuler cette commande ? <br> <br>
                                    <b>Cette action est irréversible. Les articles seront remis en stock.</b>
                                </div>
                                <div class="modal-footer d-flex justify-content-end">
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button name="cancel" value="<?= $commandeInfo['id']?>" type="submit" class="btn btn-danger">Annuler commande</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Fin carte -->

    <!-- ================== LISTE ARTICLES ================== -->
    <div class="card card-secondary color-palette-box mt-3">
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

            <table id="table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Coloris</th>
                        <th>Quantite</th>
                        <th>Taille</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($commandeArticleInfo as $content) {
                    ?>

                        <tr>
                            <td><?= $content['nom_article'] ?></td>
                            <td><?= $content['nom_coloris'] ?></td>
                            <td><b><?= $content['quantite'] ?></b></td>
                            <td>
                                <?php
                                switch ($content['id_taille']) {
                                    case 1:
                                        echo "XXS";
                                        break;
                                    case 2:
                                        echo "XS";
                                        break;
                                    case 3:
                                        echo "S";
                                        break;
                                    case 4:
                                        echo "M";
                                        break;
                                    case 5:
                                        echo "L";
                                        break;
                                    case 6:
                                        echo "XL";
                                        break;
                                    case 7:
                                        echo "XXL";
                                        break;
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
    </div>
    <!-- Fin carte -->
</div>