<?php
if (isset($_SESSION['notification'])) {
    switch ($_SESSION['notification']) {
        case 'denied' :
            ?>
            <div
                    class="toast position-absolute"
                    style="bottom: 20px; right: 20px"
                    id="notify_toast"
                    role="alert"
                    aria-live="assertive"
                    aria-atomic="true">
                <div class="toast-header d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <div style="width: 15px; height: 15px; border-radius: 50%; background-color: #5cbd51"></div>
                        <strong class="ms-2">Rejetée avec succes</strong>
                    </div>
                    <button class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                    </button>
                </div>
                <div class="toast-body">
                    <span>L'annonce a été rejetée par vous</span>
                </div>
            </div>
            <?php
            $_SESSION['notification'] = "";
            break;
        case 'granted' :
            ?>
            <div
                    class="toast position-absolute"
                    style="bottom: 20px; right: 20px"
                    id="notify_toast"
                    role="alert"
                    aria-live="assertive"
                    aria-atomic="true">
                <div class="toast-header d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex align-items-stretch justify-content-start">
                        <div style="width: 15px; height: 15px; border-radius: 50%; background-color: #5cbd51"></div>
                        <strong class="ms-2">Autorisée avec succes</strong>
                    </div>
                    <button class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                    </button>
                </div>
                <div class="toast-body">
                    <span>L'annonce a été autorisée par vous</span>
                </div>
            </div>
            <?php
            $_SESSION['notification'] = "";
            break;
        case 'no-granted' :
            ?>
            <div
                    class="toast position-absolute"
                    style="bottom: 20px; right: 20px"
                    id="notify_toast"
                    role="alert"
                    aria-live="assertive"
                    aria-atomic="true">
                <div class="toast-header d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex align-items-stretch justify-content-start">
                        <div style="width: 15px; height: 15px; border-radius: 50%; background-color: #e12635"></div>
                        <strong class="ms-2">Erreur d'autorisation</strong>
                    </div>
                    <button class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                    </button>
                </div>
                <div class="toast-body">
                    <span>Nous avons rencontré un probleme durant l'autorisation</span>
                </div>
            </div>
            <?php
            $_SESSION['notification'] = "";
            break;
        case 'no-denied' :
            ?>
            <div
                    class="toast position-absolute"
                    style="bottom: 20px; right: 20px"
                    id="notify_toast"
                    role="alert"
                    aria-live="assertive"
                    aria-atomic="true">
                <div class="toast-header d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex align-items-stretch justify-content-start">
                        <div style="width: 15px; height: 15px; border-radius: 50%; background-color: #e12635"></div>
                        <strong class="ms-2">Erreur de rejet</strong>
                    </div>
                    <button class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                    </button>
                </div>
                <div class="toast-body">
                    <span>Nous avons rencontré un probleme durant le rejet</span>
                </div>
            </div>
            <?php
            $_SESSION['notification'] = "";
            break;
        case 'no-view' :
            ?>
            <div
                    class="toast position-absolute"
                    style="bottom: 20px; right: 20px"
                    id="notify_toast"
                    role="alert"
                    aria-live="assertive"
                    aria-atomic="true">
                <div class="toast-header d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex align-items-stretch justify-content-start">
                        <div style="width: 15px; height: 15px; border-radius: 50%; background-color: #e12635"></div>
                        <strong class="ms-2">Problème d'accès</strong>
                    </div>
                    <button class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                    </button>
                </div>
                <div class="toast-body">
                    <span>Vous ne pouvez pas acceder à cette annonce</span>
                </div>
            </div>
            <?php
            $_SESSION['notification'] = "";
            break;
    }
}