<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();

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

    $familyName = htmlspecialchars($_POST['familyName']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);

    if (strlen($familyName) <= 255)
    {
        if (strlen($firstName) <= 255)
        {
            if ($password == $password2)
            {
                if ($email == $email2)
                {
                    if(filter_var($email,FILTER_VALIDATE_EMAIL))
                    {
                        if($userManager->mailExist($email) == 0)
                        {
                            if($user->isValid())
                            {
                                $userManager->save($user);
                                $message = '<p class="messageValidation">L\'utilisateur a bien été ajouté !<p/>';
                            }
                            else
                            {
                                $errors = $user->errors();
                            }
                        }
                        else
                        {
                            $message = '<p class="messageProbleme">L\'adresse mail est déjà utilisé dans un autre compte !<p/>';
                        }
                    }
                    else
                    {
                        $message = '<p class="messageProbleme">L\'adresse mail n\'est pas valide !<p/>';
                    }
                }
                else
                {
                    $message = '<p class="messageProbleme">Les emails ne correspondent pas !<p/>';
                }
            }
            else
            {
                $message = '<p class="messageProbleme">Les mots de passe ne correspondent pas !<p/>';
            }
        }
        else
        {
            $message = '<p class="messageProbleme">Le prénom ne doit pas dépasser 255 caractères !<p/>';
        }
    }
    else
    {
        $message = '<p class="messageProbleme">Le nom de famille ne doit pas dépasser 255 caractères !<p/>';
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
    </p>

    <table>
        <tr>
            <td align="right">
                <label for="familyName">Nom de Famille</label> :
            </td>
            <td>
                <input type="text" name="familyName" id="familyName" placeholder="Votre nom de famille" value="<?php if(isset($familyName)) { echo $familyName; } ?>"/>
            </td>
        </tr>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FAMILYNAME, $errors))
                echo '<p class="messageProbleme">Il manque le nom de famille.<p/>'; ?>


        <tr>  
            <td align="right">
                <label for="firstName">Prénom</label> :
            </td>
            <td>
                <input type="text" name="firstName" id="firstName" placeholder="Votre prénom" value="<?php if(isset($firstName)) { echo $firstName; } ?>"/>
            </td>
        </tr> 
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_FIRSTNAME, $errors))
                echo '<p class="messageProbleme">Il manque le prénom.<p/>'; ?>


        <tr>           
            <td align="right">
                <label for="password">Mot de passe</label> :   
            </td>
            <td>
                <input type="text" id="password" name="password" placeholder="votre mot de passe" />
            </td>
        </tr>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
                echo '<p class="messageProbleme">Il manque le mot de passe.<p/>'; ?>    


        <tr>
            <td align="right">
                <label for="password2">Confirmer Mot de passe</label> : 
            </td>
            <td>
                <input type="text" id="password2" name="password2" placeholder="Confirmation du mot de passe" />
            </td>
        </tr>   
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_PASSWORD, $errors))
                echo '<p class="messageProbleme">Les mots de passe doivent être identiques<p/>'; ?>

        <tr>
            <td align="right">
                <label for="email">Email</label> :   
            </td>
            <td>
                <input type="email" id="email" name="email" placeholder="Votre email" value="<?php if(isset($email)) { echo $email; } ?>"/>
            </td>
        </tr>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_EMAIL, $errors))
                echo '<p class="messageProbleme">Il manque l\'email.<p/>'; ?>
                    
        <tr>
            <td align="right">
                <label for="email">Confirmer Email</label> :   
            </td>
            <td>
                <input type="email" id="email2" name="email2" placeholder="Confirmation de votre email" value="<?php if(isset($email2)) { echo $email2; } ?>"/>
            </td>
        </tr>
        <?php if (isset($errors) && in_array(\Entity\User::INVALID_EMAIL, $errors))
                echo '<p class="messageProbleme">Les emails doivent être identiques.<p/>'; ?>

    </table>            
    <br/><br/>
     <input type="submit" value="Inscription" name="inscription"/>
                  
</form>

<?php 
$addUserContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/addUserView.php';
?>