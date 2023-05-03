<div class="notification d-flex justify-content-end align-items-end flex p-2">
    <?php
    if(isset($_SESSION["notification"])){
        switch ($_SESSION["notification"]) {
        
//-- Login -----------------------------------------------------------------------------------------------------
            case 'notLogged':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de l\'action</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Vous devez être connecter pour réaliser cette action.
                        </div>
                    </div>
                ');
            break;

            case 'loginError':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la connexion</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Il y a des problème au niveau des données de la connexion.
                        </div>
                    </div>
                ');
            break;

            case 'loginEmpty':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la connexion</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Entrer l\'email et mot de passe s\'il vous plait.
                        </div>
                    </div>
                ');
            break;

            case 'loginIncorrect':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la connexion</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Email ou mot de passe est incorrecte !!
                        </div>
                    </div>
                ');
            break;

//-- Signin -----------------------------------------------------------------------------------------------------
            case 'signinError':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de l\'inscription</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Il y a des problème au niveau des données de l\'inscription.
                        </div>
                    </div>
                ');
            break;

            case 'signinEmpty':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de l\'inscription</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Remplir tous les case nécessaire s\'il vous plait.
                        </div>
                    </div>
                ');
            break;

            case 'signinEmailPasswordIncorrect':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de l\'inscription</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Vérifier que: <br>
                            - la forme de l\'email est correct. <br>
                            - le mot de passe contient des lesttres et des chiffres (Pas de caractère spéciaux). <br>
                        </div>
                    </div>
                ');
            break;

            case 'signinPasswordConfirmIncorrect':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de l\'inscription</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            La confirmation du mot de passe est incorrecte.
                        </div>
                    </div>
                ');
            break;

            case 'signinEmailUsed':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de l\'inscription</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            L\'email est déja utilisé par un autre utilisateur.
                        </div>
                    </div>
                ');
            break;

            case 'signinFileFormatNotAllowed':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de l\'inscription</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            la photo de profile doit être du format jpg, jpeg, png, gif, pjp, pjpeg ou jfif.
                        </div>
                    </div>
                ');
            break;

            case 'signinDone':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-success">
                            <strong class="mr-auto text-white">Bien enregistrée</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Votre compte à été créé avec succès !! <br>
                            Vous pouvez vous connecter avec votre email et mot de passe.                        
                        </div>
                    </div>
                ');
            break;

//-- My account -----------------------------------------------------------------------------------------------------
            case 'modifyError':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du compte</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Il y a des problème au niveau des données du compte.
                        </div>
                    </div>
                ');
            break;

            case 'modifyEmpty':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du compte</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Remplir tous les case nécessaire s\'il vous plait.
                        </div>
                    </div>
                ');
            break;

            case 'modifyEmailIncorrect':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du compte</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            L\' email forme est incorrecte.
                        </div>
                    </div>
                ');
            break;

            case 'modifyEmailUsed':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du compte</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            L\'email est déja utilisé par un autre utilisateur.
                        </div>
                    </div>
                ');
            break;

            case 'modifyFileFormatNotAllowed':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du compte</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            La forme de l\'image de profile est incorrecte.
                        </div>
                    </div>
                ');
            break;

            case 'modifyDone':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-success">
                            <strong class="mr-auto text-white">Bien enregistrée</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Votre compte à été modifié avec succès !! <br>
                        </div>
                    </div>
                ');
            break;

            case 'changePassError':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du mot de passe</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Il y a des problème au niveau des données.
                        </div>
                    </div>
                ');
            break;

            case 'changePassEmpty':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du mot de passe</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Remplir tous les case nécessaire s\'il vous plait.
                        </div>
                    </div>
                ');
            break;

            case 'changePassOldPassIncorrect':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du mot de passe</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            l\'ancien mot de passe est incorrect.
                        </div>
                    </div>
                ');
            break;

            case 'changePassConfirmIncorrect':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du mot de passe</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            La confirmation du mot de passe est incorrecte.
                        </div>
                    </div>
                ');
            break;

            case 'changePassIncorrect':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification du mot de passe</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Vérifier que: <br>
                            - le mot de passe contient des lesttres et des chiffres (Pas de caractère spéciaux). <br>
                        </div>
                    </div>
                ');
            break;

            case 'changePassDone':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-success">
                            <strong class="mr-auto text-white">Bien enregistrée</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Votre mot de passe à été modifié avec succès !! <br>
                        </div>
                    </div>
                ');
            break;

//-- Add announcement -----------------------------------------------------------------------------------------------------
            case 'addAnnouncementError':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la création d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Il y a des problème au niveau des données de la création d\'annonce.
                        </div>
                    </div>
                ');
            break;

            case 'addAnnouncementEmpty':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la création d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Remplir tous les case nécessaire s\'il vous plait.
                        </div>
                    </div>
                ');
            break;

            case 'addAnnouncementUnvalidThumbnail':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la création d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Image de miniature est pas valide.
                        </div>
                    </div>
                ');
            break;

            case 'addAnnouncementUnvalidImages':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la création d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Images de l\'annonce sont pas valide.
                        </div>
                    </div>
                ');
            break;

            case 'addAnnouncementDBError':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la création d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Il y a un problème avec la base de donnèes.
                        </div>
                    </div>
                ');
            break;

            case 'addAnnouncementDone':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-success">
                            <strong class="mr-auto text-white">Bien enregistrée</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Votre annonce à été créé avec succès !! <br>
                            Il va être validé dans quelque minutes.
                        </div>
                    </div>
                ');
            break; 
            
//-- Modify announcement -----------------------------------------------------------------------------------------------------
            case 'modifyAnnouncementError':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Il y a des problème au niveau des données de la modification d\'annonce.
                        </div>
                    </div>
                ');
            break;

            case 'modifyAnnouncementEmpty':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Remplir tous les case nécessaire s\'il vous plait.
                        </div>
                    </div>
                ');
            break;

            case 'modifyAnnouncementUnvalidThumbnail':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Image de miniature est pas valide.
                        </div>
                    </div>
                ');
            break;

            case 'modifyAnnouncementUnvalidImages':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Images de l\'annonce sont pas valide.
                        </div>
                    </div>
                ');
            break;

            case 'modifyAnnouncementDBError':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-danger">
                            <strong class="mr-auto text-white">Echec de la modification d\'annonce</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Il y a un problème avec la base de donnèes.
                        </div>
                    </div>
                ');
            break;

            case 'modifyAnnouncementDone':
                echo('
                    <div class="toast" role="alert" data-delay="5000">
                        <div class="toast-header bg-success">
                            <strong class="mr-auto text-white">Bien enregistrée</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Votre annonce à été modifié avec succès !! <br>
                            Il va être validé dans quelque minutes.
                        </div>
                    </div>
                ');
            break; 
        }
        unset($_SESSION['notification']);
    }
    ?>
    
</div>