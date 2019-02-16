<?php
include('Web/inc/allpages/pagination1.php'); 
?>
<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i>Liste des articles de <?=$category?></div>
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
                        foreach ($manager->getListPublishByCategory($started, $numberPerPage, $category) as $news)
                        {
                            echo '<tr><td>',
                            $news->title(), '</td><td class="blind">',
                            $news->category(), '</td><td class="blind">',
                            $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>
                            <a target="_blank" href="lire-',$news->id(), ' ">Lire</a>
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
include('Web/inc/allpages/pagination2.php'); 
?>