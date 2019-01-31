<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);
$UpFileManager = new \Model\UpFileManagerPDO($dao);

ob_start();
$newsToModify = "";
$newsToModify =  $manager->getUnique($id);
$title = 'Modification de ' . $newsToModify->title() ;


if (isset($_POST['title']))
{
    

    $newsToModify->setTitle($_POST['title']);
    $newsToModify->setContent($_POST['textarea']);
    $newsToModify->setCategory($_POST['category']);
    $newsToModify->setTrash('non');


    if($newsToModify->isValid())
    {
        $manager->save($newsToModify);
        $message = '<p id="message" title="info">L\'article a bien été modifié.<p/>';
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
            <label for="title">Titre de l'article</label> : 
            <input type="text" name="title" id="title" value="<?php if (isset($newsToModify)) echo $newsToModify->title() ?>" placeholder="Titre de l'article"/>
        </p>
        <br/>

        <?php
        require __DIR__.'/../../tinymce_image/indexModifyingNews.php';
        ?>

        <br/>

        <p>
            <label for="category">Dans quel catégorie voulez-vous publier ?</label><br />
            <select name="category" id="category">
                <option value="medecine generale">Medecine Générale</option>
                <option value="nutrition">Nutrition</option>
                <option value="allergologie">Allergologie</option>
                <option value="divers">divers</option>
            </select>
        </p>
        <br/>

        <input type="submit" value="Enregistrer" class="buttonWrite"/>
        

        </p>
</form>


<?php 
$content = ob_get_clean();
require __DIR__.'/../../View/ViewAdmin/writeNewsView.php';
?>

