<?php 
    function dbConnect() {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=Soupabase', 'root', '');
            return $dbh;
        }catch(PDOException $e){
            echo 'ça marche pas' . $e;
        }
    }

    function isUser($email){
        $dbh = dbConnect();
        $query= "SELECT * FROM USERS
        WHERE Email = :email";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAllArticles(){
        $dbh = dbConnect();
        $query = "SELECT * FROM Articles
        JOIN USERS ON Art_auteur = ID
        ORDER BY Art_Date
        ";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function getArticle($article_id){
        $dbh = dbConnect();
        $query = "SELECT * FROM ARTICLES
        JOIN USERS ON Art_auteur = id
        WHERE Art_id = :article_id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':article_id', $article_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAllCommentsForArtcile($article_id){
        $dbh = dbConnect();
        $query = "SELECT * FROM COMMENTAIRES
        JOIN ARTICLES ON Comment_article_id = Art_id
        JOIN USERS ON Comment_auteur = id
        WHERE ART_id = :article_id;
        ";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':article_id', $article_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function createComment($auteur, $date, $article_id, $comment_contenu){
        $dbh = dbConnect();
        $query= "INSERT INTO COMMENTAIRES (Comment_auteur, Comment_date, Comment_article_id, Comment_contenu) VALUES(:auteur, :date, :art_id, :content)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':art_id', $article_id);
        $stmt->bindParam(':content', $comment_contenu);
        $stmt->execute();
    }

    function findExistingEmail($email){
        $dbh = dbConnect();
        $query= "SELECT EXISTS (SELECT Email FROM USERS
        WHERE Email = :email) AS emailExists";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['emailExists'];
    }

    function findExistingPseudo($pseudo){
        $dbh = dbConnect();
        $query= "SELECT EXISTS (SELECT Pseudo FROM USERS
        WHERE Pseudo = :pseudo) AS pseudoExists";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pseudoExists'];
    }

    function createUser($email, $password, $pseudo){
        $dbh = dbConnect();
        $query= "INSERT INTO USERS (Email, MDP, Pseudo) VALUES(:email, :mdp, :pseudo)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $password);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
    }

    function getArtCategories($article_id){
        $dbh = dbConnect();
        $query = "SELECT * FROM CATEGORIES
        JOIN CATEGORIES_LINK ON Categorie_id = FK_categorie_id
        JOIN ARTICLES ON FK_art_id = Art_id
        WHERE ART_id = :article_id;
        ";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':article_id', $article_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function getAllCategories(){
        $dbh = dbConnect();
        $query = "SELECT * FROM CATEGORIES;";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function getArticlesFromCategorie($cat_id){
        $dbh = dbConnect();
        $query = "SELECT * FROM ARTICLES
        JOIN CATEGORIES_LINK ON Art_id = FK_art_id
        WHERE FK_categorie_id = :cat_id
        ;";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':cat_id', $cat_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function getCategorie($cat_id){
        $dbh = dbConnect();
        $query = "SELECT * FROM CATEGORIES
        WHERE Categorie_id = :cat_id
        ;";
        $stmt = $dbh->prepare($query);
        $stmt->bindparam(':cat_id', $cat_id);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    function getArticlesFromAuteur($user_id){
        $dbh = dbConnect();
        $query = "SELECT * FROM ARTICLES
        JOIN Users ON Art_auteur = ID
        WHERE ID = :user_id
        ;";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function getAllAuteurs(){
        $dbh = dbConnect();
        $query = "SELECT DISTINCT Pseudo, ID FROM USERS
        JOIN ARTICLES ON Art_auteur = ID
        ;";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
?>