<div class="accountInfo">
    <div class="container rounded bg-white p-1 my-2">
        <div class="d-flex justify-content-center align-items-center flex-column w-100">
            <div class="d-flex justify-content-start align-items-center w-100">
                <h5>Mon compte</h5>
            </div>
            <form id="modifyAccountForm" class="d-flex justify-content-center align-items-center flex-wrap w-100" action="/modifyAccount" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <img class="myAccountAvatarDisplayer bg-primary rounded-circle m-2" src="data:image/*;charset=utf8;base64,<?= base64_encode($accountInfos['avatar']); ?>">
                    <h5 class="text-capitalize"><?= $accountInfos['nom'] . " " . $accountInfos['prenom'] ?></h5>
                    <div class="d-flex justify-content-center align-items-center flex-column m-1">
                        <a class="d-flex justify-content-center align-items-center btn btn-secondary text-white" onclick="document.getElementById('myAccountChangeAvatarInput').click();">
                            <span class="material-icons mr-1">face</span>
                            Changer photo de profil
                        </a>
                        <input id="myAccountChangeAvatarInput" class="form-control " type="file" name="accountAvatar" hidden name="accountAvatar" accept="image/jpeg,image/jpg,image/png,image/gif">    
                    </div>
                    <a class="d-flex justify-content-center align-items-center btn btn-info text-white text-nowrap m-1" data-toggle="modal" data-target="#changePassword">
                        <span class="material-icons mr-1">vpn_key</span>
                        Changer mot de passe
                    </a>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <div class="d-flex justify-content-start align-items-start flex-column m-2">
                        <div class="d-flex justify-content-center align-items-center m-2">
                            <p class="text-nowrap m-0 p-0">Prénom :</p>
                            <input class="form-control m-1" type="text" name="accountPrenom" value="<?= $accountInfos["prenom"] ?>" required>
                        </div>
                        <div class="d-flex justify-content-center align-items-center m-2">
                            <p class="text-nowrap m-0 p-0">Nom :</p>
                            <input class="form-control m-1" type="text" name="accountNom" value="<?= $accountInfos["nom"] ?>" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-start flex-column m-2">
                        <div class="d-flex justify-content-center align-items-center m-2">
                            <p class="text-nowrap m-0 p-0">Date de naissance :</p>
                            <input class="form-control m-1" type="date" name="birthday" value="<?= $accountInfos["dateNaiss"] ?>" required>
                        </div>
                        <div class="d-flex justify-content-center align-items-center m-2">
                            <p class="text-nowrap m-0 p-0">Ville :</p>
                            <select class="form-control m-1" name="idCity" required>
                                    <?php
                                        foreach ($cities as $ville):
                                            if ($ville->getInfos()['idVille'] == $accountInfos['idVille']):
                                                ?>
                                                <option value="<?= $ville->getInfos()['idVille'] ?>" selected><?= $ville->getInfos()['nomVille'] ?></option>
                                            <?php
                                            else:
                                                ?>
                                                <option value="<?= $ville->getInfos()['idVille'] ?>"><?= $ville->getInfos()['nomVille'] ?></option>
                                            <?php
                                            endif;
                                        endforeach;
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-start flex-column m-2">
                        <div class="d-flex justify-content-center align-items-center m-2">
                            <p class="text-nowrap m-0 p-0">Email :</p>
                            <input class="form-control m-1" type="email" name="accountEmail" value="<?= $accountInfos["email"] ?>" required>
                        </div>
                        <div class="d-flex justify-content-center align-items-center m-2">
                            <p class="text-nowrap m-0 p-0">Téléphone :</p>
                            <input class="form-control m-1" type="tel" name="accountPhone" value="<?= $accountInfos["telephone"] ?>" required>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-end align-items-center flex-wrap w-100">
                <button class="d-flex justify-content-center align-items-center btn btn-primary text-white text-nowrap m-1" type="submit" name="accountSubmit" form="modifyAccountForm">
                    <span class="material-icons mr-1">save</span>
                    Sauvegarder
                </button>
                <a class="d-flex justify-content-center align-items-center btn btn-primary text-white text-nowrap m-1" onclick="window.location.href = window.location.href;">
                    <span class="material-icons mr-1">restart_alt</span>
                    Reprendre
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changePassword">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title d-flex justify-content-center align-items-center">
                    <span class="material-icons">lock_open</span>
                    Changer mot de passe
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm" class="d-flex justify-content-center align-items-center flex-column" action="/modifyAccount" method="post">
                    <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                        <p class="m-0 p-0 text-nowrap label">Mot de passe actuel :</p>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column my-3">
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Nouveau mot de passe :</p>
                            <input class="form-control" type="password" name="newPassword" required>
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Confirmer nouveau Mot de passe :</p>
                            <input class="form-control" type="password" name="newPasswordConfirm" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="d-flex justify-content-center align-items-center btn btn-success text-white text-nowrap m-1" type="submit" name="changePasswordSubmit" form="changePasswordForm">
                    <span class="material-icons mr-1">lock</span>
                    Changer
                </button>
                <a class="d-flex justify-content-center align-items-center btn btn-primary text-white text-nowrap m-1" data-dismiss="modal">
                    Annuler
                </a>
            </div>
        </div>
    </div>
</div>