<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

$usersInTrash = $userManager->countTrash();
$newsInTrash = $manager->countTrash();
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

<p class="infoListe">Il y a  <?= $newsInTrash ?> article(s) dans la corbeille </p>\<br/>
<?php
if ( $newsInTrash != 0)
{
?>

      <tr><th>Titre</th><th>Catégorie</th><th>Publier</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php

foreach ($manager->getList($started, $newsPerPage) as $news)
{
    echo '<tr><td>',
    $news->title(), '</td><td>',
    $news->category(), '</td><td>',
    $news->publish(), '</td><td>',
    $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
    ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y à H\hi')),'</td><td>
    <a href="modification-',$news->id(), '">Modifier</a>
    | <a href="article-supprimer-', $news->id(), '">Corbeille</a>
    </td></tr>', "\n";
}

?>

</table>
<?php
} 

$trashContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/trashView.php';
?>