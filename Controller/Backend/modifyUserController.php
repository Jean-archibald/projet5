<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();
$userToModify = "";
$userToModify =  $userManager->getUserById($id);

if (isset($_POST['familyName']))
{

    $userToModify->setFamilyName(htmlspecialchars($_POST['familyName']));
    $userToModify->setFirstName(htmlspecialchars($_POST['firstName']));
    $userToModify->setPassword(htmlspecialchars($_POST['password']));
    $userToModify->setEmail(htmlspecialchars($_POST['email']));   
    $userToModify->setStatus(htmlspecialchars($_POST['status']));  
    $userToModify->setTrash(htmlspecialchars($_POST['trash']));  
     
    if (isset($_POST['id']))
    {
        $user->setId($_POST['id']);
    }

    if($userToModify->isValid() && (htmlspecialchars($_POST['password']) == htmlspecialchars($_POST['password2'])))
    {
        $userManager->save($userToModify);

        $message = '<p class="messageValidation">L\'utilisateur a bien été modifié !<p/>';
    }

    if (htmlspecialchars($_POST['password']) != htmlspecialchars($_POST['password2']))
    {
        $message = '<p class="messageProbleme">Les mots de passe doivent etre identique !<p/>';
    }

    else
    {
        $errors = $userToModify->errors();
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
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FAMILYNAME, $errors))
        echo '<p class="messageProbleme">Il manque le nom de famille.<p/>'; ?>
        <label for="familyName">Nom</label> : 
        <input type="text" name="familyName" id="familyName" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->familyName()); ?>"/>
        </p>
        <br/>
        
        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FIRSTNAME, $errors))
        echo '<p class="messageProbleme">Il manque le prénom.<p/>'; ?>
        <label for="firstName">Prenom</label> : 
        <input type="text" name="firstName" id="firstName" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->firstName());?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
        echo '<p class="messageProbleme">Il manque le mot de passe.<p/>'; ?>
        <label for="password">Mot de passe</label> :   
        <input type="text" id="password" name="password" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->password());?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
        echo '<p class="messageProbleme">Il manque la confirmation du mot de passe.<p/>'; ?>
        <label for="password2">Confirmer Mot de passe</label> :   
        <input type="text" id="password2" name="password2" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->password())?>"/>
        </p>
        <br/>

        <p>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_EMAIL, $errors))
        echo '<p class="messageProbleme">Il manque le mail.<p/>'; ?>
        <label for="email">Email</label> :   
        <input type="email" id="email" name="email" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->email())?>"/>
        </p>
        <br/>

        <p style="font-weight:bold;">statut : 
        <input type="radio" name="status" id="status" value="administrateur"/>
        <label for="administateur" style="font-weight:normal;">administateur</label>
        <input type="radio" name="status" id="status" value="utilisateur" checked/>
        <label for="utilisateur" style="font-weight:normal;">utilisateur</label>
        </p>
        <br/>

        <p style="font-weight:bold;">Placer dans la corbeille ?: 
        <input type="radio" name="trash" id="trash" value="oui"/>
        <label for="oui" style="font-weight:normal;">oui</label>
        <input type="radio" name="trash" id="trash" value="non" checked/>
        <label for="non" style="font-weight:normal;">non</label>
        </p>
        
        <input type="submit" value="Modifier les infos de l'abonné"/>
    </p>
</form>


<?php 
$modifyUserContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/modifyUserView.php';
?>
