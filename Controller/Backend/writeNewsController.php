<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);
$UpFileManager = new \Model\UpFileManagerPDO($dao);



ob_start();
$valueTitle = "";
$valueContent = "";
$valueIconeName = "";
$valueFileName = "";

if(isset($_POST['title']))
{
    $valueTitle = $_POST['title'];
}

if(isset($_POST['content']))
{
    $valueContent = $_POST['content'];
}

if(isset($_POST['iconeName']))
{
    $valueIconeName = $_POST['iconeName'];
}

if(isset($_POST['mainFileName']))
{
    $valueFileName = $_POST['mainFileName'];
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

   
    if(isset($_FILES) && isset($_FILES['icone']))
    {       

        $up_filename_icone = $_FILES['icone']['name'];
        $up_file_tmp_name_icone = $_FILES['icone']['tmp_name'];
        $up_file_type_icone = $_FILES['icone']['type'];
        $up_file_size_icone = $_FILES['icone']['size'];
        $up_file_code_error = $_FILES['icone']['error'];
        $iconeNameInFile = $_POST['iconeName'];
        

        switch ($up_file_code_error)
        {
            case UPLOAD_ERR_OK :
                $up_file_extension_icone = strrchr($up_filename_icone, ".");
                $up_file_destination_icone = __DIR__.'/../../Web/upload_icone/'.$iconeNameInFile.$up_file_extension_icone;
                $autorised_extensions = array('.png', '.PNG', '.gif', '.GIF', '.jpeg', '.JPEG', '.jpg', '.JPG');
                if(in_array($up_file_extension_icone, $autorised_extensions))
                {
                    if(move_uploaded_file($up_file_tmp_name_icone, $up_file_destination_icone))
                    {
                        if($UpFileManager->upFileExist($iconeNameInFile . $up_file_extension_icone) == 0)
                        {
                            $UpFileIcone = new \Entity\UpFile(
                                [
                                    'up_filename' => $iconeNameInFile . $up_file_extension_icone,
                                    'up_file_url' => $up_file_destination_icone
                                ]    
                                );

                            if(!empty($_POST['iconeName']))
                            {
                                $messageIconeValidated ='<p class="messageValidation">Fichier '. $iconeNameInFile . $up_file_extension_icone . ' envoyé avec succès</p>';

                                $UpFileManager->add($UpFileIcone);
                            }
                            else
                            {
                                $messageIcone = "Il manque le nom de l'icone";
                            }
                        }
                        else
                        {
                            $messageIcone = "Ce nom d'icone est déjà utilisé !";
                        }
                    }
                }
                else
                {
                    $messageIcone = 'Seuls les fichiers png, jpeg, jpg, ou gif sont autorisés pour un icone.';
                }
                break;

            case UPLOAD_ERR_NO_FILE :
                $messageIcone = "Pas d'icone saisi.";
                break;

            case UPLOAD_ERR_INI_SIZE :
                $messageIcone = "Fichier " .$up_filename_icone. "non transféré.";
                $messageIcone = "trop grand";
                break;

            case UPLOAD_ERR_FORM_SIZE :
                $messageIcone = "Fichier " .$up_filename_icone. "non transféré";
                $messageIcone = "Max File size";
                break;
            
            case UPLOAD_ERR_PARTIAL :
                $messageIcone = "Fichier " .$up_filename_icone. "non transféré";
                $messageIcone = "partiellement transféré";
                break;

            case UPLOAD_ERR_NO_TMP_DIR :
                $messageIcone = "Fichier " .$up_filename_icone. "non transféré";
                $messageIcone = "pas de repertoire temporaire";
                break;

            case UPLOAD_ERR_CANT_WRITE :
                $messageIcone = "Fichier " .$up_filename_icone. "non transféré";
                $messageIcone = "erreur lors de l'ecriture du fichier dans le serveur";
                break;

            case UPLOAD_ERR_EXTENSION :
                $messageIcone = "Fichier " .$up_filename_icone. "non transféré";
                $messageIcone = "transfert stoppé par l'extension";
                break;

            default :
                $messageIcone = "Fichier non transféré";
                $messageIcone = "(erreur inconnue : " .$up_file_code_error. ")";       
        }
    }

    if(isset($_FILES) && isset($_FILES['fileSend']))
    {       

        $up_filename_fileSend = $_FILES['fileSend']['name'];
        $up_file_tmp_name_fileSend = $_FILES['fileSend']['tmp_name'];
        $up_file_type_fileSend = $_FILES['fileSend']['type'];
        $up_file_size_fileSend = $_FILES['fileSend']['size'];
        $up_file_code_error = $_FILES['fileSend']['error'];
        $fileSendNameInFile = $_POST['mainFileName'];

        switch ($up_file_code_error)
        {
            case UPLOAD_ERR_OK :
                $up_file_extension_fileSend = strrchr($up_filename_fileSend, ".");
                $up_file_destination_fileSend = __DIR__.'/../../Web/upload_fileSend/'.$fileSendNameInFile.$up_file_extension_fileSend;
                $autorised_extensions = array('.png', '.PNG', '.gif', '.GIF', '.jpeg', '.JPEG', '.jpg', '.JPG', '.PDF', '.pdf');
                if(in_array($up_file_extension_fileSend, $autorised_extensions))
                {
                    if(move_uploaded_file($up_file_tmp_name_fileSend, $up_file_destination_fileSend))
                    {
                        if($UpFileManager->upFileExist($fileSendNameInFile . $up_file_extension_fileSend) == 0)
                        {
                            $UpFileSend = new \Entity\UpFile(
                                [
                                    'up_filename' => $fileSendNameInFile . $up_file_extension_fileSend,
                                    'up_file_url' => $up_file_destination_fileSend
                                ]    
                                );

                            if(!empty($_POST['mainFileName']))
                            {
                                
                                $messageFileValidated ='<p class="messageValidation">Fichier ' . $fileSendNameInFile . $up_file_extension_fileSend . ' envoyé avec succès</p>';

                                $UpFileManager->add($UpFileSend);
                            }
                            else
                            {
                                $messageFile = "Il manque le nom du fichier principal";
                            }
                        }
                        else
                        {
                            $messageFile = "Ce nom de fichier est déjà utilisé !";
                        }
                    }
                }
                else
                {
                    $messageFile = 'Seuls les fichiers png, jpeg, jpg, ou gif sont autorisés pour un icone.';
                }
                break;

            case UPLOAD_ERR_NO_FILE :
                $messageFile = "Pas de fichier principal saisi.";
                break;

            case UPLOAD_ERR_INI_SIZE :
                $messageFile = "Fichier " .$up_filename_fileSend. "non transféré.";
                $messageFile = "trop grand";
                break;

            case UPLOAD_ERR_FORM_SIZE :
                $messageFile = "Fichier " .$up_filename_fileSend. "non transféré";
                $messageFile = "Max File size";
                break;
            
            case UPLOAD_ERR_PARTIAL :
                $messageFile = "Fichier " .$up_filename_fileSend. "non transféré";
                $messageFile = "partiellement transféré";
                break;

            case UPLOAD_ERR_NO_TMP_DIR :
                $messageFile = "Fichier " .$up_filename_fileSend. "non transféré";
                $messageFile = "pas de repertoire temporaire";
                break;

            case UPLOAD_ERR_CANT_WRITE :
                $messageFile = "Fichier " .$up_filename_fileSend. "non transféré";
                $messageFile = "erreur lors de l'ecriture du fichier dans le serveur";
                break;

            case UPLOAD_ERR_EXTENSION :
                $messageFile = "Fichier " .$up_filename_fileSend. "non transféré";
                $messageFile = "transfert stoppé par l'extension";
                break;

            default :
                $messageFile = "Fichier non transféré";
                $messageFile = "(erreur inconnue : " .$up_file_code_error. ")";       
        }
    }
   
    if($news->isValid() && isset($messageIcone) && $messageIcone == "Pas d'icone saisi." && isset($messageFile) && $messageFile == "Pas de fichier principal saisi." )
    {
        $manager->save($news);
        $message = '<p class="messageValidation">L\'article a bien été ajouté, il ne comporte aucun fichier upload !<p/>';
    }
    elseif($news->isValid() && isset($messageIconeValidated) && isset($messageFile) && $messageFile == "Pas de fichier principal saisi." )
    {
        $manager->save($news);
        $message = '<p class="messageValidation">L\'article a bien été ajouté, il comporte un icone !<p/>';
    }
    elseif($news->isValid() && isset($messageFileValidated) && isset($messageIcone) && $messageIcone == "Pas d'icone saisi." )
    {
        $manager->save($news);
        $message = '<p class="messageValidation">L\'article a bien été ajouté, il comporte un fichier principal !<p/>';
    }
    elseif($news->isValid() && isset($messageFileValidated) && isset($messageIconeValidated))
    {
        $manager->save($news);
        $message = '<p class="messageValidation">L\'article a bien été ajouté, il comporte un icone et un fichier principal !<p/>';
    }
    elseif($news->isValid() && isset($messageIcone) && $messageIcone != "Pas d'icone saisi." && isset($messageFile) && $messageFile == "Pas de fichier principal saisi." )
    {
        $message = '<p class="messageProbleme">' . $messageIcone . '<p/>';
    }
    elseif($news->isValid() && isset($messageIcone) && $messageIcone == "Pas d'icone saisi." && isset($messageFile) && $messageFile != "Pas de fichier principal saisi." )
    {
        $message = '<p class="messageProbleme">' . $messageFile . '<p/>';
    }
    elseif($news->isValid() && isset($messageIcone) && $messageIcone != "Pas d'icone saisi." && isset($messageFile) && $messageFile != "Pas de fichier principal saisi." )
    {
        $message = '<p class="messageProbleme">' . $messageFile . '<p/>' . '<p class="messageProbleme">' . $messageIcone . '<p/>';
    }
    else
    {   
        $errors = $news->errors();
    }
}

