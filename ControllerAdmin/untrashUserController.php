<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();

$userToDelete = "";

if ($id != 0)
{
    $userToDelete = $userManager->getUserById($id);
    $userToDelete->setTrash('non');
    $userToDeleteName = $userToDelete->familyName();
    $userToDeleteFirstName = $userToDelete->firstName();
    $userToDelete->setTrash('non');
    
    
    if($userToDelete->isValid())
    {
        $userManager->save($userToDelete);

        $message = '<p id="message" title="info">L\'utilisateur '. $userToDeleteName .' '.$userToDeleteFirstName .' a bien été sorti de la Corbeille!</p>';
    }
    else
    {
        $errors = $userToDelete->errors();
    }
}

if (isset($message))
{
    echo $message, '<br />';
}
$usersInTrash = $userManager->countTrash();
?>

<!-- User  Trash list -->
<?php
include('Web/inc/homepageadmin/userListTrash.php'); 
?>

<?php
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/listView.php';
?>