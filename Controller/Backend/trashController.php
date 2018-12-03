<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();

$userToDelete = "";

if ($id != 0)
{
    $userToDelete = $userManager->getUserById($id);
    $userToDelete->setTrash('oui');
    $userToDelete->setStatus('utilisateur');
    
    if($userToDelete->isValid())
    {
        $userManager->save($userToDelete);

        $message = '<p class="messageValidation">L\'utilisateur a bien été mis dans la Corbeille!</p>';
    }
    else
    {
        $errors = $userToDelete->errors();
    }
}

$usersInTrash = $userManager->countTrash();
?>

<?php
    if (isset($message))
    {
        echo $message, '<br />';
    }
?>
        
<p class="infoListe">Il y a  <?= $usersInTrash ?> utilisateur(s) dans la corbeille </p>\<br/>

<table>

<?php
    if ( $usersInTrash != 0)
    {
?>

      <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Password</th><th>statut</th><th>corbeille</th><th>Inscription</th><th>Action</th></tr>
<?php

foreach ($userManager->getTrashList() as $user)
{
    echo '<tr><td>',
    $user->familyName(), '</td><td>',
    $user->firstName(), '</td><td>',
    $user->email(), '</td><td>',
    $user->password(), '</td><td>',
    $user->status(), '</td><td>',
    $user->trash(), '</td><td>',
    $user->dateCreated()->format('d/m/Y à H\hi'),'</td><td>
    <a href="abonne-',$user->id(), '">Modifier</a>
    | <a href="utilisateur-supprimer-', $user->id(), '">Supprimer</a>
    </td></tr>', "\n";
}
?>
</table>
<?php } ?>

<?php
$trashContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/trashView.php';
?>