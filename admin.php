<?php require_once('./partials/header.php');
if(isset($_GET) && !empty($_GET)){
    if(isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'articles':
                $articles = getAllArticles();
                ?>
                <div class="f-col">
                <?php
                foreach($articles as $article){?>

                    <div class="f-row">
                        <div><?php echo $article['Art_titre'] ?></div>
                        <a href="./newArticle.php?edit=<?php echo $article['Art_id']?>">
                            <img class="like png" src="./images/pen.png" alt="">
                        </a>
                        <div onclick="confirmIt(<?php echo $article['Art_id'];?>, '<?php echo addslashes($article['Art_titre']); ?>')">
                            <img class="like png delete" src="./images/bin.png" alt="">
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
                <?php
                break;
            
            case 'comments':
                $comments = getAllComments();
                ?>
                <div class="f-col">
                <?php
                foreach($comments as $comment){?>

                    <div class="f-row">
                        <div><?php echo substr($comment['Comment_contenu'], 0, 100). ' [...]' ?></div>
                        <div onclick="confirmIt(<?php echo $comment['Comment_id'];?>)">
                            <img class="like png delete" src="./images/bin.png" alt="">
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
                <?php
                break;
                
            case 'users':
                # code...
                break;
        }
    }
    if(isset($_GET['delete'])){
        deleteComment($_GET['delete']);
        header('location: ./admin.php?action=comments');
    }
}
?>


<?php require_once('./partials/footer.php'); ?>