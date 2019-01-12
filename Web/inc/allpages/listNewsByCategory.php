<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i>Liste des articles de <?=$category?></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Date d'ajout</th>    
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Date d'ajout</th>  
                        <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        
                        <?php
                        foreach ($manager->getListPublishByCategory($category) as $news)
                        {
                            echo '<tr><td>',
                            $news->title(), '</td><td>',
                            $news->category(), '</td><td>',
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