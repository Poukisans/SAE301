<!-- ============ PRESTATION HEADER ============ -->
<section role="section">
    <div class="section_header container prestation_header">
        <div class="row title_container">
            <div class="title container">
            <h2 class="dogma_title uppercase"><?= $layoutContent['sectionList'][6]['nom'] ?></h2>
            </div>
        </div>
    </div>

    <!-- ============ DETAILS PRESTATION ============ -->
    <div class="contact" role="form">
        <?php
        if (!empty($successMessage) or !empty($errorMessage)) {
        ?>
            <div class="row form_output">
                <p><?= !empty($successMessage) ? $successMessage : "" ?>
                    <?= !empty($errorMessage) ? $errorMessage : "" ?></p>
            </div>
        <?php
        }
        ?>

        <div class="row contact_container">
            <div class="container contact_description">
                <h3 class="inter_title"><b>Formulaire de contact</b></h3>

                <p class="inter_secondary"> <b>Faites attention à sélectionner le bon type de demande !</b><br>
                    Pour les demandes de devis (photo, vidéo, graphisme) sélectionnez : Prestations.</b></p>
            </div>

            <form class="container contact_form white_text" method="post" action="./contact/submit">
                <div class="row">
                    <input class="input_white inter_secondary" type="text" name="nom" id="nom" placeholder="Nom" aria-label="Nom">
                    <input class="input_white inter_secondary" type="text" name="prenom" id="prenom" placeholder="Prenom" aria-label="Prenom">
                </div>

                <div class="row">
                    <input class="input_white inter_secondary" type="mail" name="mail" id="" placeholder="Email" aria-label="Email">
                </div>

                <div class="container">
                    <p><b>Sélectionnez un type de demande</b></p>
                    <div class="container type_demande">
                        <div class="row">
                            <label class="row" for="type_prestation_1">
                                <input type="radio" name="type_prestation" id="type_prestation_1" value="prestation" hidden class="checkbox-input">
                                <span class="checkbox"></span>
                                <p class="inter_secondary">Prestations (graphisme, photo, vidéo)</p>
                            </label>
                        </div>
                        <div class="row">
                            <label class="row" for="type_prestation_2">
                                <input type="radio" name="type_prestation" id="type_prestation_2" value="relation_presse" hidden class="checkbox-input">
                                <span class="checkbox"></span>
                                <p class="inter_secondary">Relations Presse (films)</p>
                            </label>
                        </div>
                        <div class="row">
                            <label class="row" for="type_prestation_3">
                                <input type="radio" name="type_prestation" id="type_prestation_3" value="production" hidden class="checkbox-input">
                                <span class="checkbox"></span>
                                <p class="inter_secondary">Production (fictions, documentaires)</p>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <input class="input_white inter_secondary" type="text" name="objet" id="objet" placeholder="Objet" aria-label="Objet du message">
                    <textarea class="inter_secondary message" name="message" id="message" placeholder="Message" aria-label="Message"></textarea>
                </div>

                <div class="container">
                    <p class="inter_secondary">En soumettant ce formulaire, j'accepte que les informations saisies soient utilisées dans le cadre de la demande de contact et de la relation commerciale qui peut en découler. </p>
                </div>

                <div class="row submit">
                    <button class="button_black_border" type="reset">Effacer</button>
                    <button class="button_white" type="submit">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</section>