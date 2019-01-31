<?php
require __DIR__.'/Web/Bootstrap.php';
$url = '';
if (isset($_GET['url']))
{
    $url = $_GET['url'];
}


//PARTIE ADMIN
//connexion
if($url == '')
{
    $title = 'Blog Santé - Se connecter';
    $url = 'connexion';
    require __DIR__.'/Controller/ControllerAdmin/connexionAdminController.php';

}

//deconnexion
elseif(preg_match('#sessiondestroy#', $url , $params))
{

    require __DIR__.'/Controller/ControllerAdmin/deconnexionController.php';
}


//home Admin
elseif(preg_match('#accueilAdmin#', $url , $params))
{
    $content = "";
    $category = 'medecinegenerale';
    $title = 'Blog Santé / Tableau de bord';
    $direction = 'homeAdmin';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

//Gestion Article
//rédiger
elseif(preg_match('#rediger#', $url , $params))
{
    $title = 'Rédaction d\'un article';
    $direction = 'writeNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//modifier un article
elseif(preg_match('#modifierArticle-([0-9]+)#', $url , $params))
{
    $title = 'Rédaction d\'un article';
    $id = $params[1];
    $direction = 'modifyUniqueNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//Liste des article
elseif(preg_match('#liste-articles-([0-9]+)#', $url , $params))
{
    $title = 'Liste des articles';
    $direction = 'listNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//Placer un article dans la corbeille
elseif(preg_match('#articleCorbeille-([0-9]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $direction = 'trashNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

//Placer un article dans la corbeille 2
elseif(preg_match('#Admin-corbeille-([0-9]+)-([a-z]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $category = $params[2];
    $direction = 'AdminTrashNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

//Sortir un article dans la corbeille
elseif(preg_match('#recupererArticle-([0-9]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $direction = 'untrashNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//Publier un article 
elseif(preg_match('#publier-article-([0-9]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $direction = 'publishNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//Publier un article 2
elseif(preg_match('#Admin-publier-([0-9]+)-([a-z]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $category = $params[2];
    $direction = 'AdminPublishNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//Passer un article en brouillon
elseif(preg_match('#brouillon-article-([0-9]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $direction = 'unpublishNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

//Passer un article en brouillon 2
elseif(preg_match('#Admin-brouillon-([0-9]+)-([a-z]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $category = $params[2];
    $direction = 'AdminUnPublishNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//Supprimer un article
elseif(preg_match('#supprimerArticle-([0-9]+)#', $url , $params))
{
    $title = 'Supprimer un article';
    $id = $params[1];
    $direction = 'deleteNews';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

//list News Public by Category
elseif(preg_match('#AdminMedecinegenerale#', $url , $params))
{
    $title = 'Medecine Generale';
    $direction = 'listNewsByCategoryAdmin';
    $category = 'medecinegenerale';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

elseif(preg_match('#AdminNutrition#', $url , $params))
{
    $title = 'Nutrition';
    $direction = 'listNewsByCategoryAdmin';
    $category = 'nutrition';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

elseif(preg_match('#AdminAllergologie#', $url , $params))
{
    $title = 'Allergologie';
    $direction = 'listNewsByCategoryAdmin';
    $category = 'allergologie';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

elseif(preg_match('#AdminDivers#', $url , $params))
{
    $title = 'Divers';
    $direction = 'listNewsByCategoryAdmin';
    $category = 'divers';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

//Gestion abonné
//ajouter
elseif(preg_match('#register#', $url , $params))
{
    $title = 'Inscrire un abonné';
    $direction = 'register';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//modifier abonné
elseif(preg_match('#utilisateurModifier-([0-9]+)#', $url , $params))
{
    $title = 'Modifier les infos d\'un abonné';
    $id = $params[1];
    $direction = 'modifyUser';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//liste abonnés
elseif(preg_match('#liste-abonne#', $url , $params))
{
    $title = 'Liste des abonnés';
    $direction = 'listUsers';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//Placer un abonné dans la corbeille
elseif(preg_match('#utilisateurCorbeille-([0-9]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $direction = 'trashUser';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

//Sortir un abonné de la corbeille
elseif(preg_match('#recupererUtilisateur-([0-9]+)#', $url , $params))
{
    $title = 'Blog Santé / Tableau de bord';
    $id = $params[1];
    $direction = 'untrashUser';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}
//Supprimer un abonné
elseif(preg_match('#supprimerUtilisateur-([0-9]+)#', $url , $params))
{
    $title = 'Supprimer un abonné';
    $id = $params[1];
    $direction = 'deleteUser';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}


//Corbeille
//corbeille utilisateur
elseif(preg_match('#listeUtilisateursCorbeille#', $url , $params))
{
    $title = 'Corbeille des utilisateurs';
    $direction = 'listUserTrash';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}

//corbeille articles
elseif(preg_match('#listeArticlesCorbeille#', $url , $params))
{
    $title = 'Corbeille des articles';
    $direction = 'listNewsTrash';
    require __DIR__.'/Controller/ControllerAdmin/validAdminConnectionTestController.php';
}



//PARTIE PUBLIC 

//home Public
elseif(preg_match('#blogAccueil#', $url , $params))
{
    $content = "";
    $title = 'Blog Santé / Dr Marie-Pierre Delafontaine';
    $direction = 'homePublic';
    require __DIR__.'/Controller/ControllerPublic/validPublicConnectionTestController.php';
}

//list News Public by Category
elseif(preg_match('#medecinegenerale#', $url , $params))
{
    $title = 'Medecine Generale';
    $direction = 'listNewsPublic';
    $category = 'medecinegenerale';
    require __DIR__.'/Controller/ControllerPublic/validPublicConnectionTestController.php';
}

elseif(preg_match('#nutrition#', $url , $params))
{
    $title = 'Nutrition';
    $direction = 'listNewsPublic';
    $category = 'nutrition';
    require __DIR__.'/Controller/ControllerPublic/validPublicConnectionTestController.php';
}

elseif(preg_match('#allergologie#', $url , $params))
{
    $title = 'Allergologie';
    $direction = 'listNewsPublic';
    $category = 'allergologie';
    require __DIR__.'/Controller/ControllerPublic/validPublicConnectionTestController.php';
}

elseif(preg_match('#divers#', $url , $params))
{
    $title = 'Divers';
    $direction = 'listNewsPublic';
    $category = 'divers';
    require __DIR__.'/Controller/ControllerPublic/validPublicConnectionTestController.php';
}


//Unique News
elseif(preg_match('#lire-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    $direction = 'uniqueNews';
    require __DIR__.'/Controller/ControllerPublic/validPublicConnectionTestController.php';
}










