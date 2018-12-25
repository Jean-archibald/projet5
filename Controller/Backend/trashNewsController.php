<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

$newsToDelete = "";

if ($id != 0)
{
    $newsToDelete = $manager->getUnique($id);
    $newsToDelete->setTrash('oui');
    
    if($newsToDelete->isValid())
    {
        $manager->save($newsToDelete);

        $message = '<p class="messageValidation">L\'article a bien été mis dans la Corbeille!</p>';
    }
    else
    {
        $errors = $newsToDelete->errors();
    }
}

if (isset($message))
{
    echo $message, '<br />';
}

$trashContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/trashUserView.php';
?>