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
    $userToModify->setPassword(sha1($_POST['password']));
    $userToModify->setEmail(htmlspecialchars($_POST['email']));   
    $userToModify->setStatus(htmlspecialchars($_POST['status']));  
    $userToModify->setTrash(htmlspecialchars('non'));  
     
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

        $message = '<p id="message" title="ok">L\'utilisateur a bien été modifié.<p/>';
    }

    if (htmlspecialchars($_POST['password']) != htmlspecialchars($_POST['password2']))
    {
        $message = '<p id="message" title="no">Les mots de passe doivent etre identiques !<p/>';
    }

    if (strlen(htmlspecialchars($_POST['familyName'])) > 255)
    {
        $message = '<p id="message" title="no">Le nom de famille ne doit pas dépasser 255 caractères !<p/>';
    }

    if (strlen(htmlspecialchars($_POST['firstName'])) > 255)
    {
        $message = '<p id="message" title="no">Le prénom ne doit pas dépasser 255 caractères!<p/>';
    }

    if (htmlspecialchars($_POST['email']) != htmlspecialchars($_POST['email2']))
    {
        $message = '<p id="message" title="no">Les emails doivent etre identiques !<p/>';
    }
    else
    {
        $errors = $userToModify->errors();
    }
}
?>

      
<form action="<?=$url?>" method="post">
       
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Modifier les infos d'un Abonné</div>
        <div class="card-body">
            <form action="ajouter-abonne" method="post">
                <p>
                    <?php
                        if (isset($message))
                        {
                            echo $message, '<br />';
                        }
                    ?>
                </p>
                <div class="form-group">
                    <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                        <input type="text" name="firstName" id="firstName" placeholder="Votre prénom" class="form-control" autofocus="autofocus" required="required" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->firstName());?>"/>
                        <label for="firstName">Prénom</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                        <input type="text" name="familyName" id="familyName" placeholder="Votre nom de famille" class="form-control" required="required" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->familyName());?>"/>
                        <label for="familyName">Nom de famille</label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                    <input type="email" id="email" name="email" placeholder="Votre email"  required="required" class="form-control" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->email())?>"/>               
                    <label for="email">Adresse email</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                    <input type="email" id="email2" name="email2" placeholder="Confirmer votre email"  required="required" class="form-control" value="<?php if (isset($userToModify)) echo htmlspecialchars($userToModify->email())?>"/>               
                    <label for="email2">Confirner l'adresse email</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                        <input type="text" id="password" name="password" placeholder="votre mot de passe"  class="form-control" required="required"/>
                        <label for="password">Mot de Passe</label>   
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                        <input type="text" id="password2" name="password2" placeholder="Confirmation du mot de passe" class="form-control"  required="required"/>
                        <label for="password2">Confirmer mot de passe</label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="radio">
                    <input type="radio" name="status" id="status" value="administrateur"/>
                    <label for="administateur">administateur</label>
                </div>
                <div class="radio">
                    <input type="radio" name="status" id="status" value="utilisateur"/>
                    <label for="utilisateur">utilisateur</label>
                </div>
                <input type="submit" value="Modifier les infos de l'abonné(e)" name="modifier" class="btn btn-primary btn-block"/>
                </form>    
            </div>
        </div>
    </div>         
<?php 
$content = ob_get_clean();
require __DIR__.'/../ViewAdmin/registerView.php';
?>
