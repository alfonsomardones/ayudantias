<?php
if(!isset($_SESSION))
{session_start();}
if(isset($_SESSION['id_usuario']))
{
	session_unset();
	session_destroy();
	header ("Location: ../");
	exit;
}
else
{header ("Location: ../");}
?>
