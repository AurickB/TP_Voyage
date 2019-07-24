<?php
session_start();

if(isset($_SESSION['email'])){
	if (isset($_POST['title']) && $_POST['content']){

		$title = $_POST['title'];
		$content = $_POST['content'];
		if (isset($_FILES['img'])){

			$filedir = 'images/';
			$img = $filedir.$_FILES['img']['name'];
			$ext = pathinfo($_FILES['img']['name'])['extension'];
			if(in_array($ext, ['png','jpg','jpeg'])){
			move_uploaded_file( $_FILES['img']['tmp_name'], $img);
		} else {
			$img = NULL;
		}
		
		try {
			$db = new PDO ('mysql:host=localhost;port=3306;dbname=MaBaseBidon;charset=utf8', 'root','root');
		} catch (Exception $e) {
			die('Error :' .$e->getMessage());
		}

			$sql='INSERT INTO voyages (title,content,img) VALUES (:title , :content , :img)';

			$request = $db->prepare($sql);

			$request->execute([
				':title' => htmlentities(strip_tags($title)),
				':content' => htmlentities(strip_tags($content)),
				':img' => htmlentities(strip_tags($img))
				]);

		}
	}
}
header('Location: index.php');