<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$UpFileManager = new \Model\UpFileManagerPDO($dao);

ob_start();
$filesPerPage = 20;
$filesTotals = $UpFileManager->count() ;
$totalPages = ceil($filesTotals/$filesPerPage);

if(isset($id) AND !empty($id) AND $id > 0 AND $id <= $totalPages)
{
  $id = intval($id);
  $pageNow = $id;    
}
else
{
  $pageNow = 1;
}

$started = ($pageNow-1)*$filesPerPage;

?>

<p class="messageInfo">Il y a  <?= $UpFileManager->count() ?> fichier(s) : </p>
<?php
if($UpFileManager->count() > 0)
{
?>

<table>
      <tr><th>Nom</th><th>Url</th><th>Date de creation</th>><th>Action</th></tr>
<?php

foreach ($UpFileManager->getList($started, $filesPerPage) as $UpFile)
{
    echo '<tr><td>',
    $UpFile->up_filename(), '</td><td>',
    $UpFile->up_file_url(), '</td><td>',
    $UpFile->dateCreated()->format('d/m/Y à H\hi'),'</td><td>','
    <a href="'.$UpFile->up_file_url().'"/>Aperçu</a> | <a href="effacer-fichier-'.$UpFile->id().'"/>Effacer </a>
    </td></tr>', "\n";
}
?>
</table>

<br/>
<div class="paginationListUsers">

<?php
}
    if($UpFileManager->count() > 20)
    {
        for($i=1;$i<=$totalPages ;$i++)
        {
            if($i == $pageNow)
                {
                    echo $i.' ';
                }
            else
                {
                echo '<a href="liste-fichiers-' .$i.'">'.$i. '</a> ';
                }
        }
    }
?>

</div>

<?php 
$listFilesContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/listFilesView.php';
?>