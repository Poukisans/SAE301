<div class="container-fluid">

    <!-- ================== CARTE AJOUT REALISATIONS ================== -->
    <div class="container d-flex flex-rox flexwrap">

    </div>
    <div class="card card-secondary color-palette-box">

        <!-- Titre carte -->
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-plus"></i>
                &nbsp;
                Paramètres <?= $currentContent ?>
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <form action="user" method="post">

                <div class="d-flex align-items-center w-100">
                    <div class="d-flex flex-column flex-fill">

                        <!-- Titre et Réalisateur  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="prenom">Prénom</label>
                                <input name="prenom" value="<?= $_SESSION['prenom'] ?>" required class="form-control" type="text">
                            </div>

                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="nom">Nom</label>
                                <input name="nom" value="<?= $_SESSION['nom'] ?>" required class="form-control" type="text">
                            </div>
                        </div>

                        <!-- Pseudo  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill w-100">
                                <label for="pseudo">Pseudo</label>
                                <input name="pseudo" value="<?= $_SESSION['pseudo'] ?>" required class="form-control" type="text">
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                            <div class="d-flex flex-column mx-3 justify-content-center">
                                <button name="updateUser" class="btn btn-success" type="submit"><i class="fas fa-sync"></i> &nbsp; Mettre à jour</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form action="user" method="post">

                <div class="d-flex align-items-center w-100">
                    <div class="d-flex flex-column flex-fill">


                        <!-- Mot de passe  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mt-3 mb-2 flex-fill w-100">
                                <label for="old_password">Ancien mot de passe</label>
                                <input name="old_password" required class="form-control mb-2" type="password">

                                <label for="password">Nouveau mot de passe</label>
                                <input name="password" required class="form-control mb-2" type="password">
                                <input name="password_confirm" required class="form-control" type="password">

                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                            <div class="d-flex flex-column mx-3 justify-content-center">
                                <button name="updatePassword" class="btn btn-success" type="submit"><i class="fas fa-sync"></i> &nbsp; Mettre à jour</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fin carte -->

</div>