<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);


ob_start();
$usersPerPage = 20;
$usersTotals = $userManager->count() ;
$totalPages = ceil($usersTotals/$usersPerPage);

if(isset($id) AND !empty($id) AND $id > 0 AND $id <= $totalPages)
{
  $id = intval($id);
  $pageNow = $id;    
}
else
{
  $pageNow = 1;
}

$started = ($pageNow-1)*$usersPerPage;

?>


<p class="infoListe">Il y a au total <?= $usersTotals ?> abonné(s) :</p>
<table>
      <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Password</th><th>statut</th><th>corbeille</th><th>Inscription</th><th>Action</th></tr>
<?php

foreach ($userManager->getList($started, $usersPerPage) as $user)
{
    echo '<tr><td>',
    $user->familyName(), '</td><td>',
    $user->firstName(), '</td><td>',
    $user->email(), '</td><td>',
    $user->password(), '</td><td>',
    $user->status(), '</td><td>',
    $user->trash(), '</td><td>',
    $user->dateCreated()->format('d/m/Y à H\hi'),'</td><td>
    <a href="abonne-',$user->id(), '">Modifier</a>
    | <a href="corbeille-', $user->id(), '">Corbeille</a>
    </td></tr>', "\n";
}
?>
</table>

<br/>
<div class="paginationListUsers">

<?php
    for($i=1;$i<=$totalPages ;$i++)
    {
    if($i == $pageNow)
    {
        echo $i.' ';
    }
    else
    {
    echo '<a href="liste-abonne-' .$i.'">'.$i. '</a> ';
    }
    }
?>

</div>
<?php
$listUsersContentTemplate= ob_get_clean();
require __DIR__.'/../../View/Backend/listUsersView.php';
?>