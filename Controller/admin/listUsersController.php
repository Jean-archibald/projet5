<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$usersNotinTrash = $userManager->count();

ob_start();
$numberTotal = $userManager->count();
$information = '<p class="information">Il y a '.$numberTotal.' abonné(s).</p>';
?>


<!-- User  list -->
<?php
include('Web/inc/admin/userList.php'); 
?>

<?php
$content= ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>