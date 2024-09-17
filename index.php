<?php require_once('./partials/header.php');
$articles = getAllArticles();
?>
<main class="f-col sommaire">
    <?php foreach($articles as $article){?>
    <div class="article">
        <a class="mini-article" href="./articleDetails.php?article=<?php echo $article['Art_id'] ?>">
            <div class="mini-head center">
                <div class="mini-title">
                    <?php echo $article['Art_titre'] ?>
                </div>
                <div class="head-bottom f-row">
                    <div class="mini-auteur">Par <?php echo $article['Pseudo'] ?></div>
                    <div class="mini-date"><?php echo $article['Art_Date'] ?></div>
                </div>
            </div>
            <div class="mini-contenu f-col center">
                <img class="bg-image" src="<?php echo $article['Art_image'] ?>" alt="">
                <p class="transparent"><?php echo substr($article["Art_contenu"], 0, 250).'[...]' ?></p>
                <a class="btn transparent link" href="./articleDetails.php?article=<?php echo $article['Art_id'] ?>">... Lire l'article</a>
            </div>
        </a>
    </div>
    <?php
    }
    ?>
</main>
<?php require_once('./partials/footer.php'); ?>


