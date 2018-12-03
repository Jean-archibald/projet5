<?php
require __DIR__.'/Web/Bootstrap.php';
$url = '';
if (isset($_GET['url']))
{
    $url = $_GET['url'];
}

//PARTIE FRONTEND PUBLIC

if($url == '')
{
    require __DIR__.'/Controller/Frontend/connexionController.php';

}

elseif(preg_match('#accueil#', $url , $params))
{
    $title = 'Accueil';
    $direction = 'home';
    require __DIR__.'/Controller/Frontend/testConnectPublicController.php';
}

elseif(preg_match('#medecinegenerale#', $url , $params))
{
    $title = 'Medecine Generale';
    $direction = 'listNews';
    $category = 'medecine generale';
    require __DIR__.'/Controller/Frontend/testConnectPublicController.php';
}

elseif(preg_match('#nutrition#', $url , $params))
{
    $title = 'Nutrition';
    $direction = 'listNews';
    $category = 'nutrition';
    require __DIR__.'/Controller/Frontend/testConnectPublicController.php';
}

elseif(preg_match('#allergologie#', $url , $params))
{
    $title = 'Allergologie';
    $direction = 'listNews';
    $category = 'allergologie';
    require __DIR__.'/Controller/Frontend/testConnectPublicController.php';
}

elseif(preg_match('#divers#', $url , $params))
{
    $title = 'Divers';
    $direction = 'listNews';
    $category = 'divers';
    require __DIR__.'/Controller/Frontend/testConnectPublicController.php';
}

elseif(preg_match('#article-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    $direction = 'uniqueNews';
    require __DIR__.'/Controller/Frontend/testConnectPublicController.php';
}

elseif(preg_match('#sessiondestroy#', $url , $params))
{

    require __DIR__.'/Controller/Frontend/deconnexionController.php';
}



//PARTIE BACKEND 

elseif(preg_match('#admin#', $url , $params))
{
    $title = 'Administration';
    $direction = 'adminHome';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#creer#', $url , $params))
{
    $title = 'Creation';
    $direction = 'writeNews';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#modifier#', $url , $params))
{
    $title = 'Modification';
    $direction = 'modifNews';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#modification-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    $direction = 'modifyingUniqueNews';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#ajouter#', $url , $params))
{
    $title = 'Ajouter un abonné';
    $direction = 'addUser';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#liste-abonne-([0-9]+)#', $url , $params))
{
    $title = 'Liste des abonnés';
    $id = $params[1];
    $direction = 'listUsers';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#abonne-([0-9]+)#', $url , $params))
{
    $title = 'Modifié abonné';
    $id = $params[1];
    $direction = 'modifyUser';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#corbeille-([0-9]+)#', $url , $params))
{
    $title = 'Corbeille';
    $id = $params[1];
    $direction = 'trash';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#utilisateur-supprimer-([0-9]+)#', $url , $params))
{
    
    $id = $params[1];
    $direction = 'deleteUser';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}

elseif(preg_match('#customizer#', $url , $params))
{
    $title = 'Customization du site';
    $direction = 'adminHome';
    require __DIR__.'/Controller/Backend/testConnectAdminController.php';
}