<?php

namespace controller;

use Exception;

class Controller
{
    private $dbEntityRepository;

    // Créer un constructor qui instancie la class EntityRepository :
    public function __construct()
    {
        $this->dbEntityRepository = new \model\EntityRepository;
    }

    // Créer une méthode handleRequest() qui pilotera l'application en fonction de l'url.
    // Méthode permettant le pilotage de notre application :
    public function handleRequest()
    {
        // On stocke la valeur de l'indice "op" transmis dans l'url :
        $op = isset($_GET['op']) ? $_GET['op'] : 'home';
        session_start();

        try {
            if ($op == 'add')
                $this->create($op); // si on ajoute un article, la méthode create() sera exécutée
            elseif ($op == 'update')
                $this->modify($op); // si on modifie un article, la méthode modify() sera exécutée
            elseif ($op == 'select')
                $this->select(); // si on sélectionne un article, la méthode select() sera exécutée
            elseif ($op == 'delete')
                $this->delete(); // si on supprime un article, la méthode delete() sera exécutée
            elseif ($op == 'search')
                $this->search(); // si on effectue une recherche, la méthode search() sera exécutée
            elseif ($op == 'home')
                $this->home(); // Si on est sur la page d'accueil, la méthode home() est effectuée
            elseif ($op == 'list')
                $this->selectAll(); // si, en tant qu'admin, on veut gérer les articles, on appelle la méthode selectAll()
            elseif ($op == 'signUp')
                $this->signUp($op); // si on clique sur Inscription, on appelle la méthode signUp()
            elseif ($op == 'connect')
                $this->connect($op); // si on clique sur Connexion, on appelle la méthode connect()
            elseif ($op == 'deconnect')
                $this->deconnect(); // si on clique sur Déconnexion, on appelle la méthode deconnect()
            else
                throw new Exception("Erreur 404 : La page n'a pas été trouvée !");
        } catch (\Exception $e) { // Injection de dépendance 
            // Ici on injecte l'objet $e de type Exception (on injecte l'objet $e de la classe Exception).
            echo '<div style="width: 400px; padding: 10px; background: 	#f41f8a; border-radius: 4px; margin: 50px auto; color: white; text-align: center;">';
            echo "💬 Une erreur s'est produite :  " . $e->getMessage() . "👀";
            echo '</div>';
        }
    }

    // Créer une méthode render() qui vous permettra de créer des vues.
    // Méthode permettant de construire une vue (une page de notre application) :
    public function render($layout, $template, $parameters = [])
    {
        // extract() est une fonction prédéfinie qui permet d'extraire chaque indice d'un tableau sous forme de variable :
        extract($parameters);
        // ob_start() permet de faire une mise en mémoire tampon, on commence à garder en mémoire de la données :
        ob_start();
        // Cette inclusion sera stockée directement dans la variable $content
        require_once "view/$template";
        // on stock dans la variable $content le template :
        $content = ob_get_clean();
        // On temporise la sortie d'affichage :
        ob_start();
        // On inclut le layout qui est le gabarit de base (header/nav/footer) :
        require_once "view/$layout";
        // ob_end_flush() va libérer et fait tout apparaître dans le navigateur :
        return ob_end_flush();
    }

    // Méthode permettant de créer un article :
    public function create($op)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        if ($_POST) {
            $res = $this->dbEntityRepository->saveArticle();
            $alert = "✅ Création de l'article effectuée avec succès !";
            $this->selectAll($alert);
        }

