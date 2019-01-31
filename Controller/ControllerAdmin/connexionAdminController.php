<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();

if(isset($_POST['email']))
{  
    $password = sha1($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $userExist = $userManager->userExist($email,$password);
    
    if(!empty($password) AND !empty($email))
    {
        if($userExist == 1)
        {
           $userInfos = $userManager->getUserByEmail($email);
           $_SESSION['id'] = $userInfos['id'];
           $_SESSION['familyName'] = $userInfos['familyName'];
           $_SESSION['firstName'] = $userInfos['firstName'];
           $_SESSION['email'] = $userInfos['email'];
           $_SESSION['password'] = $userInfos['password'];
           $_SESSION['status'] = $userInfos['status'];
           header('Location: blogAccueil');
        }
        else
        {
            $message = '<p id="message" title="noConnect">L\'adresse mail n\'est pas répertorié ou le mot de passe est invalide !<p/>';
        }
    }
}

?>

<div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Se connecter au blog du Dr Delafontaine</div>
        <div class="card-body">
          <form action="" method="post">
            <p>
                <?php
                    if (isset($message))
                    {
                        echo $message, '<br />';
                    }
                ?>
            </p>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" required="required" autofocus="autofocus">
                <label for="email">Adresse email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Votre mot de passe" required="required">
                <label for="password">Mot de passe</label>
              </div>
            </div>
            <div class="form-group">
            </div>
            <input type="submit" value="Se connecter" class="btn btn-primary btn-block"/>
          </form>

        </div>
      </div>
</div>

<div class="container">
    <div class="row centered mt mb">
      
      <div class="descriptonBienvenue"> 
        <p>Bienvenue sur le site destiné à reprendre les informations délivrées en consultation et à les compléter.</p>
        <p>Ces informations sont les réponses aux questions posées par les personnes venues me consulter : elles sont un peu plus détaillées. </p>
        <p>Le site se construit au fur et à mesure des besoins portés à ma connaissance.</p>
        <p>La recherche d'informations précises est facilitée par l'utilisation de mots clés.</p>
        <p>Souvent il est question d'habitudes de vie.</p>
        <p>Chaque être humain étant unique, ce qui marche pour l'un ne fonctionnera pas pour un autre, même si il y a des grands principes.
        Il faut être à l'écoute de soi même et garder son bon sens. Et ne pas tarder à demander conseil en cas de doute.
        </p>
        <p>Plusieurs  rubriques se complètent et se chevauchent dans lesquelles les documents sont classés par ordre chronologique de leur conception : 
        <ul id="listeHome" style="list-style: none;">
            <li>- allergologie</li>
            <li>- nutrition</li>
            <li>- médecine générale</li>
            <li>- divers</li>
        </ul>
        </p>
        <p>Dr Marie-Pierre Delafontaine</p>
      </div>
    </div>
</div>
<?php 
$content = ob_get_clean();
require __DIR__.'/../../View/ViewAdmin/loginAdminView.php';
?>
