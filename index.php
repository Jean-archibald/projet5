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
    require __DIR__.'/Controller/Frontend/connexion.php';
}

elseif(preg_match('#accueil#', $url , $params))
{
    $title = 'Accueil';
    require __DIR__.'/View/Frontend/homeView.php';
}

elseif(preg_match('#medecinegenerale#', $url , $params))
{
    $title = 'Medecine Generale';
    require __DIR__.'/View/Frontend/medecineGeneraleView.php';
}

elseif(preg_match('#nutrition#', $url , $params))
{
    $title = 'Nutrition';
    require __DIR__.'/View/Frontend/nutritionView.php';
}

elseif(preg_match('#allergologie#', $url , $params))
{
    $title = 'Allergologie';
    require __DIR__.'/View/Frontend/allergologieView.php';
}

elseif(preg_match('#divers#', $url , $params))
{
    $title = 'Divers';
    require __DIR__.'/View/Frontend/diversView.php';
}



//PARTIE BACKEND 

elseif(preg_match('#admin#', $url , $params))
{
    $title = 'Administration';
    require __DIR__.'/View/Backend/adminHomeView.php';
}

elseif(preg_match('#creer#', $url , $params))
{
    $title = 'Creation';
    require __DIR__.'/View/Backend/adminHomeView.php';
}

elseif(preg_match('#modifier#', $url , $params))
{
    $title = 'Modification';
    require __DIR__.'/View/Backend/adminHomeView.php';
}

elseif(preg_match('#ajouter#', $url , $params))
{
    $title = 'Ajouter un abonné';
    require __DIR__.'/Controller/Backend/addUserController.php';
}

elseif(preg_match('#liste-abonne-([0-9]+)#', $url , $params))
{
    $title = 'Liste des abonnés';
    $id = $params[1];
    require __DIR__.'/Controller/Backend/listUsersController.php';
}

elseif(preg_match('#abonne-([0-9]+)#', $url , $params))
{
    $title = 'Modifié abonné';
    $id = $params[1];
    require __DIR__.'/Controller/Backend/modifyUserController.php';
}

elseif(preg_match('#corbeille#', $url , $params))
{
    $title = 'Corbeille';
    require __DIR__.'/View/Backend/adminHomeView.php';
}

elseif(preg_match('#customizer#', $url , $params))
{
    $title = 'Customization du site';
    require __DIR__.'/View/Backend/adminHomeView.php';
}