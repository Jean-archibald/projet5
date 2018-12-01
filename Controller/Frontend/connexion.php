<?php
session_start();

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();

if(isset($_POST['email']))
{  
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $userExist = $userManager->userExist($email,$password);
    var_dump($userExist);
    if(!empty($password) AND !empty($email))
    {
        if($userExist == 2)
        {
           $userInfos = $userManager->getUserByEmail($email);
           $_SESSION['id'] = $userInfos['id'];
           $_SESSION['familyName'] = $userInfos['familyName'];
           $_SESSION['firstName'] = $userInfos['firstName'];
           $_SESSION['email'] = $userInfos['email'];
           header('Location: accueil');
        }
        else
        {
            $message = '<p class="messageProbleme">L\'adresse mail n\'est pas répertorié ou le mot de passe est invalide !<p/>';
        }
    }
    else
    {
        $message = '<p class="messageProbleme">Tous les champs doivent être complétés !<p/>';
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
    </p>

    <table>

        <tr>
            <td align="right">
                <label for="email">Email</label> :   
            </td>
            <td>
                <input type="email" id="email" name="email" placeholder="Votre email" />
            </td>
        </tr>
        
        <tr>
            <td align="right">
                <label for="password">Mot de passe</label> :   
            </td>
            <td>
                <input id="text" name="password" id="password" placeholder="Votre mot de passe" />
            </td>
        </tr>

    </table>
    <br/><br/>    

    <input type="submit" value="Se connecter" />
        
</form>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Frontend/connexionView.php';
?>
