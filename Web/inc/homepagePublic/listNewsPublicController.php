<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();

foreach ($manager->getListPublishByCategory($category) as $news)
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


$content = ob_get_clean();

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






