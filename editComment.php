<?php require_once('./partials/header.php');
if((!isset($_SESSION['user']) || empty($_SESSION['user'])) && ($isAdmin != 1)){
    header("location: 503.php");
}

if(isset($_GET['delete']) && !empty($_GET['delete'])){
    deleteComment($_GET['delete']);
}

$auteur = $_SESSION['user'];
$comments = getCommentsFromAuteur($auteur['id']);
?>
<section class="f-col center padd">
    <div class="hand transparent">Vos commentaires</div>

<?php foreach($comments as $comment){?>
<div class="f-row center padd">
    <a class="png" href="./articleDetails.php?article=<?php echo $comment['Comment_article_id'] ?>">- <?php echo substr($comment['Comment_contenu'], 0, 100). ' [...]' ?></a>
    <p><?php echo $comment['Comment_date']?></p>
    <div onclick="confirmIt(<?php echo $comment['Comment_id'];?>, '<?php echo addslashes(substr($comment['Comment_contenu'], 0, 5).'...'); ?>')"><img class="like png delete" src="./images/bin.png" alt=""></div>
</div>
<?php
}?>
<img class="article-image" src="./images/bowl.jpg" alt="">
</section>
<?php require_once('./partials/footer.php'); ?>