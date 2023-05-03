<?php

try{
    Annonce::grantAnnonce(Connection::getConn(), $idAnn, $accountInfos->getIdCompte());
    $_SESSION['notification'] = "granted";
}
catch (Exception $e)
{
    $_SESSION['notification'] = "no-granted";
} finally {
    header('location:/gestion-annonce');
}