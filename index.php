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
			
		}
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Voyages</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="container-fluid">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Voyages</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php">Parcourir<span class="sr-only">(current)</span></a>
	      </li>
	      <?php
	      if(!isset($_SESSION['email'])){
	      ?>
	      <li class="nav-item">
	        <a class="nav-link" href="connexion.php">Se connecter</a>
	      </li>
	      <?php
	  	  }
	      if(isset($_SESSION['email'])){
	      	?>
			<li class="nav-item">
	        	<a class="nav-link" href="travelform.php">Ajouter voyage</a>
	      	</li>
	      	<li class="nav-item">
	        	<a href="deconnexion.php" class="btn btn-danger" name="deconnexion">Déconnexion</a>
	      	</li>
	      	<?php
			}
			?>
	      
	    </ul>
	  </div>
	</nav>

<?php 
try {
    $db = new PDO ('mysql:host=localhost;port=3306;dbname=MaBaseBidon;charset=utf8', 'root','root');
} catch (Exception $e) {
    die('Error :' .$e->getMessage());
}

$sql = 'SELECT * FROM voyages';
$request = $db ->prepare($sql);
$request -> execute();
 
while ($data = $request->fetch()){
	echo '<div class="container">';
	echo '<div class="jumbotron">';
    echo '<h2>' . $data['title'] . '</h2></br>';

    if ($data['img'] != null){
        echo '<img src="' . $data['img'] . '">' ;
	}
	
	echo '<p>' . $data['content'].'</p>';
	echo '</div>';
	echo '</div>';

}

?>

</body>
</html>