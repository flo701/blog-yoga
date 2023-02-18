<?php
// echo '<pre>print_r de $data :<br>';
// print_r($data);
// echo '</pre>';

// echo '<pre>print_r de $fields :<br>';
// print_r($fields);
// echo '</pre>';

// echo '<pre>print_r de $_SESSION<br>';
// print_r($_SESSION);
// echo '<pre>';

// echo ($_SESSION['member']['firstname']);

?>

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
                <a href="?op=select&id=<?= $dataArticle['id']; ?>" class="btn btn-info"><i class="fa-sharp fa-solid fa-eye"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>