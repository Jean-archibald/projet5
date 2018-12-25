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

if (isset($message))
{
    echo $message, '<br />';
}


$trashContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/trashUserView.php';
?>