<!DOCTYPE html>
<html lang="fr">

<!-- Head -->
<?php
include('Web/inc/allpages/head.php'); 
?>

<body id="page-top">

<!-- NavBar -->
<?php
include('Web/inc/allpages/navbar.php'); 
?>

<!-- SideBar -->
<?php
include('Web/inc/admin/sidebarAdmin.php'); 
?>

<!-- Icon Cards -->
<?php
if (
($direction !== 'writeNews') && ($direction !== 'modifyUniqueNews') 
&& ($direction !== 'listUserTrash') && ($direction !== 'untrashUser')
&& ($direction !== 'listNewsTrash') && ($direction !== 'untrashNews')
&& ($direction !== 'deleteNews') && ($direction !== 'deleteUser')
&& ($direction !== 'register') && ($direction !== 'modifyUser')
&& ($direction !== 'listUsers') && ($direction !== 'trashUser')
){
include('Web/inc/admin/iconcardsAdmin.php');
}
?>

<!-- Table Content -->
<?php
include('Web/inc/allpages/content.php'); 
?>
   
<!-- Footer -->
<?php
include('Web/inc/allpages/footer.php'); 
?>

<!-- Logout Modal Admin -->
<?php
include('Web/inc/allpages/logoutModal.php'); 
?>  

<!-- Script home page Admin -->
<?php
include('Web/inc/allpages/scriptAdmin.php'); 
?>

<!-- Script Perso   -->
<?php
include('Web/inc/allpages/scriptPerso.php'); 
?>

  </body>

</html>
