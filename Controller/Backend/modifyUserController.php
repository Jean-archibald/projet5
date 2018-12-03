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

    if($userToModify->isValid() 
    && (htmlspecialchars($_POST['password']) == htmlspecialchars($_POST['password2']))
     && (!empty(htmlspecialchars($_POST['password'])) && !empty(htmlspecialchars($_POST['password2'])))
      && (htmlspecialchars($_POST['email']) == htmlspecialchars($_POST['email2']))
       && (!empty(htmlspecialchars($_POST['email'])) && !empty(htmlspecialchars($_POST['email2'])))
       && (!empty(htmlspecialchars($_POST['familyName'])) && !empty(htmlspecialchars($_POST['firstName'])))
       && (strlen(htmlspecialchars($_POST['familyName'])) <= 255)
        && (strlen(htmlspecialchars($_POST['firstName'])) <= 255))
    {
        $userManager->save($userToModify);

        $message = '<p class="messageValidation">L\'utilisateur a bien été modifié !<p/>';
    }

    if (htmlspecialchars($_POST['password']) != htmlspecialchars($_POST['password2']))
    {
        $message = '<p class="messageProbleme">Les mots de passe doivent etre identiques !<p/>';
    }

    if (strlen(htmlspecialchars($_POST['familyName'])) > 255)
    {
        $message = '<p class="messageProbleme">Le nom de famille ne doit pas dépasser 255 caractères !<p/>';
    }

    if (strlen(htmlspecialchars($_POST['firstName'])) > 255)
    {
        $message = '<p class="messageProbleme">Le prénom ne doit pas dépasser 255 caractères!<p/>';
    }

    if (htmlspecialchars($_POST['email']) != htmlspecialchars($_POST['email2']))
    {
        $message = '<p class="messageProbleme">Les emails doivent etre identiques !<p/>';
    }
    else
    {
        $errors = $userToModify->errors();
    }
}
?>
<div align="center">
    <form action="<?=$url?>" method="post">
        <p>
            <?php
                if (isset($message))
                {
                    echo $message, '<br />';
                }
            ?>
            <table>
                <tr>
                    <td align="right">
                        <label for="familyName">Nom</label> :
                    </td>
                    <td>
                        <input type="text" name="familyName" id="familyName" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->familyName());?>"/>
                    </td>
                </tr> 
                <?php if (isset($errors) && in_array(\Entity\User::INVALID_FAMILYNAME, $errors))
                        echo '<p class="messageProbleme">Il manque le nom de famille.<p/>'; ?>   

                <tr>
                    <td align="right">
                        <label for="firstName">Prenom</label> : 
                    </td>
                    <td>
                        <input type="text" name="firstName" id="firstName" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->firstName());?>"/>
                    </td>
                </tr>
                <?php if (isset($errors) && in_array(\Entity\User::INVALID_FIRSTNAME, $errors))
                        echo '<p class="messageProbleme">Il manque le prénom.<p/>'; ?>

                <tr>
                    <td align="right">
                        <label for="password">Mot de passe</label> :  
                    </td>
                    <td>
                        <input type="text" id="password" name="password" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->password());?>"/>
                    </td>
                </tr>
                <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
                        echo '<p class="messageProbleme">Il manque le mot de passe.<p/>'; ?>   

                <tr>            
                    <td align="right">
                        <label for="password2">Confirmer Mot de passe</label> : 
                    </td>
                    <td>
                        <input type="text" id="password2" name="password2" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->password())?>"/>
                    </td>
                </tr>

                <tr>            
                    <td align="right">
                        <label for="email">Email</label> :   
                    </td>
                    <td>
                        <input type="email" id="email" name="email" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->email())?>"/>
                    </td>
                </tr>
                <?php if (isset($errors) && in_array(\Entity\User::INVALID_EMAIL, $errors))
                        echo '<p class="messageProbleme">Il manque le mail.<p/>'; ?>

                <tr>
                    <td align="right">
                        <label for="email">Confirmer Email</label> :  
                    </td>
                    <td>
                        <input type="email" id="email2" name="email2" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->email())?>"/>
                    </td>
                </tr>       

                <tr>    
                    <td align="right">statut :
                    </td>
                    <td> 
                        <input type="radio" name="status" id="status" value="administrateur"/>
                        <label for="administateur" style="font-weight:normal;">administateur</label>
                        <input type="radio" name="status" id="status" value="utilisateur" checked/>
                        <label for="utilisateur" style="font-weight:normal;">utilisateur</label>
                    </td>
                </tr>    

                <tr>            
                    <td align="right">Placer dans la corbeille ?:
                    </td>
                    <td> 
                        <input type="radio" name="trash" id="trash" value="oui"/>
                        <label for="oui" style="font-weight:normal;">oui</label>
                        <input type="radio" name="trash" id="trash" value="non" checked/>
                        <label for="non" style="font-weight:normal;">non</label>
                    </td>
                </tr> 
            </table>
               <br/><br/>     
        <input type="submit" value="Modifier les infos de l'abonné"/>
                       
    </form>
</div>


<?php 
$modifyUserContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/modifyUserView.php';
?>
