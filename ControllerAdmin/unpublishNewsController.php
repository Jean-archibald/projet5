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
$totalNews = $manager->count();
$newsToPublish = "";

if ($id != 0)
{
    $newsToPublish = $manager->getUnique($id);
    $newsTitle = $newsToPublish->title();
    $newsToPublish->setPublish('non');
    
    if($newsToPublish->isValid())
    {
        $manager->save($newsToPublish);

        $message = '<p class="messageInfo">L\'article '. $newsTitle .'a bien été mis dans les brouillons.</p>';
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
require __DIR__.'/../ViewAdmin/listView.php';
?>