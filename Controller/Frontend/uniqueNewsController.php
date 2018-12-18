<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
?>

<?php

$news = $manager->getUnique((int) $id);
$title = $news->title();


?>

<?php
echo '<p>le ', $news->dateCreated()->format('d/m/Y à H\hi'), 
    '<h2>',$news->title(),'</h2>','</p>',
    '<p>','<img src="'.$news->iconeUrl().'"/>','</p>',
    '<p>', nl2br($news->content()), '</p>', "\n",
    '<p>','<embed src="'.$news->upfileUrl().'" width=800 height=1100 type="application/pdf"/>','</p>';

if ($news->dateCreated() != $news->dateModified())
{
echo '<p><small><em>Modifié le ', $news->dateModified()->format('d/m/Y à H\hi'), '</em></small></p>';
}
?>




<?php $uniqueNewsContent = ob_get_clean();
require __DIR__.'/../../View/Frontend/uniqueNewsView.php';
?>




