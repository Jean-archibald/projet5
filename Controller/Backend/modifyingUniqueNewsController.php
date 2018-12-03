<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
$newsToModify = "";
$newsToModify =  $manager->getUnique($id);
$title = 'Modification de ' . $newsToModify->title() ;


if (isset($_POST['title']))
{
    $newsToModify->setTitle($_POST['title']);
    $newsToModify->setContent($_POST['content']);
    $newsToModify->setCategory($_POST['category']);
    $newsToModify->setPublish($_POST['publish']);
    $newsToModify->setTrash($_POST['trash']);

    if($newsToModify->isValid())
    {
        $manager->save($newsToModify);

        $message = '<p class="messageValidation">L\'article a bien été modifié !<p/>';
    }
    else
    {
        $errors = $newsToModify->errors();
    }
}


?>
<form action="<?=$url?>" method="post">
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
            <input type="text" name="title" id="title" value="<?php if (isset($newsToModify)) echo $newsToModify->title(); ?>"/>
        </p>
        <br/>
        
        <?php if (isset($errors) && in_array(\Entity\News::INVALID_CONTENT, $errors))
        echo '<p class="messageProbleme">Il manque le contenu.<p/>'; ?>
        <label for="content"></label>     
        <textarea id="mytextarea" name="content" id="content"><?php if (isset($newsToModify)) echo $newsToModify->content(); ?></textarea>
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
$modifyingUniqueNewsContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/modifyingUniqueNewsView.php';
?>