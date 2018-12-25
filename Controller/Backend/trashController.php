<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

$usersInTrash = $userManager->countTrash();
$newsInTrash = $manager->countTrash();

$newsPerPage = 20;
$newsTotals = $manager->count() ;
$totalPages = ceil($newsTotals/$newsPerPage);

if(isset($id) AND !empty($id) AND $id > 0 AND $id <= $totalPages)
{
  $id = intval($id);
  $pageNow = $id;    
}
else
{
  $pageNow = 1;
}

$started = ($pageNow-1)*$newsPerPage;


?>


<p class="infoListe">Il y a  <?= $usersInTrash ?> utilisateur(s) dans la corbeille </p>\<br/>

<table>

<?php
if ( $usersInTrash != 0)
{
?>

<tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Password</th><th>statut</th><th>Inscription</th><th>Action</th></tr>
<?php

foreach ($userManager->getTrashList() as $user)
{
    echo '<tr><td>',
    $user->familyName(), '</td><td>',
    $user->firstName(), '</td><td>',
    $user->email(), '</td><td>',
    $user->password(), '</td><td>',
    $user->status(), '</td><td>',
    $user->dateCreated()->format('d/m/Y à H\hi'),'</td><td>
    <a href="abonne-',$user->id(), '">Modifier</a>
    | <a href="utilisateur-supprimer-', $user->id(), '">Supprimer</a>
    </td></tr>', "\n";
}

}
?>
</table>

<p class="infoListe">Il y a  <?= $newsInTrash ?> article(s) dans la corbeille </p>\<br/>

<table>
<?php
if ( $newsInTrash != 0)
{
?>

      <tr><th>Titre</th><th>Catégorie</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php

foreach ($manager->getListInTrash($started, $newsPerPage) as $news)
{
    echo '<tr><td>',
    $news->title(), '</td><td>',
    $news->category(), '</td><td>',
    $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
    ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y à H\hi')),'</td><td>
    <a href="récuperer-',$news->id(), '">Récuperer</a>
    | <a href="delete-', $news->id(), '">Supprimer</a>
    </td></tr>', "\n";
}

?>

</table>
<?php
} 

$trashContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/trashView.php';
?>