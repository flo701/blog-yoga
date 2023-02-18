<?php

// echo '<pre>print_r de $result :<br>';
// print_r($result);
// echo '</pre>';

if (!empty($result)) {
?>
    <div class="alert alert-info text-center">✅ Nombre de résultat(s) : <?= sizeof($result); ?></div>
    <div class="container d-flex justify-content-around flex-wrap text-center mt-5">
        <?php foreach ($result as $data) : ?>
            <?php
            $date = new DateTime($data['creation_date']);
            ?>
            <div class="card" style="width: 80%; margin: 0 auto">
                <img src="<?= $data['image']; ?>" alt="photo en lien avec l'article" class="card-img-top">
                <div class="card-body">
                    <p>Article n° <?= $data['id']; ?> du <?= $date->format('d-m-Y'); ?></p>
                    <p>Catégorie : <?= $data['category']; ?></p>
                    <h5 class="card-title"><?= $data['title']; ?></h5>
                    <p><?= $data['text']; ?></p>
                    <?php if (isset($_SESSION['member']) && $_SESSION['member']['status'] == 1) :   ?>
                        <div class="container">
                            <a href="?op=update&id=<?= $data['id']; ?>" class="btn btn-warning"><i class="fa-sharp fa-solid fa-user-pen"></i></a>
                            <a href="?op=delete&id=<?= $data['id']; ?>" class="btn btn-danger" onclick="return(confirm('⚠ Vous êtes sur le point de supprimer cet article. En êtes vous certain ?'))"><i class="fa-sharp fa-solid fa-user-xmark"></i></a>
                        </div>
                    <?php endif;   ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php
} else {
    echo '<div class="alert alert-danger text-center">⚠ Aucun résultat ne correspond à votre recherche !</div>';
}
