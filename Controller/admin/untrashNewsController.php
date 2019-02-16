<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

$newsToDelete = "";

if ($id != 0)
{
    $newsToDelete = $manager->getUnique($id);
    $newsTitle = $newsToDelete->title();
    $newsToDelete->setTrash('non');
    
    if($newsToDelete->isValid())
    {
        $manager->save($newsToDelete);

        $message = '<p id="message" title="info">L\'article '. $newsTitle .' a bien été sorti de la Corbeille!</p>';
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
$numberTotal = $manager->countTrash();
$information = '<p class="information">Il y a '.$numberTotal.' article(s) dans la corbeille.</p>';
?>

<!-- News Trash list -->
<?php
include('Web/inc/admin/newsListTrash.php'); 
?>

<?php
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>