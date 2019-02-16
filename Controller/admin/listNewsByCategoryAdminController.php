<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
$numberTotal = $manager->countNewsByCategoryAdmin($category);
$information = '<p class="information">Il y a '.$numberTotal.' article(s) de '.$category.'.</p>';
?>
<!-- News list -->
<?php
include('Web/inc/admin/listNewsByCategoryAdmin.php'); 
?>

<?php 
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>