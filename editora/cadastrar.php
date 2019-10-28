<?php
	require "../db.php";
	require "Editora.php";
	if(isset($_POST['nome'])){
		$editora = new Editora($_POST['nome']);
		$editora->save();
	}
	else {
		http_response_code(400);
	}
?>