<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

$newsInTrash = $manager->countTrash();

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

?>

<!-- News Trash list -->
<?php
include('Web/inc/homepageadmin/newsListTrash.php'); 
?>

<?php
 
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/listView.php';
?>