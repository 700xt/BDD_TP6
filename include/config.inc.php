<?php
session_start();

$host='localhost';
$user = "esirem";
$password = "esirem21";
$base = "pixel_war";

$connexion = connexion_MySQLi_procedural($host, $user,$password,$base);


// Connexion en Mysqli
// Style PROCEDURAL
function connexion_MySQLi_procedural ($host, $user,$password,$base)
{
    $connexion = new mysqli($host, $user, $password, $base);
    
    // Check connection
    if ($connexion->connect_error) {
      die("La connexion a échoué: " . $connexion->connect_error);
      exit();
    }
    mysqli_query($connexion,"SET NAMES 'utf8'");
    return $connexion;
}



// fonction qui renvoie un tableau en 2D
if (!function_exists("GetSQL")) {
	function GetSQL($sql, &$tab)
		{
			global $connexion; 
			$result = mysqli_query($connexion,$sql) or die($sql.'<br>'.mysqli_error($connexion)) ; $row = mysqli_fetch_array($result);
			$nbEnr = mysqli_num_rows($result);
				$k=0;
				$tab[$k] = $row;
				$k++;
			while ( $row = mysqli_fetch_array($result))
			{ 
				$tab[$k] = $row;
				$k++;
			}
                return $nbEnr;
        }
}

// Pratique quand la requête ne renvoie qu'un enregistrement, 
if (!function_exists("GetSQLValue")) {
	function GetSQLValue($sql)
		{
			global $connexion;
			$result = mysqli_query($connexion,$sql) or die('<pre>'.$sql.'</pre><hr>'.mysqli_error($connexion)) ; 
			$row = mysqli_fetch_array($result);
			if (isset($row[0]))
				return $row[0];
			else
				return;
        }
}

// fonction basique qui execute la requête SQL, et ne renvoie rien
if (!function_exists("ExecuteSQL")) {
	function ExecuteSQL($sql)
		{
			global $connexion;
			$result = mysqli_query($connexion,$sql) or die($sql.'<br>'.mysqli_error($connexion)) ; 
			return ;
        }
}


if (!function_exists("QuoteStr")) {
    function QuoteStr($theValue, $theType="text", $theDefinedValue = "", $theNotDefinedValue = "") 
    {
    global $connexion;
      $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($connexion, $theValue) : mysqli_escape_string($connexion, $theValue);
    
      switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;    
        case "long":
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "double":
          $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
          break;
        case "date":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "defined":
          $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
          break;
      }
      return $theValue;
    }
    }

	if (!function_exists("EstConnecte")) {
		function EstConnecte() 
		{
			// si je ne suis pas connecté, je vais à la page index.php, sinon ... rien
			if (!isset($_SESSION['isConnected']))
    			header("location: index.php");
			return;
		}
	}

?>