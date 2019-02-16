<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();
$numberTotal = $userManager->countTrash();
$information = '<p class="information">Il y a '.$numberTotal.' abonné(s) dans la corbeille.</p>';
?>

<!-- User  Trash list -->
<?php
include('Web/inc/admin/userListTrash.php'); 
?>

<?php
 
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>

