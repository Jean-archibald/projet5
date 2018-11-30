<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();
$valueFamilyname = "";
$valueFirstname = "";
$valuePassword = "";

if (isset($_POST['familyName']))
{
    $valueTitle = htmlspecialchars($_POST['familyName']);
}

if(isset($_POST['firstName']))
{
    $valueTitle = htmlspecialchars($_POST['firstName']);
}

if(isset($_POST['password']))
{
    $valueContent = htmlspecialchars($_POST['password']);
}


if (isset($_POST['familyName']))
{
    $user = $userManager->getUserByFamilyName($_POST['familyName']);;
    
    if (!(empty($_POST['familyName']) || empty($_POST['password']) || empty($_POST['firstName'])))
    {
        if(($user->familyName() == htmlspecialchars($_POST['familyName'])) && ($user->firstName() == htmlspecialchars($_POST['firstName'])) && ($user->password() == htmlspecialchars($_POST['password'])))
        {
            require __DIR__.'/../../View/Frontend/homeView.php';
        }
        else
        {
            $message = 'Vous devez etre membre';
        }
    }

    else if(empty($_POST['familyName']) || empty($_POST['password']) || empty($_POST['firstName']))
    {
        $errors = $user->errors();
    }
}

?>

<form action="" method="post">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
        ?>
        
        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FAMILYNAME, $errors))
        echo '<p class="messageProbleme">Veuillez inscrire votre nom.<p/>'; ?>
        <label for="familyName">Nom de Famille</label> : 
        <input type="text" name="familyName" id="familyName" value="<?=htmlspecialchars($valueFamilyname)?>"/>
        </p>

         <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FIRSTNAME, $errors))
        echo '<p class="messageProbleme">Veuillez inscrire votre nom.<p/>'; ?>
        <label for="firstName">Prénom</label> : 
        <input type="text" name="firstName" id="firstName" value="<?=htmlspecialchars($valueFirstname)?>"/>
        </p>

        
  
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
        echo '<p class="messageProbleme">Veuillez inscrire votre password.<p/>'; ?>
        <label for="password">Mot de passe</label> :   
        <input id="text" name="password" id="password" value="<?=htmlspecialchars($valuePassword)?>"/>
        <br/>

        <input type="submit" value="Se connecter"/>
        </p>
</form>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Frontend/connexionView.php';
?>
