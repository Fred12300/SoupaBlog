<?php require_once('./functions.php');
$connected = 0;
$isAdmin = 0;
$user_pseudo = "";
session_start();
if(isset($_SESSION['user']) || !empty($_SESSION['user'])){
    $connected = 1;
    $user_pseudo = $_SESSION['user']['pseudo'];
    $isAdmin = $_SESSION['user']['isAdmin'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./images/FD.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>SoupaBlog !</title>
</head>
<body>
    <header class="header">
        <div class="mainLogo f-col">
            <img class="bigLogo" src="./images/logo.png" alt="">
            <?php if($user_pseudo != ""){?>
                <div class="transparent">Bonjour <?php echo $user_pseudo?></div>
            <?php
            }
            ?>
        </div>
        <nav>
            <div class="center nav1">
                <a href="index.php" class="cubBtn link">Accueil</a>
                <a href="filtreCategorie.php" class="cubBtn link">Categories</a>
                <a href="filtreAuteur.php" class="cubBtn link">Auteurs</a>
            </div>
            <div class="retracted f-col center">
                <div class="f-col center bgCut">
                    <?php echo $connected == 0 ?
                    '<a href="newAccount.php" class="btn transparent">Créer un Compte</a>
                    <a href="login.php" class="btn transparent">Connection</a>'
                    : "" ;
                    echo $connected != 0 ? '
                    <div class="f-col">
                        <a href="newArticle.php" class="btn transparent">+ Créer Article</a>
                        <a href="" class="btn transparent" >Mes Articles</a>
                        <a href="" class="btn transparent">Mes Commentaires</a>
                    </div>
                    <div class="f-col">
                        <a href="" class="btn transparent">Mon Compte</a>
                    </div>
                    <a href="logout.php" class="btn transparent">Déconnection</a>'
                    : "" ;
                    ?>
                </div>
                <?php echo $isAdmin == 1 ?
                '<div class="f-col contain admin">
                    <p>--ADMIN--</p>
                    <a href="" class="btn admin">Gérer Articles</a>
                    <a href="" class="btn admin">Gérer Commentaires</a>
                    <a href="" class="btn admin">Gérer Users</a>
                </div>'
                : "" ; ?>
            </div>
            <div class="slider">
                <div class="triangle"></div>
            </div>
        </nav>
    </header>
</body>
</html>