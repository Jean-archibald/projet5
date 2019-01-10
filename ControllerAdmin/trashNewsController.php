<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
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

$newsToTrash = "";

if ($id != 0)
{
    $newsToTrash = $manager->getUnique($id);
    $newsTitle = $newsToTrash->title();
    $newsToTrash->setTrash('oui');
    $newsToTrash->setPublish('non');
    
    if($newsToTrash->isValid())
    {
        $manager->save($newsToTrash);

        $message = '<p class="messageInfo">L\'article '. $newsTitle .' a bien été mis dans la Corbeille!</p>';
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
$totalNews = $manager->count();
?>

<!-- News list -->
<?php
include('Web/inc/homepageadmin/newsList.php'); 
?>

<?php
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/listView.php';
?>