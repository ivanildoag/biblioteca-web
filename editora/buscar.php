<?php
	require "../db.php";
	require "Editora.php";
	echo json_encode(Editora::getAll(isset($_GET["busca"]) ? $_GET["busca"] : null));
?>