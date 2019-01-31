<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);


ob_start();
$newsToDelete = "";
$newsToDelete =  $manager->getUnique($id);
$newsToDeleteId = $newsToDelete->id();
$newsToDeleteTitle =  $newsToDelete->title();



$newsPerPage = 20;
$newsTotals = $manager->count() ;
$totalPages = ceil($newsTotals/$newsPerPage);

if(isset($id) AND !empty($id) AND $id > 0 AND $id <= $totalPages)
{
  $id = intval($id);
  $pageNow = $id;    
}
else
{
  $pageNow = 1;
}

$started = ($pageNow-1)*$newsPerPage;


$title = 'Êtes vous sûr de vouloir supprimer l\'article ' . $newsToDeleteTitle;

if (isset($_POST['delete']) && $_POST['delete'] == 'oui')
{
    $manager->delete($newsToDeleteId);
    $message = '<p id="message" title="info">L\'article a bien été supprimé!<p/>';
}
elseif(isset($_POST['delete']) && $_POST['delete'] == 'non')
{
    $message = '<p id="message" title="info">L\'article est toujours dans la corbeille!<p/>';
}
$newsInTrash = $manager->countTrash();
?>
<form action="<?=$url?>.php" method="post" class="deleteForm">
    <p >
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            
            if (!isset($message))
            {
        ?>
        <div class="divDelete">
            <p id="message" title="info">Veuillez confirmer la suppression de  <?= $newsToDeleteTitle ?> ? : 
                <input type="radio" name="delete" id="delete" value="oui"/>
                <label for="oui">oui</label>
                <input type="radio" name="delete" id="delete" value="non" checked/>
                <label for="non">non</label>
            </p>
            <input type="submit" value="Supprimer l'article" name="Supprimer" "/>
        </div>
        <?php
            }
        ?>
    </p>
</form>

<!-- News Trash list -->
<?php
include('Web/inc/homepageadmin/newsListTrash.php'); 
?>

<?php 
$content = ob_get_clean();
require __DIR__.'/../../View/ViewAdmin/listView.php';
?>