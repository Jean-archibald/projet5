<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);


ob_start();
$newsToDelete = "";
$newsToDelete =  $manager->getUnique($id);
$newsToDeleteId = $newsToDelete->id();
$newsToDeleteTitle =  $newsToDelete->title();


$title = 'Êtes vous sûr de vouloir supprimer l\'article ' . $newsToDeleteTitle;

if (isset($_POST['delete']) && $_POST['delete'] == 'oui')
{
    $manager->delete($newsToDeleteId);
    $message = '<p class="messageAvertissement">L\'article a bien été supprimés!<p/>';
}
elseif(isset($_POST['delete']) && $_POST['delete'] == 'non')
{
    $message = '<p class="messageAvertissement">L\'article est toujours dans la corbeille!<p/>';
}

?>
<form action="<?=$url?>.php" method="post" class="deleteUser">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            
            if (!isset($message))
            {
        ?>
        <p class="infoListe">Veuillez confirmer la suppression de  <?= $newsToDeleteTitle ?> ? : 
        <input type="radio" name="delete" id="delete" value="oui"/>
        <label for="oui">oui</label>
        <input type="radio" name="delete" id="delete" value="non" checked/>
        <label for="non">non</label>
        </p>
        
        <input type="submit" value="Supprimer" name="Supprimer" />
        <?php
            }
        ?>
    </p>
</form>




<?php 
$deleteNewsContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/deleteNewsView.php';
?>