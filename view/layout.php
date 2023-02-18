<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon.io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon.io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon.io/favicon-16x16.png">
    <link rel="manifest" href="./favicon.io/site.webmanifest">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/spacelab/bootstrap.min.css" integrity="sha512-kb6aHe8Fchic05HVLuEio/LWsmwtNRndUxZ5AqK4IyMG817Dhff2BxuKJCRPWzQ4daCxN5TagQ5s8Hpo9YJgbQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- style.css -->
    <link rel="stylesheet" href="style.css">

    <title>Mon blog de yoga</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="?op=home">Mon blog de yoga</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="?op=home">Accueil
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['member']) && $_SESSION['member']['status'] == 1) :   ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="?op=add">Ajouter un article</a>
                                <a class="dropdown-item" href="?op=list">Gérer mes articles</a>
                            </div>
                        </li>
                    <?php endif;   ?>
                </ul>
                <form class="d-flex" role="search" method="post" action="?op=search">
                    <input class=" form-control me-2" name="search" type="search" placeholder="Rechercher un article">
                    <button class="btn btn-secondary me-5" type="submit">Rechercher</button>
                </form>
                <?php if (isset($_SESSION['member'])) :  ?>
                    <a href="?op=deconnect" class="btn btn-light ms-5">Deconnexion</a>
                <?php else : ?>
                    <a href="?op=signUp" class="btn btn-light ms-5 me-2">Inscription</a>
                    <a href="?op=connect" class="btn btn-secondary">Connexion</a>
                <?php endif; ?>
            </div>
    </nav>

    <h1 class="text-center my-5"><?= $title; ?></h1>
    <div class="container">
        <div class="alert alert-info text-center">💬 <?= $message; ?></div>
        <?php
        if (!empty($alert)) {
            echo '<div class="alert alert-success text-center">';
            echo $alert;
            echo '</div>';
        }
        if (!empty($bad_alert)) {
            echo '<div class="alert alert-danger text-center">';
            echo $bad_alert;
            echo '</div>';
        }
        if (!empty($deco)) {
            echo '<div class="alert alert-secondary text-center">';
            echo $deco;
            echo '</div>';
        }
        ?>
    </div>

    <div class="container my-5" style="min-height: 79vh;">
        <?= $content; ?>
    </div>

    <footer class="container-fluid navbar-dark bg-dark text-center" style="min-height: 60px; color: white;">
        <p style="padding: 15px"><?= date('Y') ?> - Tous droits reservés - <i class="fa-solid fa-copyright"></i> Mon blog de yoga</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>