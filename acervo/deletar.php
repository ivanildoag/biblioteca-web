<?php
	require "../db.php";
	require "Acervo.php";
	if(isset($_GET['id'])){
		$acervo = Acervo::get($_GET['id']);
		$acervo->delete();
	}
	else {
		http_response_code(400);
	}
?>