?>

<form action="creer-article" method="post"  enctype="multipart/form-data" class="writeForm">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            if (isset($messageIconeValidated))
            {
                echo $messageIconeValidated, '<br />';
            }
            if (isset($messageFileValidated))
            {
                echo $messageFileValidated, '<br />';
            }
            
        ?>
        
        <p>
            <?php if (isset($errors) && in_array(\Entity\News::INVALID_TITLE, $errors))
            echo '<p class="messageProbleme">Il manque le titre de l\'article.<p/>'; ?>
            <label for="title">Titre de l'article</label> : 
            <input type="text" name="title" id="title" value="<?=$valueTitle?>"  placeholder="Titre de l'article"/>
        </p>
        <br/>

         <p>
            <label for="icone">Ajouter un icone à l'article : </label>

            <input type="file" name="icone" />
        </p>
        <br/>

        <p>
            <label for="iconeName">Nom de l'icone</label> : 
            <input type="text" name="iconeName" id="iconeName" placeholder="Nom de l'icone" value="<?=$valueIconeName?>"/>
        </p>
        <br/>

        
        
        <?php if (isset($errors) && in_array(\Entity\News::INVALID_CONTENT, $errors))
        echo '<p class="messageProbleme">Il manque le contenu.<p/>'; ?>
        <label for="content">Ajouter du texte : </label>     
        <textarea id="mytextarea" name="content" id="content"><?=$valueContent?></textarea>
        <br/>

        <p>
            <label for="fileSend">Ajouter un fichier : </label>
            <input type="file" name="fileSend" />
        </p>
        <br/>
        <p>
            <label for="mainFileName">Nom du fichier</label> : 
            <input type="text" name="mainFileName" id="mainFileName" placeholder="Nom du fichier" value="<?=$valueFileName?>"/>
        </p>
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

         <p><label>Publier l'article ?:</label>
            <input type="radio" name="publish" id="publish" value="oui"/>
            <label for="oui">oui</label>
            <input type="radio" name="publish" id="publish" value="non" checked/>
            <label for="non">non</label>
        </p>
        <br/>
        
        <input type="submit" value="Enregistrer" class="buttonWrite"/>
        

        </p>
</form>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/writeNewsView.php';
?>
