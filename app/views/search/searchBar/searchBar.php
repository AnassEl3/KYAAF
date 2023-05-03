<div class="searchBar">
    <div class="container rounded bg-white p-0 my-2">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="d-flex justify-content-start align-items-center rounded-top w-100 bg-primary p-1">
                <h5 class="text-white text-uppercase">Barre de recherche</h5>
            </div>
            <div class="d-flex justify-content-center align-items-center w-100 p-2">
                <form id="searchBarForm" class="d-flex justify-content-center align-items-center flex-column flex-sm-row" method="get" action="/recherche">
                    <?php
                    $query = "";
                        if(isset($_GET["r"])){
                            $query = $_GET["r"];
                        }
                    ?>
                    <input class="form-control m-1" type="text" maxlength="50" name="r" placeholder="Que recherchez-vous ?" value="<?= $query ?>">
                    <select class="form-control m-1" name="c">
                        <option value="0">Toutes les catégories</option>
                        <?php
                            foreach($categories as $categorie):
                                if ($categorie->getInfos()['idCat'] == $_GET["c"]):
                        ?>
                            <option value="<?= $categorie->getInfos()['idCat'] ?>" selected><?= $categorie->getInfos()['nomCat'] ?></option>
                            <?php
                                else:
                            ?>
                            <option value="<?= $categorie->getInfos()['idCat'] ?>"><?= $categorie->getInfos()['nomCat'] ?></option>
                        <?php
                                endif;
                            endforeach;
                        ?>
                    </select>
                    <select class="form-control m-1" name="v">
                        <option value="0">Tout le Maroc</option>
                        <?php
                            foreach ($cities as $ville):
                                if ($ville->getInfos()['idVille'] == $_GET["v"]):
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
                </form>
            </div>
            <div class="d-flex justify-content-end align-items-center w-100 p-2">
                <button id="btn-search" class="btn btn-secondary text-white" form="searchBarForm" type="submit">RECHERCHER</button>
            </div>
        </div>
    </div>
</div>