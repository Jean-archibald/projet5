<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);
$UpFileManager = new \Model\UpFileManagerPDO($dao);

ob_start();


$title_data = "";
$textarea_data = "";


if(isset($_POST['title']))
{
    $title_data = $_POST['title'];
}

if(isset($_POST['textarea']))
{
    $textarea_data = $_POST['textarea'];
}

if (isset($_POST['title']))
{

    $news = new \Entity\News(
        [
            'title' => $_POST['title'],
            'content' => $_POST['textarea'],
            'category' => $_POST['category'],
        ]
        );
   
    if($news->isValid())
    {
        $manager->save($news);
        $message = '<p id="message" title="valide">L\'article a bien été ajouté.<p/>';
    }
    else
    {   
        $errors = $news->errors();
    }
}

?>



<!-- Script Perso   -->
<form action="<?=$url?>" method="post" enctype="multipart/form-data">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            
        ?>
        
        <p>
            <label for="title" class="writeCss">Titre de l'article :</label>  
            <input type="text" name="title" id="title" value="<?=$title_data?>"  placeholder="Titre de l'article" required="required"/>
        </p>
        
        <br/>
        <?php
        require __DIR__.'/../../tinymce_image/index.php';
        ?>
        <br/>

        <p>
            <label for="category" class="writeCss">Dans quel catégorie voulez-vous publier ?</label><br />
            <select name="category" id="category" required="required">
                <option value="medecinegenerale">Medecine Générale</option>
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
