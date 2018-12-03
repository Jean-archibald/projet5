<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
$newsPerPage = 10;
$newsTotals = $manager->countPublish();
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


foreach ($manager->getListPublishByCategory($started, $newsPerPage, $category) as $news)
{
  if (strlen($news->content()) <= 200)
  {
    $content = $news->content();
  }
  
  else
  {
    $start = substr($news->content(), 0, 200);
    $start = substr($start, 0, strrpos($start, ' ')) . '...';
    
    $content = $start;
  }
  
  echo '<h4><a href="article-', $news->id(), '">', $news->title(), '</a></h4>', "\n",
        '<p>', nl2br($content), '</p>';
}

for($i=1;$i<=$totalPages ;$i++)
{
  if($i == $pageNow)
  {
    echo $i.' ';
  }
  else
  {
  echo '<a href="listeArticles-' .$i.'">'.$i.'</a> ';
  }
}

$listNewscontentTemplate = ob_get_clean();

if($category == 'medecine generale')
{
    require __DIR__.'/../../View/Frontend/medecineGeneraleView.php';
}
elseif($category == 'allergologie')
{
    require __DIR__.'/../../View/Frontend/allergologieView.php';
}
elseif($category == 'nutrition')
{
    require __DIR__.'/../../View/Frontend/nutritionView.php';
}
elseif($category == 'divers')
{
    require __DIR__.'/../../View/Frontend/diversView.php';
}





