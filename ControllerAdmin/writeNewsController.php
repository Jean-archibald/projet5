<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);
$UpFileManager = new \Model\UpFileManagerPDO($dao);

ob_start();
$valueTitle = "";
$valueContent = "";
$valueFileName = "";

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
            'category' => $_POST['category'],
        ]
        );
   
    if($news->isValid())
    {
        $manager->save($news);
        $message = '<p id="validationMessage">L\'article a bien été ajouté.<p/>';
    }
    else
    {   
        $errors = $news->errors();
    }
}

?>

<form action="rediger" method="post"  enctype="multipart/form-data" class="writeForm">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            
        ?>
        
        <p>
            <label for="title">Titre de l'article</label> : 
            <input type="text" name="title" id="title" value="<?=$valueTitle?>"  placeholder="Titre de l'article" required="required"/>
        </p>
        
        <br/>

        <label for="content">Ajouter du texte : </label>     
        <textarea id="mytextarea" class="ckeditor" name="content" id="content" rows="10" cols="80" required="required"><?=$valueContent?></textarea>
        <br/>

        <p>
            <label for="category">Dans quel catégorie voulez-vous publier ?</label><br />
            <select name="category" id="category" required="required">
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
require __DIR__.'/../ViewAdmin/writeNewsView.php';
?>
