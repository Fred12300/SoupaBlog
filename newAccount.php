<?php require_once('./partials/header.php');
if(isset($_POST) && !empty($_POST)){
    $email = $_POST['email'];
    $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $pseudo = $_POST['pseudo'];
    if(findExistingEmail($email) != 0){
        echo "EMAIL DEJA EXISTANT";
    }
    else if(findExistingPseudo($pseudo) != 0){
        echo "PSEUDO DEJA EXISTANT";
    }
    else {
        createUser($email, $password, $pseudo);
        $user = isUser($email);
        $_SESSION['user'] = [
            'id'=>$user['ID'],
            'pseudo'=>$user['Pseudo'],
            'isAdmin'=>$user['Role']
        ];
        header('location:index.php');
    }
}
?>
<form action="" method="post" class="contain f-col account_form">
        <div class="hand transparent">Créer un Compte</div>
        <input type="email" name="email" placeholder="email">
        <input type="text" name="pseudo" placeholder="pseudo">
        <input type="text" name="mdp" placeholder="Mot de Passe">
        <input type="submit" class="btn">
        <img src="./images/cuttingBoard.png" alt="">
    </form>
<?php require_once('./partials/footer.php'); ?>