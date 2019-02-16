<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
$numberTotal = $manager->countNewsByCategoryPublic($category);
$information = '<p class="information">Il y a '.$numberTotal.' article(s) de '.$category.'.</p>';
?>
<!-- News list -->
<?php
include('Web/inc/public/listNewsByCategoryPublic.php'); 
?>

<?php 
$content = ob_get_clean();
require __DIR__.'/../../View/public/templatePublicView.php';
?>