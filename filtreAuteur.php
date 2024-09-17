<?php require_once('./partials/header.php'); 
$auteurs = getAllAuteurs();
foreach($auteurs as $auteur){?>
<div class="hand transparent contain"><?php echo $auteur['Pseudo'] ?></div>
<div class="f-col">
<?php
$articles = getArticlesFromAuteur($auteur['ID']);
foreach($articles as $article){?>
<a class="png" href="./articleDetails.php?article=<?php echo $article['Art_id'] ?>">- <?php echo $article['Art_titre'] ?></a>
</div>
<?php
}
}
?>

<?php require_once('./partials/footer.php'); ?>