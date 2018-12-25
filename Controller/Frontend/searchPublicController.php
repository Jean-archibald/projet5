<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
$valueQ = "";
if(isset($_POST['q']))
{
    $valueQ = $_POST['q'];
}

?>

<form method="POST" class="searchForm">
    <input type="search" name="q" id="q" placeholder="Recherche..." value="<?=$valueQ?>"/>
    <input type="submit" value="Valider"/>
</form>
<br/><br/>
<?php


$newsPerPage = 10;
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

if (isset($_POST['q']) AND !empty($_POST['q']))
{
    $q = htmlspecialchars($_POST['q']);

    $numberTitleSearchResultforQarray = 0;
    $numberContentSearchResultforQarray = 0;

    $q_array = explode(' ',$q);
    $len_q_array = count($q_array);

    for($i=0;$i<$len_q_array;$i++)
    {
        $numberTitleSearchResultforQarray = $numberTitleSearchResultforQarray + $manager->countTitleSearch($q_array[$i]);  
    }

    for($i=0;$i<$len_q_array;$i++)
    {
        $numberContentSearchResultforQarray = $numberContentSearchResultforQarray + $manager->countContentSearch($q_array[$i]);  
    }

    $totalResult = $numberTitleSearchResultforQarray + $numberContentSearchResultforQarray;


    if( $numberTitleSearchResultforQarray > 0 && $numberContentSearchResultforQarray == 0)
    {
        ?>

        <p class="messageInfo">Il y a  <?= $numberTitleSearchResultforQarray ?> titre(s) correspondant à la recherche : <?=$q?>.</p><br/>
        <table>
            <tr><th>Titre</th><th>Catégorie</th><th>Contenu</th><th>Date d'ajout</th><th>Dernière modification</th><th>Lire l'article</th></tr>
        <?php
        for($i=0;$i<$len_q_array;$i++)
        {
            foreach ($manager->searchNewsByTitle($started, $newsPerPage, $q_array[$i]) as $news)
            {
                if(strlen($news->content()) <= 100)
                {
                    $content = $news->content();
                }
                
                else
                {
                    $start = substr($news->content(), 0, 100);
                    $start = substr($start, 0, strrpos($start, ' ')) . '...';
                    
                    $content = $start;
                }

                echo '<tr><td>',
                $news->title(), '</td><td>',
                $news->category(), '</td><td>',
                $content, '</td><td>',
                $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
                ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y à H\hi')),'</td><td>',
                '<a href="article-', $news->id(), '">', $news->title(), '</a>','</td></tr>', "\n";
            }

        }
            ?>
            </table>
        

        <br/>
        <div class="paginationListUsers">

        <?php
        if($totalResult >10)
        {
            for($i=1;$i<=$totalPages ;$i++)
            {
                if($i == $pageNow)
                    {
                        echo $i.' ';
                    }
                else
                    {
                    echo '<a href="rechercher-' .$i.'">'.$i. '</a> ';
                    }
            }
        }
    }
    elseif( $numberTitleSearchResultforQarray == 0 && $numberContentSearchResultforQarray > 0)
    {
        ?>
        <p class="messageInfo">Il y a  <?= $numberContentSearchResultforQarray ?> contenu(s) correspondant à la recherche : <?=$q?>.</p>

        <table>
            <tr><th>Titre</th><th>Catégorie</th><th>Contenu</th><th>Date d'ajout</th><th>Dernière modification</th><th>Lire l'article</th></tr>
        <?php
        for($i=0;$i<$len_q_array;$i++)
        {
            foreach ($manager->searchNewsByContent($started, $newsPerPage, $q_array[$i]) as $news)
            {

                if(strlen($news->content()) <= 100)
                {
                    $content = $news->content();
                }
                
                else
                {
                    $start = substr($news->content(), 0, 100);
                    $start = substr($start, 0, strrpos($start, ' ')) . '...';
                    
                    $content = $start;
                }

                echo '<tr><td>',
                $news->title(), '</td><td>',
                $news->category(), '</td><td>',
                $content, '</td><td>',
                $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
                ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y à H\hi')),'</td><td>',
                '<a href="article-', $news->id(), '">', $news->title(), '</a>','</td></tr>', "\n";
            }

        }
            ?>
            </table>
        

        <br/>
        <div class="paginationListUsers">

        <?php
        if($totalResult>10)
        {
            for($i=1;$i<=$totalPages ;$i++)
            {
                if($i == $pageNow)
                    {
                        echo $i.' ';
                    }
                else
                    {
                    echo '<a href="rechercher-' .$i.'">'.$i. '</a> ';
                    }
            }
        }
    }
    elseif( $numberTitleSearchResultforQarray > 0 && $numberContentSearchResultforQarray > 0)
    {
        ?>

        <p class="messageInfo">Il y a  <?= $numberTitleSearchResultforQarray ?> titre(s) correspondant à la recherche : <?=$q?>.</p><br/>
        <p class="messageInfo">Il y a  <?= $numberContentSearchResultforQarray ?> contenu(s) correspondant à la recherche : <?=$q?>.</p>

        <table>
            <tr><th>Titre</th><th>Catégorie</th><th>Contenu</th><th>Date d'ajout</th><th>Dernière modification</th><th>Lire l'article</th></tr>
        <?php
        for($i=0;$i<$len_q_array;$i++)
        {
            foreach ($manager->searchNewsByConcat($started, $newsPerPage, $q_array[$i]) as $news)
            {
                if(strlen($news->content()) <= 100)
                {
                    $content = $news->content();
                }
                
                else
                {
                    $start = substr($news->content(), 0, 100);
                    $start = substr($start, 0, strrpos($start, ' ')) . '...';
                    
                    $content = $start;
                }

                echo '<tr><td>',
                $news->title(), '</td><td>',
                $news->category(), '</td><td>',
                $content, '</td><td>',
                $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
                ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y à H\hi')),'</td><td>',
                '<a href="article-', $news->id(), '">', $news->title(), '</a>','</td></tr>', "\n";
            }

        }
            ?>
            </table>
        

        <br/>
        <div class="paginationListUsers">
        
        <?php
        if($totalResult > 10)
        {
            for($i=1;$i<=$totalPages ;$i++)
            {
                if($i == $pageNow)
                    {
                        echo $i.' ';
                    }
                else
                    {
                    echo '<a href="rechercher-' .$i.'">'.$i. '</a> ';
                    }
            }
        }
    }
    else
    {
        ?>
        <p class="messageInfo">Il n'y a aucune réponse correspondant à la recherche : <?= $q ?>.</p>
        <?php 
    }
}
?>

</div>



<?php 

$searchPublicContent = ob_get_clean();
require __DIR__.'/../../View/Frontend/searchPublicView.php';
?>