<?php
require_once('lote.Class.php');
if ($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['id']) ) {
	Lote::get_lote($_GET['id']);
}

?>