<?php
	require "../db.php";
	require "Editora.php";
	if(isset($_GET['id'])){
		$editora = Editora::get($_GET['id']);
		$editora->delete();
	}
	else {
		http_response_code(400);
	}
?>