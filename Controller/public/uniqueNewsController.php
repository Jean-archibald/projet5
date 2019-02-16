<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);
$news = $manager->getUnique((int) $id);
$title = $news->title();
$category = $news->category();
ob_start();
?>
<body id="uniqueNews" title="<?=$category?>">

<div class="article">
<?php



?>

<?php
echo    '<p>Article publié le ', $news->dateCreated()->format('d/m/Y'), 
        '<h2 class="titleNews">',$news->title(),'</h2>',
        '<p>', nl2br($news->content()), '</p>', "\n";
?>




<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/uniqueNewsView.php';
?>




