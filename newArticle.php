<?php require_once('./partials/header.php');
$editMode = 0;
if(isset($_POST) && !empty($_POST) && !isset($_GET['edit'])){
    $titre = $_POST['titre'];
    $categories = $_POST['cat'];
    $contenu = $_POST['content'];
    $auteur = $_SESSION['user']['id'];
    createArticle($auteur, $titre, $categories, $contenu);
}

if(isset($_POST) && !empty($_POST) && isset($_GET['edit'])){
    $titre = $_POST['titre'];
    $categories = $_POST['cat'];
    $contenu = $_POST['content'];
    $auteur = $_SESSION['user']['id'];
    $art_id = $_GET['edit'];
    updateArticle($art_id, $titre, $categories, $contenu);
}

if(isset($_GET['edit']) && !empty($_GET['edit'])){

    if(!isOwner($_SESSION['user']['id'], $_GET['edit'])){
        header('location: ./503.php');
    };
    $article = getArticle($_GET['edit']);
    $editMode = 1;
    $categoriesSelected = getcCatNameFromArticle($_GET['edit']);
}
$categories = getAllCategories();

?>
<main>
        <form action="" method="post" enctype="multipart/form-data" class="newArticle">
            <div class="f-col width">
                <label for="titre">Titre</label>
                <input type="text" name="titre" value="<?php if($editMode == 1){echo $article['Art_titre'];}else{echo '';}?>">
            </div>
            <div class="f-col">
                <!-- <label for="upload">Ajouter une Image</label>
                <input type="file" name="image" id="image" accept="image/*"> -->
                <?php
                if($editMode == 1){
                    $image = $article["Art_image"];
                    echo "<img src='$image'";}else{echo '';}?>
            </div>
            <div class="categories-check f-row center">
                <?php foreach($categories as $categorie){?>
                    <div class="categorie cube f-col transparent">
                        <input type="checkbox" class="largerCheckbox" name="cat[]" value="<?php echo $categorie['Categorie_id'] ?>"
                        <?php if($editMode == 1){foreach ($categoriesSelected as $catSelected){
                            if(in_array($categorie['Categorie_nom'], $catSelected))
                                {echo "checked";}else{echo '';}
                        }} ?>>
                        <div>
                            <?php echo $categorie['Categorie_nom'] ?>
                        </div>
                        <img src="<?php echo $categorie['Categorie_icone']?>" alt="">
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="f-col width">
                <label for="content">Contenu</label>
                <textarea rows="15" name="content"><?php if($editMode == 1){echo $article['Art_contenu'];}else{echo '';}?></textarea>
            </div>
            <input type="submit" class="btn" value="<?php if($editMode == 1){echo 'Enregistrer les Modifications';}else{echo 'Publier';}?>">
            <a href="./index.php" class="btn transparent txt-center">Annuler</a>
        </form>
</main>
<?php require_once('./partials/footer.php'); ?>


