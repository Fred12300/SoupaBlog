<?php require_once('./partials/header.php');
$categories = getAllCategories();

if(isset($_GET['categorie']) && !empty($_GET['categorie'])){
    $selectedArticles = getArticlesFromCategorie($_GET['categorie']);
    $catName = getCategorie($_GET['categorie'])['Categorie_nom'];
    ?>
    <div class="f-col categories-list">
        <div class="transparent hand padd"><?php echo $catName?></div>
        <div class="display">
            <?php
            foreach($selectedArticles as $article){
                $categories = getArtCategories($article['Art_id']); 
            ?>
            <div class="oneCat">
                <a href="./articleDetails.php?article=<?php echo $article['Art_id'] ?>" class="png transparent text-center">
                    <div class="hand"><?php echo $article['Art_titre']?></div>
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
                </a>

            </div>
            <?php } ?>
        </div>
    </div>
<?php
}


if(!isset($_GET['categorie']) || empty($_GET['categorie'])){?>
<div class="catFilter">
    <div class="categories f-col center padd">
        <?php foreach($categories as $categorie){?>
            <a class="categorie f-row btn transparent link" href="./filtreCategorie.php?categorie=<?php echo $categorie['Categorie_id']?>">
                <div class="hand">
                    <?php echo $categorie['Categorie_nom'] ?>
                </div>
                <img src="<?php echo $categorie['Categorie_icone']?>" alt="">
            </a>
        <?php
        }
        ?>
    </div>
</div>
<?php
}
require_once('./partials/footer.php'); ?>

