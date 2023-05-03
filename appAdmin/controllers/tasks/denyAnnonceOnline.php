<?php

try{
    Annonce::denyAnnonceOnline(Connection::getConn(), $idAnn, $accountInfos->getIdCompte());
    $_SESSION['notification'] = "denied";
}
catch (Exception $e)
{
    $_SESSION['notification'] = "no-denied";
} finally {
    header('location:/gestion-annonce-en-ligne');
}