<?php 
    function dbConnect() {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=Soupabase', 'root', 'root');
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

?>