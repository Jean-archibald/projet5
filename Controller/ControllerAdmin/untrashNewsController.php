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
$newsInTrash = $manager->countTrash();
?>

<!-- News Trash list -->
<?php
include('Web/inc/homepageadmin/newsListTrash.php'); 
?>

<?php
$content = ob_get_clean();
require __DIR__.'/../../View/ViewAdmin/listView.php';
?>