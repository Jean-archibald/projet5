<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);


ob_start();
$valueTitle = "";
$valueContent = "";

if(isset($_POST['title']))
{
    $valueTitle = $_POST['title'];
}

if(isset($_POST['content']))
{
    $valueContent = $_POST['content'];
}

if (isset($_POST['title']))
{
    $news = new \Entity\News(
    [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'publish' => $_POST['publish'],
        'category' => $_POST['category']
    ]
    );

    if (isset($_POST['id']))
    {
        $news->setId($_POST['id']);
    }

    if (isset($_POST['publish']))
    {
        $news->setPublish($_POST['publish']);
    }

    if (isset($_POST['category']))
    {
        $news->setCategory($_POST['category']);
    }

    if($news->isValid())
    {
        $manager->save($news);

        $message = '<p class="messageValidation">L\'article a bien été ajouté !<p/>';
    }
    else
    {
        $errors = $news->errors();
    }
}
?>

<form action="creer-article" method="post">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
        ?>
        
        <p>
            <?php if (isset($errors) && in_array(\Entity\News::INVALID_TITLE, $errors))
            echo '<p class="messageProbleme">Il manque le titre.<p/>'; ?>
            <label for="title">Titre de l'article</label> : 
            <input type="text" name="title" id="title" value="<?=$valueTitle?>"/>
        </p>
        <br/>
        
        <?php if (isset($errors) && in_array(\Entity\News::INVALID_CONTENT, $errors))
        echo '<p class="messageProbleme">Il manque le contenu.<p/>'; ?>
        <label for="content"></label>     
        <textarea id="mytextarea" name="content" id="content"><?=$valueContent?></textarea>
        <br/>

        <p>
            <?php if (isset($errors) && in_array(\Entity\News::INVALID_CATEGORY, $errors))
            echo '<p class="messageProbleme">Veuillez choisir une catégorie.<p/>'; ?>
            <label for="category">Dans quel catégorie voulez-vous publier ?</label><br />
            <select name="category" id="category">
                <option value="medecine generale">Medecine Générale</option>
                <option value="nutrition">Nutrition</option>
                <option value="allergologie">Allergologie</option>
                <option value="divers">divers</option>
            </select>
        </p>
        <br/>

         <p>Publier l'article ?: 
            <input type="radio" name="publish" id="publish" value="oui"/>
            <label for="oui">oui</label>
            <input type="radio" name="publish" id="publish" value="non" checked/>
            <label for="non">non</label>
        </p>
        
        <input type="submit" value="Enregistrer"/>
        </p>
</form>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/writeNewsView.php';
?>


