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
echo    '<p>Article publié le ', $news->dateCreated()->format('d/m/Y'),' dans ',
        $news->category(),'</p>', 
        '<h2 class="titleNews">',$news->title(),'</h2>',
        '<p>', nl2br($news->content()), '</p>', "\n";
?>




<?php
$content = ob_get_clean();
require __DIR__.'/../ViewPublic/uniqueNewsView.php';
?>




