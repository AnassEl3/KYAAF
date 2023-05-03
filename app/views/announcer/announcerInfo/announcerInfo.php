<div class="announcerInfo">
    <div class="container rounded">
        <div class="d-flex justify-content-center align-items-center">
            <div class="roundedBackground d-flex justify-content-center align-items-center flex-wrap bg-white">
                <div class="roundedBackground d-flex justify-content-center align-items-center w-100 bg-primary p-1">
                    <h5 class="text-white text-uppercase">Annonceur</h5>
                </div>
                <div class="d-flex justify-content-center align-items-center p-3">
                    <img class="rounded-circle bg-primary m-1" src="data:image/*;charset=utf8;base64,<?= base64_encode($announcer['avatar']); ?>">
                    <div class="d-flex justify-content-center align-items-center flex-column m-1">
                        <p>
                            <span class="text-muted">Annonceur :</span> 
                            <span class="text-capitalize h5"> <?= $announcer["nom"] . " " . $announcer["prenom"] ?></span>
                        </p>
                        <p>
                            <span class="text-muted">Nombre des annonces :</span> 
                            <span class="text-capitalize h5"><?= count($announcements) ?></span>
                        </p>
                        <p>
                            <span class="text-muted">Téléphone :</span> 
                            <span class="text-capitalize h5"><?= $announcer["telephone"] ?></span>
                        </p>
                        <p>
                            <span class="text-muted">Email :</span> 
                            <span class="text-capitalize h5"><?= $announcer["email"] ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>