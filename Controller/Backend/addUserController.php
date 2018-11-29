<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();
$valueFamilyName = "";
$valueFirstName = "";
$valuePassword = "";
$valuePassword2 = "";
$valueEmail = "";

if(isset($_POST['familyName']))
{
    $valueFamilyName = $_POST['familyName'];
}

if(isset($_POST['firstName']))
{
    $valueFirstName = $_POST['firstName'];
}

if(isset($_POST['password']))
{
    $valuePassword = $_POST['password'];
}

if(isset($_POST['email']))
{
    $valueEmail = $_POST['email'];
}

if (isset($_POST['familyName']))
{
    $user = new \Entity\User(
    [
        'familyName' => $_POST['familyName'],
        'firstName' => $_POST['firstName'],
        'password' => $_POST['password'],
        'email' => $_POST['email']
    ]
    );

    if (isset($_POST['id']))
    {
        $user->setId($_POST['id']);
    }

    if($user->isValid() && ($_POST['password'] == $_POST['password2']))
    {
        $userManager->save($user);

        $message = '<p class="messageValidation">L\'utilisateur a bien été ajouté !<p/>';
    }
    else
    {
        $errors = $user->errors();
    }
}
?>

<form action="ajouter-abonne" method="post">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
        ?>
        
        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FAMILYNAME, $errors))
        echo '<p class="messageProbleme">Il manque le nom de famille.<p/>'; ?>
        <label for="familyName">Nom</label> : 
        <input type="text" name="familyName" id="familyName" value="<?=$valueFamilyName?>"/>
        </p>
        <br/>
        
        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FIRSTNAME, $errors))
        echo '<p class="messageProbleme">Il manque le prénom.<p/>'; ?>
        <label for="firstName">Prenom</label> : 
        <input type="text" name="firstName" id="firstName" value="<?=$valueFirstName?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
        echo '<p class="messageProbleme">Il manque le mot de passe.<p/>'; ?>
        <label for="password">Mot de passe</label> :   
        <input type="text" id="password" name="password" value="<?=$valuePassword?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
        echo '<p class="messageProbleme">Les mots de passe doivent être identique<p/>'; ?>
        <label for="password2">Confirmer Mot de passe</label> :   
        <input type="text" id="password2" name="password2" value="<?=$valuePassword2?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_EMAIL, $errors))
        echo '<p class="messageProbleme">Il manque le mail.<p/>'; ?>
        <label for="email">Email</label> :   
        <input type="email" id="email" name="email" value="<?=$valueEmail?>"/>
        </p>
        <br/>
        
        <input type="submit" value="Inscrire"/>
    </p>
</form>

<?php 
$addUserContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/addUserView.php';
?>