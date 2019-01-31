<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$usersNotinTrash = $userManager->count();

ob_start();

?>


<!-- User  list -->
<?php
include('Web/inc/homepageadmin/userList.php'); 
?>

<?php
$content= ob_get_clean();
require __DIR__.'/../../View/ViewAdmin/listView.php';
?>