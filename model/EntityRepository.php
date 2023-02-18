<?php

namespace model;

define("RACINE_SITE", "/blog-yoga/");

// Pour toutes les fonctionnalités, répéter les étapes ci-dessous :
// - Créer la méthode qui vous permet de récupérer les données dont vous avez besoin dans EntityRepository,
// - Créer une méthode dans votre controller qui fera appel à la méthode render() pour créer une vue (passer en argument le layout, le template et les données à utiliser),
// - Créer un template pour votre vue.

class EntityRepository
{
    private $db; // permet de stocker un objet issu de la PDO
    public $table; // permet de stocker le nom de la table SQL afin de l'injecter dans les différentes requêtes SQL

    // Créer une méthode permettant de créer un objet PDO représentant la connexion à votre BDD.
    // Méthode permettant de construire la connexion à la BDD :
    public function getDb()
    {
        if (!$this->db) { // $this fait référence à l'objet instancié de la classe EntityRepository
            try {
                // simplexml_load_file : fonction prédéfinie de PHP qui permet de charger un fichier XML et retourne un objet PHPSimpleXMLElement contenant toutes les informations du fichier :
                $xml = simplexml_load_file('./app/config.xml');
                // echo '<pre>print_r de $xml :<br>';
                // print_r($xml);
                // echo '</pre>';

                // On affecte le nom de la table récupérée via le fichier XML :
                $this->table = $xml->table;
                // echo '<pre>print_r de $this->table[0] :<br>';
                // print_r($this->table[0]);
                // echo '</pre>';

                try {
                    // On tente d'exécuter la connexion à la base de données :
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
                } catch (\PDOException $e) { // Injection de dépendance
                    echo '<div style="width: 400px; padding: 10px 5px; background: #f41f8a; border-radius: 4px; margin: 50px auto; color: white; text-align: center;">';
                    echo "💬 Une erreur s'est produite :  " . $e->getMessage() . " 👀";
                    echo '</div>';
                }
            } catch (\Exception $e) {
                echo '<div style="width: 400px; padding: 10px 5px; background: #f41f8a; border-radius: 4px; margin: 50px auto; color: white; text-align: center;">';
                echo "💬 Une erreur s'est produite :  " . $e->getMessage() . " 👀";
                echo '</div>';
            }
        }
        // print_r($this->db);
        return $this->db;
    } // Fin de la méthode permettant de créer un objet PDO représentant la connexion à notre BDD.


    // Méthode permettant de sélectionner tous les noms des colonnes de la table 'articles' :
    public function getFields()
    {
        $data = $this->getDb()->query("DESC " . $this->table[0]);
        // $r (résultat traité par la méthode fetchAll() avec le mode FETCH_ASSOC) :
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        // array_slice() retourne une série d'éléments du tableau commençant par l'offset :                    
        return array_slice($r, 1); // (tableau, offset) 
    }


