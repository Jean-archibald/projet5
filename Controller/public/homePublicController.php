<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);
ob_start();
$information = '<p class="information">Bienvenue, voici les cinq derniers articles publiés.</p>';
echo $information,'<br/>'
?>
<div class="card mb-3">
    <div class="card-header"></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="blind">Titre</th>
                        <th class="blind">Catégorie</th>
                        <th class="blind">Date d'ajout</th>    
                        <th class="blind">Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="blind">Titre</th>
                        <th class="blind">Catégorie</th>
                        <th class="blind">Date d'ajout</th>  
                        <th class="blind">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        
                        <?php
                        foreach ($manager->getListLastPublish(0,5) as $news)
                        {
                            echo '<tr><td>',
                            $news->title(), '</td><td class="blind">',
                            $news->category(), '</td><td class="blind">',
                            $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>
                            <a target="_blank" href="lire-',$news->id(), '">Lire</a>
                            </td></tr>', "\n";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/templatePublicView.php';
?>