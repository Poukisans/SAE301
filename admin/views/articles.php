<div class="container-fluid">
    <!-- ================== BOUTONS ACTIONS ================== -->
    <div class="my-3 d-flex flex-row justify-content-end">
        <!-- Acceder a -->
        <a href="/articles/nouvel_article" role="button" class="btn btn-success h-100"> <i class="fas fa-plus mx-1"></i> &nbsp; Nouvel article</a>
    </div>

    <!-- ================== LISTE ================== -->
    <div class="card card-primary">
        <!-- /.card-header -->
        <div class="d-flex p-3" style="gap: 20px;">
            <?php
            foreach ($articleList as $content) {
            ?>
                <div class="d-flex flex-row" style="gap: 20px;">
                    <a href="articles/<?=$content['lien']?>" class="d-flex flex-column bg-white shadow-sm rounded" style="cursor:pointer;">
                        <img src="<?=BASE_URL?><?=$content['miniature']?>" style="width: 200px; height:200px;">
                        <p class="my-3 mx-2"><?=$content['nom']?></p>
                    </a>
                </div>
            <?php
            }
            ?>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- Fin carte -->

</div>