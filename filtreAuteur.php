<?php require_once('./partials/header.php'); 
$auteurs = getAllAuteurs();
$onlyOne = 0;
if(isset($_GET['auteur']) && !empty($_GET['auteur'])){
    $auteurs = getAuteur($_GET['auteur']);
    $onlyOne = 1;
}

?>
<section class="f-col auteurs">
    <?php foreach($auteurs as $auteur){?>
    <section class="auteur">
    <div class="hand transparent article">
        <?php echo $auteur['Pseudo'] ?>
    </div>
    <div class="f-col articles-list center">
        <?php
        $articles = getArticlesFromAuteur($auteur['ID']);
        foreach($articles as $article){
            $categories = getArtCategories($article['Art_id']);?>
        <a class="png hand" href="./articleDetails.php?article=<?php echo $article['Art_id'] ?>">- <?php echo $article['Art_titre'] ?>
            <div class="categories f-row center">
                    <?php foreach($categories as $categorie){?>
                        <div class="categorie f-col">
                            <div>
                                <?php echo $categorie['Categorie_nom'] ?>
                            </div>
                            <img src="<?php echo $categorie['Categorie_icone']?>" alt="">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <hr>
        </a>
        <?php
        }
    ?>
    </div>
    </section>
    <?php
    }
    ?>
</section>
<?php require_once('./partials/footer.php'); ?>