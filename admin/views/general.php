<div class="container-fluid">

    <!-- ================== MODIF META DESC ================== -->
    <div class="card card-secondary color-palette-box mt-3">
        <!-- Titre carte -->

        <div class="card-header">
            <h3 class="card-title">
                <i class="fab fa-google"></i>
                &nbsp;
                Modifier description Google
            </h3>
        </div>

        <!-- Contenu carte -->
        <div class="card-body d-flex flex-column justify-content-between">
            <!-- Informations  -->
            <form action="general" method="post">

                <div class="d-flex align-items-center w-100">
                    <div class="d-flex flex-column flex-fill">

                        <!-- Titre et type  -->
                        <div class="d-flex flex-row flex-fill">
                            <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                <label for="meta_desc">Description Google</label>
                                <textarea name="meta_desc" required class="form-control" maxlength="150"><?= $generalInfo['meta_desc'] ?></textarea>
                                <p class="font-weight-light font-italic mx-2 my-1">Max 150 caractères</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                    <div class="d-flex flex-column mx-3 justify-content-center">
                        <button name="updateMetaDesc" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i></i> &nbsp; Mettre à jour</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fin carte -->

    <div class="row">
        <div class="col-12 col-md-6">
            <!-- ================== MODIF META DESC ================== -->
            <div class="card card-secondary color-palette-box">
                <!-- Titre carte -->

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fab fa-google"></i>
                        &nbsp;
                        Modifier description Google
                    </h3>
                </div>

                <!-- Contenu carte -->
                <div class="card-body d-flex flex-column justify-content-between">
                    <!-- Informations  -->
                    <form action="general" method="post">

                        <div class="d-flex align-items-center w-100">
                            <div class="d-flex flex-column flex-fill">

                                <!-- Titre et type  -->
                                <div class="d-flex flex-row flex-fill">
                                    <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                        <label for="meta_desc">Description Google</label>
                                        <textarea name="meta_desc" required class="form-control" maxlength="150"><?= $generalInfo['meta_desc'] ?></textarea>
                                        <p class="font-weight-light font-italic mx-2 my-1">Max 150 caractères</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                            <div class="d-flex flex-column mx-3 justify-content-center">
                                <button name="updateMetaDesc" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i></i> &nbsp; Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fin carte -->
        </div>

        <div class="col-12 col-md-6">
            <!-- ================== MODIF META DESC ================== -->
            <div class="card card-secondary color-palette-box">
                <!-- Titre carte -->

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fab fa-google"></i>
                        &nbsp;
                        Modifier description Google
                    </h3>
                </div>

                <!-- Contenu carte -->
                <div class="card-body d-flex flex-column justify-content-between">
                    <!-- Informations  -->
                    <form action="general" method="post">

                        <div class="d-flex align-items-center w-100">
                            <div class="d-flex flex-column flex-fill">

                                <!-- Titre et type  -->
                                <div class="d-flex flex-row flex-fill">
                                    <div class="d-flex flex-column justify-content-end mx-3 mb-2 flex-fill">
                                        <label for="meta_desc">Description Google</label>
                                        <textarea name="meta_desc" required class="form-control" maxlength="150"><?= $generalInfo['meta_desc'] ?></textarea>
                                        <p class="font-weight-light font-italic mx-2 my-1">Max 150 caractères</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse justify-content-between align-items-center d-flex mt-3">
                            <div class="d-flex flex-column mx-3 justify-content-center">
                                <button name="updateMetaDesc" class="btn btn-success" type="submit"><i class="fas fa-sync-alt"></i></i> &nbsp; Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fin carte -->
        </div>

    </div>

</div>