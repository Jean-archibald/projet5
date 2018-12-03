<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

?>

<p class="messageInfo">Il y a  <?= $manager->count() ?> article(s) :</p>
<table>
      <tr><th>Titre</th><th>Catégorie</th><th>Publier</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php

foreach ($manager->getListToModify() as $news)
{
    echo '<tr><td>',
    $news->title(), '</td><td>',
    $news->category(), '</td><td>',
    $news->publish(), '</td><td>',
    $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
    ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y à H\hi')),'</td><td>
    <a href="modification-',$news->id(), '">Modifier</a>
    | <a href="corbeille-', $news->id(), '">Corbeille</a>
    </td></tr>', "\n";
}
?>
</table>


<?php 
$modifyNewsContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/modifNewsView.php';
?>