    // Méthode permettant d'enregistrer un article :
    public function saveArticle()
    {
        $db_image = "";

        if (isset($_GET['op']) && $_GET['op'] == 'update') { // Si on modifie un article...
            if (!empty($_FILES['image']['name'])) { // ... et que l'on change la photo (c'est à dire si on choisit une autre photo grâce à l'input de type file du formulaire, et donc si $_FILES est paramétré)...
                // (Voir le print_r de $_FILES dans la page de gestion des articles)
                // (image dans $_FILES['image'] est le nom du fichier contenant les photos)
                // ... on doit supprimer la photo actuelle du dossier :
                $path_image_to_delete = $_SERVER['DOCUMENT_ROOT'] . $_POST['current-image'];
                if (!empty($_POST['current-image']) && file_exists($path_image_to_delete)) { // S'il y a déjà une photo..
                    unlink($path_image_to_delete); //... on la supprime du dossier
                }
            }
            $db_image = $_POST['current-image'];
        }

        if (!empty($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            $db_image = RACINE_SITE . "image/$image_name"; // Chemin de l'image dans la bdd 
            $image_in_folder = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "image/$image_name"; // Chemin de l'image dans le dossier
            copy($_FILES['image']['tmp_name'], $image_in_folder);
        }

        foreach ($_POST as $index => $value) {
            $_POST[$index] = htmlentities(addslashes($value));
        }

        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $image = $db_image;
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $text = isset($_POST['text']) ? $_POST['text'] : '';

        $q = $this->getDb()->query('REPLACE INTO ' . $this->table[0] . ' (id, image, category, title, text) VALUES ("' . $id . '", "' . $image . '" , "' . $category . '" , "' . $title . '" , "' . $text . '")');
    }


    // Méthode permettant de sélectionner un article dans la BDD en fonction de son ID :
    public function selectArticle($id)
    {
        $data = $this->getDb()->query("SELECT * FROM " . $this->table[0] . " WHERE id = " . $id);
        $r = $data->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }


    // Méthode permettant de supprimer un article de la BDD en fonction de son ID :
    public function deleteArticle($id)
    {
        $data = $this->getDb()->query('SELECT * FROM ' . $this->table[0] . ' WHERE id = ' . $_GET['id']);
        $article_to_delete = $data->fetch(\PDO::FETCH_ASSOC);
        $path_image_to_delete = $_SERVER['DOCUMENT_ROOT'] . $article_to_delete['image'];
        if (!empty($article_to_delete['image']) && file_exists($path_image_to_delete)) {
            unlink($path_image_to_delete);
        }

        $q = $this->getDb()->query('DELETE FROM ' . $this->table[0] . ' WHERE id = ' . $id);
    }


    // Méthode permettant de rechercher un article :
    public function searchArticle($value) // Amélioration à apporter : si le mot contient un accent (ex: équilibre), il ne trouve pas.
    {
        $valeur = '%' . $value . '%';
        $data = $this->getDb()->query('SELECT * FROM ' . $this->table[0] . ' WHERE title LIKE "' . $valeur . '"OR category LIKE "' . $valeur . '"');
        if ($data->rowCount() == 0) {
            $r = '';
        } else {
            $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $r;
    }


    // Méthode permettant de sélectionner l'ensemble des articles dans la table "articles" :
    public function selectAllArticles()
    {
        // $data (réponse de la BDD = PDOStatement) = PDO->query(requête SQL)
        $data = $this->getDb()->query("SELECT * FROM " . $this->table[0] . " ORDER BY id DESC ");
        // $r (résultat traité par la méthode fetchAll() avec le mode FETCH_ASSOC)
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }


    // Méthode permettant de sélectionner tous les noms des colonnes de la table 'membres' :
    public function getFieldsMembers()
    {
        $data = $this->getDb()->query("DESC " . $this->table[1]);
        // $r (résultat traité par la méthode fetchAll() avec le mode FETCH_ASSOC) :
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        // array_slice() retourne une série d'éléments du tableau commençant par offset :                    
        return array_slice($r, 1); // (tableau, offset) 
    }


    // Méthode permettant de s'inscrire :
    public function signUpEntityRepo()
    {
        if ($_POST) {
            // On initialise la variable $contenu vide :
            $contenu = '';

            // On veut que prénom, nom et email respectent les conditions ci-dessous :
            $verif_firstname = preg_match('#^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._-]+$#', $_POST['firstname']);
            $verif_lastname = preg_match('#^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._-]+$#', $_POST['lastname']);
            $verif_email = preg_match('#^[A-Za-z0-9.+-_]+@[A-Za-z0-9]+\.[A-Za-z]{2,4}$#', $_POST['email']);

            // On veut que le mot de passe respectent les conditions ci-dessous :
            function password_strength_check($password, $min_len = 4, $max_len = 15, $req_digit = 1, $req_lower = 1, $req_upper = 1, $req_symbol = 1)
            {
                // Build regex string depending on requirements for the password :
                $regex = '/^';
                if ($req_digit == 1) {
                    $regex .= '(?=.*\d)';
                }              // Match at least 1 digit
                if ($req_lower == 1) {
                    $regex .= '(?=.*[a-z])';
                }           // Match at least 1 lowercase letter
                if ($req_upper == 1) {
                    $regex .= '(?=.*[A-Z])';
                }           // Match at least 1 uppercase letter
                if ($req_symbol == 1) {
                    $regex .= '(?=.*[^a-zA-Z\d])';
                }    // Match at least 1 character that is none of the above
                $regex .= '.{' . $min_len . ',' . $max_len . '}$/';

                if (preg_match($regex, $password)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }

            // Si les noms ne respectent pas les regex ci-dessus, ou s'ils ne respectent pas une certaine longueur minimum et maximum, on envoie une erreur :
            if (!$verif_firstname || !$verif_lastname || iconv_strlen($_POST['firstname']) < 2 || iconv_strlen($_POST['firstname']) > 20 || iconv_strlen($_POST['lastname']) < 2 || iconv_strlen($_POST['lastname']) > 20) {
                $contenu .= "Le prénom et le nom doivent contenir entre 2 et 20 caractères inclus. Les caractères spéciaux ne sont pas acceptés.";
                $result = ['result' => false, 'alert' => $contenu];
                // Si l'email ne respecte pas la regex ci-dessus, on envoie une erreur :
            } else if (!$verif_email) {
                $contenu .= "Le format de l'email est incorrect.";
                $result = ['result' => false, 'alert' => $contenu];
                // Si la fonction de vérification du mot de passe retourne false, on envoie une erreur :
            } else if (password_strength_check($_POST['password']) == FALSE) {
                $contenu .= "Le mot de passe doit contenir entre 4 et 15 caractères, au moins un chiffre, au moins une minuscule, au moins 1 majuscule et au moins un caractère spécial";
                $result = ['result' => false, 'alert' => $contenu];
            } else {
                // On fait une requête de sélection pour voir si l'email existe déjà en bdd :
                $result = $this->getDb()->query('SELECT * FROM ' . $this->table[1] . ' WHERE email = "' . $_POST['email'] . '"');
                // Si rowCount() est supérieur à 0, cela signifie que l'email a été trouvé en base de données :
                if ($result->rowCount() > 0) {
                    $contenu .= "Un compte existe déjà à cette adresse mail";
                    $result = ['result' => false, 'alert' => $contenu];
                } else {
                    // On boucle sur le tableau $_POST et on applique un addslashes et un htmlentities sur les valeurs
                    foreach ($_POST as $index => $value) {
                        $_POST[$index] = htmlentities(addslashes($value));
                    }
                    // On crypte le mot de passe :
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    // On exécute la requête d'insertion du membre en bdd :
                    $data = $this->getDb()->query('INSERT INTO ' . $this->table[1] . ' (firstname, lastname, email, password) VALUES ( "' . $_POST['firstname'] . '" , "' . $_POST['lastname'] . '" , "' . $_POST['email'] . '", "' . $_POST['password'] . '")');
                    // print_r($data);
                    $contenu .= "Bravo ! 👏 L'inscription s'est déroulée avec succès ! 🎉 Vous pouvez à présent vous connecter 😊";
                    $result = ['result' => true, 'alert' => $contenu];
                }
            }
            return $result;
        }
    }


    // Méthode permettant de se connecter :
    public function connectEntityRepo()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        $result = $this->getDB()->query('SELECT * FROM ' . $this->table[1] . ' WHERE email = "' . $_POST['email'] . '"');
        if ($result->rowCount() == 1) {
            $member = $result->fetch(\PDO::FETCH_ASSOC);
            // echo '<pre>';
            // print_r($member);
            // echo '</pre>';

            // Comparaison du mot de passe tapé avec le mot de passe crypté :
            if (password_verify($_POST['password'], $member['password'])) {
                // On boucle sur les informations du membre et on enregistre les infos dans la session : 
                foreach ($member as $index => $value) {
                    if ($index != 'password') {
                        $_SESSION['member'][$index] = $value;
                    }
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

// test 
$e = new EntityRepository;
$e->getDb();
