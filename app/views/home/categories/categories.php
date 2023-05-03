<div class="categories">
    <div class="d-flex justify-content-center align-items-center flex-column p-2">
        <h1 class="p-2">Catégories des annonces</h1>
        <div class="d-flex justify-content-center align-items-stretch flex-wrap">
            <?php
                foreach($categories as $categorie):
            ?>
                <div class="categorie d-flex justify-content-start align-items-center flex-column bg-white rounded m-1">
                    <a class="categorieTitle bg-primary text-white rounded-top text-decoration-none p-1 w-100 h-100 text-center" href="/recherche?r=&c=<?= $categorie->getInfos()['idCat'] ?>&v=0">
                        <img src="../../../media/images/categories/<?= $categorie->getInfos()['nomCat'] ?>.svg">
                        <br>
                        <?= $categorie->getInfos()['nomCat'] ?>
                    </a>
                </div>
            <?php
                endforeach;
            ?>
        </div>
    </div>
</div>