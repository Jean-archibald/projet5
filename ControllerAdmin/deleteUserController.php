<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();
$delete = "";
$userToDelete = "";
$userToDelete =  $userManager->getUserById($id);
$userToDeleteId = $userToDelete->id();
$userToDeleteFamilyName =  $userToDelete->familyName();
$userToDeleteFirstName =  $userToDelete->firstName();
$title = 'Supprimer abonné : ' .$userToDeleteFamilyName . ' ' . $userToDeleteFirstName;

if (isset($_POST['delete']) &&  ($_POST['delete']) == 'oui')
{
    $userManager->delete($userToDeleteId);
    $message = '<p id="message" title="info">L\'utilisateur a bien été supprimé !<p/>';
}
elseif(isset($_POST['delete']) && ($_POST['delete']) == 'non')
{
    $message = '<p id="message" title="info">L\'utilisateur est toujours inscrit !<p/>'; 
}

?>
<form action="<?=$url?>.php" method="post" class="deleteForm">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            $usersInTrash = $userManager->countTrash();
            if (!isset($message))
            {
        ?>
        <div class="divDelete">
            <p class="infoListe">Veuillez confirmer la suppression de  <?= $userToDeleteFamilyName ?> <?= $userToDeleteFirstName ?> ? :
            <br/> 
            <input type="radio" name="delete" id="delete" value="oui"/>
            <label for="oui">oui</label>
            <input type="radio" name="delete" id="delete" value="non" checked/>
            <label for="non">non</label>
            </p>
            
            <input type="submit" value="Supprimer l'abonné" name="Supprimer l'abonné" />
        </div>
        <?php
            }
        ?>
    </p>
</form>


<!-- User  Trash list -->
<?php
include('Web/inc/homepageadmin/userListTrash.php'); 
?>


<?php 
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/listView.php';
?>