<?php
// echo '
// <pre>print_r de $_FILES :<br>';
// print_r($_FILES);
// echo '</pre>';

// echo '$_FILES[image][name] :<br>' . ($_FILES['image']['name']);
?>

<!-- Pour un écran de plus de 1100px de large, on affiche un tableau... -->
<table class="table table-bordered table-striped table-hover text-center tableau">
    <thead class="table-dark">
        <tr>
            <th><?= ucfirst($id); ?></th>
            <th>Image</th>
            <th>Catégorie</th>
            <th>Titre</th>
            <th>Texte</th>
            <th>Date</th>
            <th>Consulter</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $dataArticle) : ?>
            <tr>
                <td><?= $dataArticle['id']; ?></td>
                <td><img src="<?= $dataArticle['image']; ?>" width="120" alt="photo en lien avec l'article"></td>
                <td><?= $dataArticle['category']; ?></td>
                <td><?= $dataArticle['title']; ?></td>
                <td><?= $dataArticle['text']; ?></td>
                <td><?= $dataArticle['creation_date']; ?></td>
                <td><a href="?op=select&id=<?= $dataArticle[$id]; ?>" class="btn btn-info"><i class="fa-sharp fa-solid fa-eye"></i></a></td>
                <td><a href="?op=update&id=<?= $dataArticle[$id]; ?>" class="btn btn-warning"><i class="fa-sharp fa-solid fa-user-pen"></i></a></td>
                <td><a href="?op=delete&id=<?= $dataArticle[$id]; ?>" class="btn btn-danger" onclick="return(confirm('⚠ Vous êtes sur le point de supprimer cet article. En êtes vous certain ?'))"><i class="fa-sharp fa-solid fa-user-xmark"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<!-- ...en dessous de 1100px de largeur d'écran, on affiche des cards : -->
<div class="mobile">
    <div class="container d-flex justify-content-around flex-wrap text-center mt-4">
        <?php foreach ($data as $dataArticle) : ?>
            <?php $date = new DateTime($dataArticle['creation_date']); ?>
            <div class="card mb-4" style="width: 300px;">
                <img src="<?= $dataArticle['image']; ?>" alt="photo en lien avec l'article" class="card-img-top">
                <div class="card-body">
                    <p>Article n° <?= $dataArticle['id']; ?> du <?= $date->format('d-m-Y'); ?></p>
                    <p>Catégorie : <?= $dataArticle['category']; ?></p>
                    <h5 class="card-title"><?= $dataArticle['title']; ?></h5>
                    <p><?= substr($dataArticle['text'], 0, 40) . '...<br>'; ?><a href="?op=select&id=<?= $dataArticle['id']; ?>"><span style="color:#3e95e2">Lire la suite...</span></p>
                    </a>
                    <div class="container">
                        <a href="?op=select&id=<?= $dataArticle['id']; ?>" class="btn btn-info"><i class="fa-sharp fa-solid fa-eye"></i></a>
                        <a href="?op=update&id=<?= $dataArticle['id']; ?>" class="btn btn-warning"><i class="fa-sharp fa-solid fa-user-pen"></i></a>
                        <a href="?op=delete&id=<?= $dataArticle['id']; ?>" class="btn btn-danger" onclick="return(confirm('⚠ Vous êtes sur le point de supprimer cet article. En êtes vous certain ?'))"><i class="fa-sharp fa-solid fa-user-xmark"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>