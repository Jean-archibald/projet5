<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);


if(isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['password']))
{
    $userExist = $userManager->userExist($_SESSION['email'],$_SESSION['password']);
    if($userExist == 1)
    {
        $userInfos = $userManager->getUserByEmail($_SESSION['email']);
        if($_SESSION['email'] == $userInfos['email'] && $_SESSION['password'] == $userInfos['password'])
        {
            require __DIR__.'/../ControllerPublic/'. $direction .'Controller.php';
        }
        else
        {   
            ?>
            <?php
            $message = "Vous devez être membre";
            require __DIR__.'/../ControllerAdmin/connexionAdminController.php'; 
            ?>
            <?php
        }
    }
}
?>