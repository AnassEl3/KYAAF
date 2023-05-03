<div class="addAnnouncement">
    <div class="container rounded bg-white p-0 my-2">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="d-flex justify-content-start align-items-center rounded-top w-100 bg-primary p-1">
                <h5 class="text-white text-uppercase">Nouvelle annonce</h5>
            </div>
            <form id="addAnnouncementForm" class="d-flex justify-content-start align-content-center flex-column w-100 p-2" action="/addAnnouncement" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-center align-items-start flex-wrap">                    
                    <div class="thumbnail d-flex justify-content-center align-items-center flex-column m-1">
                        <img class="newAnnouncementThumbnailDisplayer rounded" src="../../../media/images/defaultAnnoncementImage.png">
                        <div class="d-flex justify-content-center align-items-center flex-column p-1 w-100">
                            <a class="d-flex justify-content-center align-items-center btn btn-secondary text-white" onclick="document.getElementById('newAnnouncementThumbnailInput').click();">
                                <span class="material-icons mr-1 p-0">photo_camera</span>
                                Fixé miniature
                            </a>
                            <input id="newAnnouncementThumbnailInput" class="form-control" hidden type="file" name="thumbnail" accept="image/jpeg,image/jpg,image/png,image/gif">    
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="d-flex justify-content-center align-items-center m-1">
                            <p class="text-nowrap m-0 p-0">Titre :</p>
                            <input class="form-control m-1" type="text" name="title" required maxlength="50">
                        </div>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <p class="text-nowrap m-0 p-0">Ville :</p>
                            <select id="citySelector" class="custom-select form-control m-1" name="city" id="idCity" required>
                                <?php
                                    foreach($cities as $ville):
                                ?>
                                    <option value="<?= $ville->getInfos()['idVille'] ?>"><?= $ville->getInfos()['nomVille'] ?></option>
                                <?php
                                    endforeach
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <p class="text-nowrap m-0 p-0">Catégorie :</p>
                            <select id="categorieSelecter" class="form-control m-1" name="categorie" required>
                                <?php
                                    foreach($categories as $categorie):
                                ?>
                                    <option value="<?= $categorie->getInfos()['idCat'] ?>"><?= $categorie->getInfos()['nomCat'] ?></option>
                                <?php
                                    endforeach
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <p class="text-nowrap m-0 p-0">Type :</p>
                            <select id="typeSelecter" class="form-control m-1" name="type" required>
                                <?php
                                    foreach($subCategories as $subCategorie):
                                ?>
                                    <option value="<?= $subCategorie->getInfos()['idCat'] ?>" data-parentCat="<?= $subCategorie->getInfos()['idCatMere'] ?>"><?= $subCategorie->getInfos()['nomCat'] ?></option>
                                <?php
                                    endforeach
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start align-items-start flex-column flex-grow-1 m-2">
                    <p class="text-nowrap m-0 p-0">Description :</p>
                    <textarea class="form-control" name="description" required maxlength="300"></textarea>
                </div>
                <div class="d-flex justify-content-center align-items-center m-1 w-100">
                    <p class="text-nowrap m-0 p-0">Prix (Optionnel):</p>
                    <input class="form-control m-1" type="number" name="price" value="0">
                </div>
                <div class="images d-flex justify-content-center align-items-center flex-wrap m-1 w-100">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <p class="text-nowrap m-0 p-0">Images (Optionnelles):</p>
                        <div class="d-flex justify-content-center align-items-end flex-column p-1 w-100">
                            <a class="d-flex justify-content-center align-items-center btn btn-secondary text-white text-nowrap m-1" onclick="document.getElementById('addImageSelecter').click();">
                                <span class="material-icons text-white mr-1 p-0">collections</span>
                                Sélectionner images
                            </a>
                            <input id="addImageSelecter" class="form-control" hidden multiple type="file" name="addImageSelecter[]" accept="image/jpeg,image/jpg,image/png,image/gif">    
                        </div>
                    </div>
                    <div id="imagesContainer" class="d-flex justify-content-center align-items-center flex-wrap w-100">

                    </div>

                </div>
                <input class="btn btn-primary text-white w-100" type="submit" name="submit" value="Créez une annonce">
            </form>  
        </div>
    </div>
</div>