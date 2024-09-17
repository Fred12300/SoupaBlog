<?php require_once('./partials/header.php');
if(isset($_POST) && !empty($_POST)){
    var_dump($_POST);
}
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = strtolower(end(explode('.', $fileName)));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileExt, $allowed)) {
        if ($fileSize <= 5000000) {
            $fileNewName = uniqid().".".$fileExt;
            $fileDestination = './articles_images/' . $fileNewName;
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                echo "Fichier téléchargé avec succès !";
            } else {
                echo "Erreur lors du téléchargement du fichier.";
            }
        } else {
            echo "Le fichier est trop volumineux.";
        }
    } else {
        echo "Type de fichier non autorisé.";
    }
}

?>
<main>
        <form action="" method="post" enctype="multipart/form-data" class="newArticle">
            <div class="f-col width">
                <label for="titre">Titre</label>
                <input type="text" name="titre">
            </div>
            <div class="f-col">
                <label for="upload">Ajouter une Image</label>
                <input type="file" name="upload">
            </div>
            <div class="f-col width">
                <label for="content">Contenu</label>
                <textarea rows="15" name="content"></textarea>
            </div>
            <input type="submit" class="btn" value="Publier">
            <input type="button" class="btn red" value="Annuler">
        </form>
</main>
<?php require_once('./partials/footer.php'); ?>