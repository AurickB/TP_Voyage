<?php 
session_start();

if(!isset($_SESSION['email'])){
	header('Location: logform.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ajouter Voyage</title>
</head>
<body>
<div class='container-fluid'> 
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
            <?php 
            if (!isset($_SESSION['email'])) {
            ?>
            <li class="nav-item">
	        <a class="nav-link" href="logform.php">Se connecter</a>
	        </li>
            <?php 
            }
            if (!isset($_SESSION['email'])){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="addtravel.php">Ajouter Voyage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="#">Deconnexion</a>
            </li>
            <?php 
            }
            ?>
            </ul>
        </div>
    </nav>
    <div class="container">
		<div class="jumbotron">
			<form action="./uploadtravel.php" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Titre</label>
					<div class="col-sm-10">
						<input class="form-control" id="title" type="text" name="title">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="content">Contenu</label>
					<div class="col-sm-10">
						<textarea id="content" type="textarea" name="content" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="img">Image</label>
					<div class="col-sm-10">
						<input id="img" type="file" name="img">
					</div>
				</div>
				<div class="form-group">
					<button type="submit">Créer voyage</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>