<?php
	require_once("tp3-helpers.php");

	/* La variable $film_data va contenir les données JSON téléchargées depuis l'API TMDB.
	 * Pour ce faire, on récupère le paramètre "film" depuis la requête GET, et on télécharge
	 * le code JSON depuis la page de l'API, et on passe ce contenu dans la fonction json_decode.
	 * Cela nous retourne un tableau associatif rendant exploitable les données JSON.
	 */
	$film_data = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $_GET["film"] . "?api_key=ebb02613ce5a2ae58fde00f4db95a9c1")[0], true);
?>

<!DOCTYPE HTML>

<html lang="fr">
	
	<head>
		<meta charset="utf-8" />
		<title>Infos sur : <?php echo $film_data["title"]; ?></title>

		<style type="text/css">
			p {
				text-align: center;
			}

			.title {
				font-weight: bold;
			}
		</style>
	</head>

	<body>
		
			<?php
				# On affiche dans 6 paragraphes les différentes données demandées sur le film
				echo "<p><span class=\"title\">Identifiant TMDB :</span> " . $film_data["id"] . "</p><br />";
				echo "<p><span class=\"title\">Titre :</span> " . $film_data["title"] . "</p><br />";
				echo "<p><span class=\"title\">Titre original :</span> " . $film_data["original_title"] . "</p><br />";
				if (isset($film_data["tagline"]) && strlen($film_data["tagline"]) > 0) echo "<p><span class=\"title\">Tagline :</span> " . $film_data["tagline"] . "</p><br />";
				echo "<p><span class=\"title\">Description :</span> " . $film_data["overview"] . "</p><br />";
				echo "<p><span class=\"title\">Lien :</span> <a href=\"https://www.themoviedb.org/movie/" . $film_data["id"] . "\">" . $film_data["title"] . " sur TMDB</a></p>";
			?>
		
	</body>

</html>