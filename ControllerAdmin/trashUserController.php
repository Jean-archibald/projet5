<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);


ob_start();



$userToDelete = "";

if ($id != 0)
{
    $userToDelete = $userManager->getUserById($id);
    $userToDelete->setTrash('oui');
    $userToDeleteName = $userToDelete->familyName();
    $userToDeleteFirstName = $userToDelete->firstName();
    
    if($userToDelete->isValid())
    {
        $userManager->save($userToDelete);

        $message = '<p id="message" title="info">L\'utilisateur '. $userToDeleteName .' '.$userToDeleteFirstName .' a bien été mis dans la Corbeille!</p>';
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
$usersNotinTrash = $userManager->count();
?>

<!-- User  list -->
<?php
include('Web/inc/homepageadmin/userList.php'); 
?>


<?php
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/listView.php';
?>