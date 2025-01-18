<div class="container-fluid">
    <!-- ================== GESTION COMMANDE ================== -->
    <div class="card card-danger color-palette-box mt-3">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-truck-loading"></i>
                &nbsp;
                Gestion commande
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <div class="d-fle mb-3">
                <form action="<?=$_GET['archive'] == 1  ? './commandes?archive=1' : './commandes'?>" method="get" class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-row">
                        <button name="filter" value="0" class='mx-1 btn <?= isset($_GET['filter']) && $_GET['filter'] == 0 ? 'btn-danger' : 'btn-outline-danger' ?>'>Non traitée</button>
                        <button name="filter" value="1" class='mx-1 btn <?= isset($_GET['filter']) && $_GET['filter']  == 1 ? 'btn-warning' : 'btn-outline-warning' ?>'>Préparée</button>
                        <button name="filter" value="2" class='mx-1 btn <?= isset($_GET['filter']) && $_GET['filter']  == 2 ? 'btn-success' : 'btn-outline-success' ?>'>Expédiée</button>
                        <button name="filter" value="3" class='mx-1 btn <?= isset($_GET['filter']) && $_GET['filter']  == 3 ? 'btn-secondary' : 'btn-outline-secondary' ?>'>Annulée</button>
                    </div>

                    <div class="d-flex flex-row">
                        <a href="./commandes?archive=1" class="btn <?= isset($_GET['archive']) && $_GET['archive']  == 1 ? 'btn-primary' : 'btn-outline-primary' ?>">Commande archivées</a>
                    </div>
                </form>
            </div>
            <table id="table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($commandeList as $content) {
                    ?>

                        <tr>
                            <td><?= $content['id'] ?></td>
                            <td><?= $content['nom'] ?></td>
                            <td><?= date('d/m/Y', strtotime($content['date'])) ?></td>
                            <td><?= date('H:i', strtotime($content['date'])) ?></td>
                            <td>
                                <?php
                                switch ($content['statut']) {
                                    case 0:
                                        echo "<button class='btn btn-danger'>Non traitée</button>";
                                        break;
                                    case 1:
                                        echo "<button class='btn btn-warning'>Préparée</button>";
                                        break;
                                    case 2:
                                        echo "<button class='btn btn-outline-success'>Expédiée</button>";
                                        break;
                                    case 3:
                                        echo "<button class='btn btn-outline-danger'>Annulée</button>";
                                        break;
                                }
                                ?>
                            </td>
                            <td class="d-flex justify-content-end">
                                <!-- Archiver -->
                                <form action="" method="post" class="m-0 p-0">
                                    <button name="archive" value="<?=$content['id']?>" type="submit" class="btn btn-secondary mx-1"><i class="fas fa-archive"></i></button>
                                </form>

                                <!-- Acceder a -->
                                <a href="commandes/<?= $content['id'] ?>" role="button" class="btn btn-primary mx-1"> <i class="fas fa-external-link-alt mx-1"></i></a>
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