<?php 
session_start();

if(isset($_SESSION['mail'])){
	header('Location: index.php');
}else if(isset($_POST['email']) && isset($_POST['password'])){
	$mail = $_POST['email'];
	$pwd = $_POST['password'];

	try {
        $db = new PDO ('mysql:host=localhost;port=3306;dbname=MaBaseBidon;charset=utf8', 'root','root');
    } catch (Exception $e) {
        die('Error :' .$e->getMessage());
    }

		$sql='SELECT * FROM users WHERE mail = :mail';

		$request = $db->prepare($sql);

		$request->execute([
			':mail' => $mail
		]);

		if($user = $request->fetch()){
			if(password_verify($pwd, $user['password'])){
				$_SESSION['email'] = $mail;
				header('Location: newvoyage.php');
			}
		}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Voyage</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Parcourir</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="connexion.php">Se connecter</a>
        </li>
        </ul>
    </div>
    </nav>

    <form class='w-50' action='index.php' method='post'>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name='email' id="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name='password' id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php 
//echo password_hash($_POST['mdp'], PASSWORD_DEFAULT);
?>
    
</body>
</html>