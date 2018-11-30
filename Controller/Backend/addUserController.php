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
    $valueFamilyName = htmlspecialchars($_POST['familyName']);
}

if(isset($_POST['firstName']))
{
    $valueFirstName = htmlspecialchars($_POST['firstName']);
}

if(isset($_POST['password']))
{
    $valuePassword = htmlspecialchars($_POST['password']);
}

if(isset($_POST['password2']))
{
    $valuePassword2 = htmlspecialchars($_POST['password2']);
}

if(isset($_POST['email']))
{
    $valueEmail = htmlspecialchars($_POST['email']);
}

if (isset($_POST['familyName']))
{
    $user = new \Entity\User(
    [
        'familyName' => htmlspecialchars($_POST['familyName']),
        'firstName' => htmlspecialchars($_POST['firstName']),
        'password' => htmlspecialchars($_POST['password']),
        'email' => htmlspecialchars($_POST['email'])
    ]
    );

    if (isset($_POST['id']))
    {
        $user->setId($_POST['id']);
    }

    if($user->isValid() && (htmlspecialchars($_POST['password']) == htmlspecialchars($_POST['password2'])))
    {
        $userManager->save($user);

        $message = '<p class="messageValidation">L\'utilisateur a bien été ajouté !<p/>';
    }

    if (htmlspecialchars($_POST['password']) != htmlspecialchars($_POST['password2']))
    {
        $message = '<p class="messageProbleme">Les mots de passe doivent etre identique !<p/>';
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
        <input type="text" name="familyName" id="familyName" value="<?=htmlspecialchars($valueFamilyName)?>"/>
        </p>
        <br/>
        
        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FIRSTNAME, $errors))
        echo '<p class="messageProbleme">Il manque le prénom.<p/>'; ?>
        <label for="firstName">Prenom</label> : 
        <input type="text" name="firstName" id="firstName" value="<?=htmlspecialchars($valueFirstName)?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
        echo '<p class="messageProbleme">Il manque le mot de passe.<p/>'; ?>
        <label for="password">Mot de passe</label> :   
        <input type="text" id="password" name="password" value="<?=htmlspecialchars($valuePassword)?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
        echo '<p class="messageProbleme">Les mots de passe doivent être identique<p/>'; ?>
        <label for="password2">Confirmer Mot de passe</label> :   
        <input type="text" id="password2" name="password2" value="<?=htmlspecialchars($valuePassword2)?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_EMAIL, $errors))
        echo '<p class="messageProbleme">Il manque le mail.<p/>'; ?>
        <label for="email">Email</label> :   
        <input type="email" id="email" name="email" value="<?=htmlspecialchars($valueEmail)?>"/>
        </p>
        <br/>
        
        <input type="submit" value="Inscrire"/>
    </p>
</form>

<?php 
$addUserContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/addUserView.php';
?>