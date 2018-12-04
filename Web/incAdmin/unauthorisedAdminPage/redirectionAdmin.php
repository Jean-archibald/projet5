 <?php
 $title = '<h2 class="messageSuppression">Cette partie du site est privé.</h2>
        <h2 class="messageSuppression">Vous devez être administrateur.</h2>
        <h3><a href="sessiondestroy"><input type="button" value="Se diriger vers la page de connexion"/> </a></h3>';
        require __DIR__.'/../../../View/Frontend/unauthorisedAccessView.php';
?>