<?php

// echo '<pre>print_r de $data :<br>';
// print_r($data);
// echo '</pre>';

$date = new DateTime($data['creation_date']);

?>

<div class="container text-center mt-5">
    <div class="card" style="width: 80%; margin: 0 auto">
        <img src="<?= $data['image']; ?>" alt="photo en lien avec l'article" class="card-img-top">
        <div class="card-body">
            <p>Article n° <?= $data['id']; ?> du <?= $date->format('d-m-Y'); ?></p>
            <p>Catégorie : <?= $data['category']; ?></p>
            <h5 class="card-title"><?= $data['title']; ?></h5>
            <p><?= $data['text']; ?></p>
        </div>
    </div>
    <div class="container text-center">
        <a href="?op=home" class="btn btn-primary mt-5"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Retourner sur la page d'accueil</a>
    </div>
    <?php if (isset($_SESSION['member']) && $_SESSION['member']['status'] == 1) :   ?>
        <div class="container text-center">
            <a href="?op=list" class="btn btn-primary mt-5"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Retourner sur la page de gestion des articles</a>
        </div>
    <?php endif;   ?>
</div>