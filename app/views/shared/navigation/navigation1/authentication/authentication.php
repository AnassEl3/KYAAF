<div class="authentication">
    <div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white" id="exampleModalScrollableTitle">Connexion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="loginForm" action="/login" method="post">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <img class="kyaafLogo w-50 p-2" src="../../../media/images/KYAAF_Logo.png">
                  <div class="d-flex justify-content-center align-items-start flex-column m-1">
                    <input id="loginEmail" class="form-control m-1" name="email" type="email" maxlength="50" placeholder="Email ..." required>
                    <input id="loginPassword" class="form-control m-1" name="password" type="password" maxlength="50" placeholder="Mot de passe ..." required>
                  </div>
                  <div class="m-1">
                    <div className="form-check">
                      <input id="loginCheckbox" className="form-check-input" type="checkbox">
                      <label className="form-check-label">Se souvenir de moi</label>
                    </div>
                    <a href="#" className="">J'ai oublié mon mot de passe</a>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <input id="loginFormSubmit" class="btn btn-primary text-white" form="loginForm" type="submit" name="submit" value="Se connecter">
              <a class="btn btn-primary text-white" data-dismiss="modal">
                Annuler
              </a>
            </div>
          </div>
        </div>
      </div>
</div>