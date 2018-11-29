<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();
$valueName = "";
$valuePassword = "";

if(isset($_POST['name']))
{
    $valueTitle = $_POST['name'];
}

if(isset($_POST['password']))
{
    $valueContent = $_POST['password'];
}


if (isset($_POST['name']))
{
    $member = $userManager->getUser($_POST['name']);;
    
    if (!(empty($_POST['name']) || empty($_POST['password'])))
    {
        if(($member->name() == $_POST['name']) && ($member->password() == $_POST['password']))
        {
            require __DIR__.'/../../View/Frontend/homeView.php';
        }
        else
        {
            $message = 'Vous devez etre membre';
        }
    }

    else if(empty($_POST['name']) || empty($_POST['password']))
    {
        $errors = $member->errors();
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
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_NAME, $errors))
        echo '<p class="messageProbleme">Veuillez inscrire votre nom.<p/>'; ?>
        <label for="name">Nom</label> : 
        <input type="text" name="name" id="name" value="<?=$valueName?>"/>
        </p>
  
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
        echo '<p class="messageProbleme">Veuillez inscrire votre password.<p/>'; ?>
        <label for="password">Mot de passe</label> :   
        <input id="text" name="password" id="password" value="<?=$valuePassword?>"/>
        <br/>

        <input type="submit" value="Se connecter"/>
        </p>
</form>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Frontend/connexionView.php';
?>
