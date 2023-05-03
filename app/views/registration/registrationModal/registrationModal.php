<div class="registration">
    <div class="container rounded bg-white p-0 my-2">
        <div class="innerContainer d-flex justify-content-center align-items-center flex-column w-100">
            <div class="d-flex justify-content-start align-items-center rounded-top w-100 bg-primary p-1">
                <h5 class="text-white text-uppercase">Inscription</h5>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column flex-grow-1 h-100 w-100 p-2">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <p class="text-center">Bienvenue dans KYAAF</p>
                    <p class="text-center">
                    </p>
                </div>
                <form id="registrationForm" class="d-flex justify-content-around align-items-start flex-wrap flex-grow-1 w-100" action="/signin" method="post" enctype="multipart/form-data">
                    <div class="d-flex justify-content-center align-items-center flex-column flex-grow-1 p-1">
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Prénom :</p>
                            <input class="form-control" type="text" name="firstName" required maxlength="30">
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Nom :</p>
                            <input class="form-control" type="text" name="lastName" required maxlength="30">
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Sexe :</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="d-flex justify-content-center align-items-center mx-2">
                                    <input class="btn" name="gender" type="radio" value="m" checked>
                                    <p class="p-0 m-0 mx-1 ">Masculin</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center mx-2">
                                    <input class="btn" name="gender" type="radio" value="f">
                                    <p class="p-0 m-0 mx-1">Féminin</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Ville :</p>
                            <select class="custom-select form-control" name="idCity" id="idCity">
                                <?php
                                    foreach($cities as $ville):
                                ?>
                                    <option value="<?= $ville->getInfos()['idVille'] ?>"><?= $ville->getInfos()['nomVille'] ?></option>
                                <?php
                                    endforeach
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Date de naissance :</p>
                            <input class="form-control m-1" type="date" name="birthday" required>
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Email :</p>
                            <input class="form-control" type="email" name="email" required maxlength="50">
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Téléphone :</p>
                            <input class="form-control" type="tel" name="phone" required maxlength="10">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column flex-grow-1 p-1">
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Mot de passe :</p>
                            <input class="form-control" type="password" name="password" required maxlength="50">
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Confirmer mot de passe :</p>
                            <input class="form-control" type="password" name="passwordConfirm" required maxlength="50">
                        </div>
                        <div class="d-flex justify-content-center align-items-start flex-column w-100 p-1">
                            <p class="m-0 p-0 text-nowrap label">Photo de profile :</p>
                            <div class="d-flex justify-content-center align-items-center p-2 w-100">
                                <img class="registrationAvatarDisplayer bg-primary rounded-circle" src="../../../media//images/defaultAccountImage.png">
                            </div>
                            <div class="d-flex justify-content-center align-items-center flex-column p-1 w-100">
                                <input class="btn btn-secondary" type="button" value="Choisir une image" onclick="document.getElementById('profilePicInput').click();" />
                                <input id="profilePicInput" class="form-control" hidden type="file" name="profilePic" accept="image/jpeg,image/jpg,image/png,image/gif">    
                            </div>
                            
                        </div>
                    </div>
                </form>
                <input class="btn btn-primary text-white w-100 mt-3" type="submit" name="submit" form="registrationForm" value="Créez un compte">
            </div>
        </div>
    </div>
</div>