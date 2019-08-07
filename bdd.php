<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=calendar;charset=utf8', 'Vicindy', 'Fun101');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
