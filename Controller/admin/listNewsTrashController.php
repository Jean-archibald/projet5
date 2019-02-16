<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

$numberTotal = $manager->countTrash();
$information = '<p class="information">Il y a '.$numberTotal.' article(s) dans la corbeille.</p>';

?>

<!-- News Trash list -->
<?php
include('Web/inc/admin/newsListTrash.php'); 
?>

<?php
 
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>