<?php require_once('./partials/header.php');
if((!isset($_SESSION['user']) || empty($_SESSION['user'])) && ($isAdmin != 1)){
    header("location: 503.php");
}

if(isset($_GET['delete']) && !empty($_GET['delete'])){
    deleteArticle($_GET['delete']);
}
$auteur = $_SESSION['user'];
$articles = getArticlesFromAuteur($auteur['id']);
?>
<section class="f-col center padd">
    <div class="hand transparent">Vos articles</div>

<?php foreach($articles as $article){?>
<div class="f-row center padd">
    <a class="png" href="./articleDetails.php?article=<?php echo $article['Art_id'] ?>">- <?php echo $article['Art_titre'] ?></a>
    <p><?php echo $article['Art_Date']?></p>
    <a href="./newArticle.php?edit=<?php echo $article['Art_id']?>"><img class="like png" src="./images/pen.png" alt=""></a>
    <div onclick="confirmIt(<?php echo $article['Art_id'];?>, '<?php echo addslashes($article['Art_titre']); ?>')"><img class="like png delete" src="./images/bin.png" alt=""></div>
</div>
<?php
}?>
<img class="article-image" src="./images/bowl.jpg" alt="">
</section>
<?php require_once('./partials/footer.php'); ?>