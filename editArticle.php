<?php require_once('./partials/header.php');
if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
    header("location: 503.php");
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
    <img class="like png" src="./images/bin.png" alt="">
</div>
<?php
}?>
<img class="article-image" src="./images/bowl.jpg" alt="">
</section>
<?php require_once('./partials/footer.php'); ?>