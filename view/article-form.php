<?php
// echo '<pre>print_r de $values :<br>';
// print_r($values);
// echo '</pre>';

// echo '<pre>print_r de $fields :<br>';
// print_r($fields);
// echo '</pre>';

?>

<form action="" method="post" enctype='multipart/form-data'>
    <div class="form-floating mb-4">
        <input type="text" class="form-control" name="category" id="category" placeholder="categorie" value="<?= ($op == 'update') ? $values['category'] : ''; ?>">
        <label for="category" class="form-label">💬 Catégorie </label>
    </div>
    <div class="form-floating mb-4">
        <input type="text" class="form-control" name="title" id="title" placeholder="titre" value="<?= ($op == 'update') ? $values['title'] : ''; ?>">
        <label for="title" class="form-label">💬 Titre </label>
    </div>
    <div class="form-floating mb-1">
        <input type="text" class="form-control" name="text" id="text" placeholder="texte" value="<?= ($op == 'update') ? $values['text'] : ''; ?>">
        <label for="text" class="form-label">💬 Texte </label>
    </div>

    <!-- Gestion de l'image : -->
    <div class="mb-3 mt-3">
        <?php if (isset($values['image'])) : ?>
            <label for="image" class="form-label mt-2 mb-3">Modifier la photo</label>
            <input type="file" class="form-control mb-4" name="image" id="image">
            <div class="text-center">
                <img src="<?= $values['image']; ?>" class=" text-center form-image" alt="photo en lien avec l' article">
            </div>
            <!-- Nous avons besoin de l'input ci-dessous avec current-image pour la méthode saveArticle() dans EntitYRepository (en cas de modification de l'article) : -->
            <input type="hidden" name="current-image" value="<?= $values['image']; ?>"><br>
            <input type="hidden" name="id" value="<?= $values['id']; ?>">
        <?php else :   ?>
            <label for="image" class="form-label mb-3">Photo</label>
            <input type="file" class="form-control" name="image" id="image">
        <?php endif; ?>
    </div>
    <!-- Fin de gestion de l'image -->

    <div class="text-center mt-5">
        <button type="submit" class="btn btn-primary">✅ Valider</button>
    </div>
</form>