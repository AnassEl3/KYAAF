<?php
$title = "Connexion";
require 'views/shared/header.php';
?>
<link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css">
<div class="container-fluid bg-login h-100">
    <div class="row h-100">
        <div class="col h-100 d-flex justify-content-center align-items-center">
            <div class="container prime-heading-card">
                <div class="row">
                    <p class="display-5">Connexion</p>
                </div>
                <div class="row my-4">
                    <div class="col">
                        <div class="container">
                            <form method="post" action="/login-val">
                                <div class="row m-4">
                                    <label class="form-label fw-normal" for="email">Email</label>
                                    <input class="form-control" type="text" name="email" id="email" required/>
                                </div>
                                <div class="row m-4">
                                    <label class="form-label fw-normal" for="password">Mot de passe</label>
                                    <input class="form-control" type="password" name="password" id="password" required/>
                                </div>
                                <div class="row mt-5 ms-4 me-4">
                                    <input class="btn bg-kyaaf-blue-gradient text-light fw-bold" type="submit" name="submit" value="Connexion">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>