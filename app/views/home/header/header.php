<header class="d-flex justify-content-center align-items-center flex-column w-100 p-2">
    <p class="text-center text-white p-3">
        Trouvez le meilleur produit ou service dans votre zone
    </p>
    <div class="d-flex justify-content-center align-items-center w-100">
        <div class="formDiv d-flex justify-content-center align-items-center rounded p-1">
            <form class="d-flex justify-content-center align-items-center flex-column flex-sm-row" method="get" action="/recherche">
                <input class="form-control m-1" type="text" maxlength="50" name="r" placeholder="Que recherchez-vous ?">
                <select class="form-control m-1" name="c">
                    <option value="0">Toutes les catégories</option>
                    <?php
                        foreach($categories as $categorie):
                    ?>
                        <option value="<?= $categorie->getInfos()['idCat'] ?>"><?= $categorie->getInfos()['nomCat'] ?></option>
                    <?php
                        endforeach
                    ?>
                </select>
                <select class="form-control m-1" name="v">
                    <option value="0">Tout le Maroc</option>
                    <?php
                        foreach($cities as $ville):
                    ?>
                        <option value="<?= $ville->getInfos()['idVille'] ?>"><?= $ville->getInfos()['nomVille'] ?></option>
                    <?php
                        endforeach
                    ?>
                </select>
                <button id="btn-search" class="btn btn-secondary text-white m-1" type="submit">RECHERCHER</button>
            </form>
        </div>
    </div>
</header>