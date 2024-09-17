<?php require_once('./partials/header.php');
$article = getArticle($_GET['article']);
$comments = getAllCommentsForArtcile($_GET['article']);
if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    if(isset($_POST) && !empty($_POST)){
        $auteur = $_SESSION['user']['id'];
        $date = date('Y-m-d');
        $article_id = $article['Art_id'];
        $comment_contenu = $_POST['newComment'];
        createComment($auteur, $date, $article_id, $comment_contenu);
    }
}
$categories = getArtCategories($article['Art_id']); 
?>
<section class="article_page">
    <div class="article">
        <div class="head center">
            <div class="title hand transparent">
                <?php echo $article['Art_titre'] ?>
            </div>
            <div class="categories f-row center">
                <?php foreach($categories as $categorie){?>
                    <a class="categorie f-col png" href="./filtreCategorie.php?categorie=<?php echo $categorie['Categorie_id'] ?>">
                        <div>
                            <?php echo $categorie['Categorie_nom'] ?>
                        </div>
                        <img src="<?php echo $categorie['Categorie_icone']?>" alt="">
                    </a>
                <?php
                }
                ?>
            </div>
            <div class="head-bottom f-row">
                <div class="auteur">Par <?php echo $article['Pseudo'] ?></div>
                <div class="date"><?php echo $article['Art_Date'] ?></div>
            </div>
        </div>
        <img class="article-image" src="<?php echo $article['Art_image'] ?>" alt="">
        <div class="contenu">
            <p class="transparent"><?php echo $article["Art_contenu"] ?></p>
        </div>
        <div class="toLeft">
            <div class="btn transparent like f-row center"><img class="like" src="./images/like.png" alt=""></div>
        </div>
    </div>

    <div class="commentaires f-col">
        <p class="hand">Commentaires :</p>
        <?php foreach($comments as $comment){?>
            <div class="comment">
                <div class="f-row">
                    <p class="comment_auteur">Par <?php echo $comment['Pseudo'] ?></p>
                    <p class="comment_date"><?php echo $comment['Comment_date'] ?></p>
                </div>
                <p class="comment_contenu"><?php echo $comment['Comment_contenu'] ?></p>
            </div>
        <?php
        }
        ?>
        <?php
        if($connected==1){?>
            <form action="" method="post">
                <fieldset class="f-col center comment_form">
                <textarea class="comment_input" rows="5" name="newComment" placeholder="Ajouter un commentaire"></textarea>
                <input type="submit" class="btn transparent">
                </fieldset>
            </form>
        <?php
        }else if($connected==0){?>
            <p class="hand">Connectez vous pour laisser un commentaire</p>
        <?php
        }
        ?>
    </div>
</section>
<?php require_once('./partials/footer.php'); ?>