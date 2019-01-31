<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
?>
<!-- News list -->
<?php
include('Web/inc/allpages/listNewsByCategory.php'); 
?>

<?php 
$content = ob_get_clean();
require __DIR__.'/../../View/ViewPublic/homePublicView.php';
?>