<?php
include('Web/inc/allpages/pagination1.php'); 
?>
<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i>Liste des articles</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Publier</th>
                        <th>Date d'ajout</th>
                        <th>Dernière modification</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Publier</th>
                        <th>Date d'ajout</th>
                        <th>Dernière modification</th>
                        <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        
                        <?php
                        foreach ($manager->getList($started, $numberPerPage) as $news)
                        {
                            echo '<tr><td>',
                            $news->title(), '</td><td>',
                            $news->category(), '</td><td>',
                            $news->publish(), '</td><td>',
                            $news->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
                            ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y à H\hi')),'</td><td>
                            <a href="publierArticle-', $news->id(), '">Publier</a>
                            | <a target="_blank" href="lire-',$news->id(), '">Aperçu</a>
                            | <a href="brouillonArticle-', $news->id(), '">Brouillon</a>
                            | <a href="modifierArticle-',$news->id(), '">Modifier</a>
                            | <a href="articleCorbeille-', $news->id(), '">Corbeille</a>
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