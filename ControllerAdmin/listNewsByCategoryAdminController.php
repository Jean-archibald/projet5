<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
?>
<!-- News list -->
<?php
include('Web/inc/homepageadmin/listNewsByCategoryAdmin.php'); 
?>

<?php 
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/homeAdminView.php';
?>