        $this->render('layout.php', 'article-form.php', [
            'title' => "Créer un article",
            'op' => $op,
            'fields' => $this->dbEntityRepository->getFields(),
            'message' => "Formulaire pour créer un article :"
        ]);
    }

    // Méthode permettant de modifier un article :
    public function modify($op)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $values = ($op == 'update') ? $this->dbEntityRepository->selectArticle($id) : '';

        if ($_POST) {
            $res = $this->dbEntityRepository->saveArticle();
            $alert = "✅ L'article n° $id à été modifié avec succès !";
            $this->selectAll($alert);
        }

        $this->render('layout.php', 'article-form.php', [
            'title' => "Modifier un article",
            'op' => $op,
            'fields' => $this->dbEntityRepository->getFields(),
            'values' => $values,
            'message' => "Formulaire pour modifier un article :"
        ]);
    }

    // Méthode permettant de sélectionner et d'afficher l'article :
    public function select()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : $_GET['op'] == 'list';
        $this->render('layout.php', 'article.php', [
            'title' => "Article n° $id",
            'data' => $this->dbEntityRepository->selectArticle($id),
            'id' => 'id',
            'message' => "Article n° $id"
        ]);
    }

    // Méthode permettant de supprimer un article :
    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : $_GET['op'] == 'list';
        $res = $this->dbEntityRepository->deleteArticle($id);
        $alert = "L'article n° $id a bien été supprimé de la base de données";
        $this->selectAll($alert);
    }

    // Méthode permettant de rechercher un article :
    public function search()
    {
        if ($_POST) {
            $this->render('layout.php', 'search.php', [
                'title' => "Résultat",
                'result' => $this->dbEntityRepository->searchArticle($_POST['search']),
                'message' => "Résultats de votre recherche :"
            ]);
        }
    }

    // Méthode permettant d'afficher la page d'accueil :
    public function home($alert = '')
    {
        $deco = (isset($_GET['message']) && $_GET['message'] == 'alert' ? "Vous êtes déconnecté 😴  Au revoir et à bientôt ! 👋" : '');
        $this->render('layout.php', 'home.php', [
            'title' => 'Tous les articles',
            'data' => $this->dbEntityRepository->selectAllArticles(),
            'fields' => $this->dbEntityRepository->getFields(),
            'id' => 'id',
            'message' => "Mes articles :",
            'alert' => $alert,
            'deco' => $deco
        ]);
    }

    // Méthode permettant d'afficher la page gestion des articles :
    public function selectAll($alert = '')
    {
        $this->render('layout.php', 'articles-management.php', [
            'title' => 'Gérer mes articles',
            'data' => $this->dbEntityRepository->selectAllArticles(),
            'fields' => $this->dbEntityRepository->getFields(),
            'id' => 'id',
            'message' => "Gérer mes articles :",
            'alert' => $alert
        ]);
    }

    // Méthode permettant de s'inscrire :
    // Cette méthode a 2 fonctions : si $_POST a déjà les infos, on est directement dirigé vers signUpEntityRepo(),
    // Sinon, on est dirigé vers le formulaire d'inscription.
    public function signUp()
    {
        if ($_POST) {
            $res = $this->dbEntityRepository->signUpEntityRepo();
            // print_r($res); // Affiche : Array ( [result] => 1 [alert] => Inscription ok )
            if ($res['result'] == true) {
                $this->render('layout.php', 'home.php', [
                    'title' => 'Tous les articles',
                    'data' => $this->dbEntityRepository->selectAllArticles(),
                    'fields' => $this->dbEntityRepository->getFields(),
                    'id' => 'id',
                    'message' => "Mes articles :",
                    'alert' => $res['alert']
                ]);
            } else {
                $this->render('layout.php', 'sign-up.php', [
                    'title' => "Inscription",
                    'message' => "Formulaire d'inscription",
                    'bad_alert' => $res['alert']
                ]);
            }
        }
        $this->render('layout.php', 'sign-up.php', [
            'title' => "Inscription",
            'message' => "Formulaire d'inscription"
        ]);
    }

    // Méthode permettant de se connecter :
    public function connect($alert = '')
    {
        if ($_POST) {
            if ($this->dbEntityRepository->connectEntityRepo() == true) {
                $alert = 'Bienvenue  ' . $_SESSION['member']['firstname'] . ' ! 😊 ';
                $this->home($alert);
            } else {
                $this->render('layout.php', 'connection.php', [
                    'title' => "Connexion",
                    'message' => "Formulaire de connexion",
                    'bad_alert' => "⛔ Identifiants incorrect ! "
                ]);
            }
        }
        $this->render('layout.php', 'connection.php', [
            'title' => "Connexion",
            'message' => "Formulaire de connexion"
        ]);
    }

    // Méthode permettant de se déconnecter :
    public function deconnect()
    {
        if (isset($_GET['op']) && $_GET['op'] == "deconnect") {
            if (isset($_COOKIE[session_name()])) {
                // setcookie permet de créer un cookie sauf si la durée de vie est négative
                // nom_du_cookie, valeur, durée_de_vie, path
                setcookie(session_name(), '', time() - 42000, '/');
            }
            session_destroy();
        }
        header('location:?op=home&message=alert');
    }


    public function isConnected()
    {
        if (isset($_SESSION['member'])) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin()
    {
        if ($this->isConnected() && $_SESSION['member']['status'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
