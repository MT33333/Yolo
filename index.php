<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
	//connection a la base de donnees
	$db_username='root';
	$db_password='mot_de_passe_bdd';
	$db_name='enregistrement';
	$db_host='localhost';
	$db=mysqli_connect($db_host, $db_username, $db_password, $db_name)
	         or die('could not connect to database');
	         //on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
	         //pour eliminer les attaques de typeinjection sql et xss

	    $username=mysqli_real_escape_string($db,htmlspecialchars($_POST['username']));
	    $password=mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));
	    if($username !== "" && $password !== "")
	    {
	    	$requete = "SELECT count(*) FROM user where username='".$username."' and password = '".$password."' ";
	    	$exec_requette = mysqli_query($db, $requete);
	    	$reponse = mysqli_fetch_array($exec_requette);
	    	$count = $reponse['count(*)'];
	    	if($count!=0) // non d'utilisateur et mot de passe correctes
	    	{
	    		$_SESSION['udername']= $username;
	    		header('lacation:accueil.php');
	    	}
	    	else {
	    		header('lacation: htmlautenti.html?erreur=1'); //utilisateur ou mot de passe incorecte
	    	} 
	    }
	    	else{
	    		header('lacation:hymlautenti.html?erreur=2'); //utilisateur ou mot de passe vide
	    	}

	    }
	    else{
	    	header('location:hymlautenti.html');
	    }
	    mysqli_close($db); //fermer la connexion
	    ?>
