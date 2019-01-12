<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
$newsToPublish = "";

if ($id != 0)
{
    $newsToTrash = $manager->getUnique($id);
    $newsTitle = $newsToTrash->title();
    $newsToTrash->setTrash('oui');
    $newsToTrash->setPublish('non');
    
    if($newsToTrash->isValid())
    {
        $manager->save($newsToTrash);

        $message = '<p id="message" title="info">L\'article '. $newsTitle .' a bien été mis dans la Corbeille!</p>';
    }
    else
    {
        $errors = $newsToTrash->errors();
    }
}


if (isset($message))
{
    echo $message, '<br />';
}
?>
<!-- News list -->
<?php
include('Web/inc/homepageadmin/listNewsByCategoryAdmin.php'); 
?>

<?php 
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/homeAdminView.php';
?>