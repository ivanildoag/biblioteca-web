<?php
	require "../db.php";
	require "Editora.php";
	if(isset($_POST['nome']) && isset($_GET['id'])){
		$editora = Editora::get($_GET['id']);
		$editora->nome = $_POST['nome'];
		$editora->save();
	}
	else {
		http_response_code(400);
	}
?>