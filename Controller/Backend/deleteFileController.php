<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$UpFileManager = new \Model\UpFileManagerPDO($dao);

ob_start();
$delete = "";
$fileToDelete = "";
$fileToDelete =  $UpFileManager->getFileById($id);
$fileToDeleteId = $fileToDelete->id();
$fileToDeleteName =  $fileToDelete->up_filename();
$fileToDeleteUrl =  $fileToDelete->up_file_url();
$title = 'Supprimer fichier : ' .$fileToDeleteName;

if (isset($_POST['delete']) &&  ($_POST['delete']) == 'oui')
{
    $UpFileManager->delete($fileToDeleteId);
    unlink($fileToDeleteUrl);
    $message = '<p class="messageSuppression">Le fichier a bien été supprimé !<p/>';
}
elseif(isset($_POST['delete']) && ($_POST['delete']) == 'non')
{
    $message = '<p class="messageValidation">Le fichier est toujours existant !<p/>'; 
}

if (isset($fileToDelete) &&  ($fileToDelete->id() != ""))
{
?>
<div>
<embed src="<?=$fileToDeleteUrl?>" width=400 height=600 alt="fichier a effacer" />
</div>
<?php
}
?>
<form action="<?=$url?>" method="post" class="deleteForm">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            
            if (!isset($message))
            {
        ?>
        <p class="infoListe">Veuillez confirmer la suppression du fichier :  <?= $fileToDeleteName ?> ? 
        <br/> 
        <input type="radio" name="delete" id="delete" value="oui"/>
        <label for="oui">oui</label>
        <input type="radio" name="delete" id="delete" value="non" checked/>
        <label for="non">non</label>
        </p>
        
        <input type="submit" value="Supprimer le fichier" name="Supprimer le fichier" />
        <?php
            }
        ?>
    </p>
</form>




<?php 
$deleteContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/deleteView.php';
?>