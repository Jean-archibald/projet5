 <?php
 $title = '<h2>Cette partie du site est privé.</h2>
        <h2>Vous devez être administrateur.</h2>
        <h3><a href="sessiondestroy"><input type="button" value="Se diriger vers la page de connexion"/> </a></h3>';
        require __DIR__.'/../../../View/Frontend/unauthorisedAccessView.php';
?>