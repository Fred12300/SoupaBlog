<?php require_once('./partials/header.php');
if(isset($_POST) && !empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['mdp'];
    $user = isUser($email);
    if($user){
        $registeredPWD = $user['MDP'];
        $isLogOk = password_verify($password, $registeredPWD);
        if($isLogOk){
            $_SESSION['user'] = [
                'id'=>$user['ID'],
                'pseudo'=>$user['Pseudo'],
                'isAdmin'=>$user['Role']
            ];
            header('location:index.php');
        }else{
            echo 'Mot de Passe incorrect';
        }
    }else{
        echo "Utilisateur inconnu";
    }
}
?>

    <form action="" method="post" class="contain f-col connection">
    <div class="hand">Connection</div>
        <input type="email" name="email" placeholder="Entrez votre email">
        <input type="password" name="mdp" placeholder="Entrez votre mot de passe">
        <input type="submit" class="btn">
        <img src="./images/cuttingBoard.png" alt="">
    </form>

<?php require_once('./partials/footer.php'); ?>