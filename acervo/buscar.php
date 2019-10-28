<?php
	require "../db.php";
	require "Acervo.php";
	echo json_encode(Acervo::getAll(isset($_GET["busca"]) ? $_GET["busca"] : null));
?>