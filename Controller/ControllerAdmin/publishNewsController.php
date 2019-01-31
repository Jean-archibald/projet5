<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

$totalNews = $manager->count();
$newsToPublish = "";

if ($id != 0)
{
    $newsToPublish = $manager->getUnique($id);
    $newsTitle = $newsToPublish->title();
    $newsToPublish->setPublish('oui');
    
    if($newsToPublish->isValid())
    {
        $manager->save($newsToPublish);

        $message = '<p id="message" title="info">L\'article '. $newsTitle .'a bien été publié.</p>';
    }
    else
    {
        $errors = $newsToPublish->errors();
    }
}

if (isset($message))
{
    echo $message, '<br />';
}
?>
<!-- News list -->
<?php
include('Web/inc/homepageadmin/newsList.php'); 
?>

<?php
$content = ob_get_clean();
require __DIR__.'/../../View/ViewAdmin/listView.php';
?>