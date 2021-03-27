<?php
	require_once("tp3-helpers.php");

	# Recherche d'un film Seigneur des Anneaux (search & query)
	$movies_data = json_decode(smartcurl("https://api.themoviedb.org/3/search/movie?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&query=Lord+of+Rings")[0], true);

	# Récupération de l'identifiant du film
	$movie_id = $movies_data["results"][0]["id"];

	# Recherche du film dont on a récupéré l'identifiant précédemment
	$movie_data = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $movie_id . "?api_key=ebb02613ce5a2ae58fde00f4db95a9c1")[0], true);

	# Récupération de l'identifiant de collection de ce film
	$collection_id = $movie_data["belongs_to_collection"]["id"];

	# Recherche de la collection grâce à son identifiant
	$collection_data = json_decode(smartcurl("https://api.themoviedb.org/3/collection/" . $collection_id . "?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&language=fr")[0], true);

	# On récupère chaque film par son identifiant que l'on met dans un tableau
	$movies_data = [];
	foreach ($collection_data["parts"] as $movie) {
		$movies_data[] = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $movie["id"] . "?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&language=fr")[0], true);
	}

	/* On récupère les données des acteurs de chacun des films, que l'on met dans un tableau.
	 * On traite les films un par un, et si un acteur est déjà renseigné dans le tableau,
	 * on augmente son nombre d'apparitions de 1.
	 * Les indices du tableau correspondent aux identifiants des acteurs, rendant la
	 * recherche plus facile.
	 */
	$actors_data = [];
	foreach ($movies_data as $movie) {
		$credits_data = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $movie["id"] . "/credits?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&language=fr")[0], true);
		foreach ($credits_data["cast"] as $actor) {
			$actor_id = $actor["id"];
			if (isset($actors_data[$actor_id])) {
				$actors_data[$actor_id]["count"]++;
			} else {
				$actors_data[$actor_id] = [
					"name" => $actor["name"],
					"character" => $actor["character"],
					"count" => 1
				];
			}
		}
	}

?>

<!DOCTYPE HTML>

<html lang="fr">
	
	<head>
		<meta charset="utf-8" />
		<title>Acteurs jouant dans : <?php echo $collection_data["name"]; ?></title>

		<style type="text/css">
			table {
				border-collapse: collapse;
			}
			th, td {
				border: solid black 1px;
				text-align: center;
			}
		</style>
	</head>

	<body>

		<table>
			<tr>
				<th colspan="3">Acteurs jouant dans : <?php echo $collection_data["name"]; ?></th>
			</tr>

			<tr>
				<th>Nom</th>
				<th>Rôle</th>
				<th>Nombre d'apparitions dans la saga</th>
			</tr>

			<?php
				foreach($actors_data as $id => $actor) {
					echo "<tr>\n";
					echo "<td><a href=\"https://www.themoviedb.org/person/" . $id . "?language=fr\">" . $actor["name"] . "</a></td>\n";
					echo "<td>" . $actor["character"] . "</td>\n";
					echo "<td>" . $actor["count"] . "</td>\n";
					echo "</tr>\n";
				}
			?>
		</table>
		
	</body>

</html>