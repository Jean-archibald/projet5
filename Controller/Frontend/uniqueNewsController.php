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
echo '<p>le ', $news->dateCreated()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<p>', nl2br($news->content()), '</p>', "\n";

if ($news->dateCreated() != $news->dateModified())
{
echo '<p><small><em>Modifié le ', $news->dateModified()->format('d/m/Y à H\hi'), '</em></small></p>';
}
?>




<?php $uniqueNewsContent = ob_get_clean();
require __DIR__.'/../../View/Frontend/uniqueNewsView.php';
?>




