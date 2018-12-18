<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
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

?>

<p class="messageInfo">Il y a  <?= $manager->count() ?> article(s) :</p>
<?php
if($manager->count() > 0)
{
?>
<table>
      <tr><th>Titre</th><th>Catégorie</th><th>Publier</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php

foreach ($manager->getList($started, $newsPerPage) as $news)
{
    echo '<tr><td>',
    $news->title(), '</td><td>',
    $news->category(), '</td><td>',
    $news->publish(), '</td><td>',
    $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
    ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y à H\hi')),'</td><td>
    <a href="modification-',$news->id(), '">Modifier</a>
    | <a href="article-corbeille-', $news->id(), '">Corbeille</a>
    </td></tr>', "\n";
}
?>
</table>

<br/>
<div class="paginationListUsers">

<?php
}
    for($i=1;$i<=$totalPages ;$i++)
    {
    if($i == $pageNow)
    {
        echo $i.' ';
    }
    else
    {
    echo '<a href="liste-articles-' .$i.'">'.$i. '</a> ';
    }
    }
?>

</div>

<?php 
$modifyNewsContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/modifNewsView.php';
?>