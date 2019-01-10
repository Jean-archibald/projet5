<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$usersInTrash = $userManager->countTrash();
ob_start();

?>

<!-- User  Trash list -->
<?php
include('Web/inc/homepageadmin/userListTrash.php'); 
?>

<?php
 
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/listView.php';
?>

