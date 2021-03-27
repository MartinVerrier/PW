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


	# Fonction permettant de formater une date US au format FR
	function format_date($date_str) {
		return substr($date_str, 8, 2) . "/" . substr($date_str, 5, 2) . "/" . substr($date_str, 0, 4);
	}
?>

<!DOCTYPE HTML>

<html lang="fr">
	
	<head>
		<meta charset="utf-8" />
		<title>Infos sur la collection : <?php echo $collection_data["name"]; ?></title>

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
				<td></td>
				<?php echo "<th colspan=\"" . count($movies_data) . "\">" . $collection_data["name"] . "</th>"; ?>
			</tr>
			<tr>
				<td></td>
				<?php
					foreach ($movies_data as $movie) {
						echo "<th>" . $movie["title"] . "</th>\n";
					}
				?>
			</tr>

			<tr>
				<th>Identifiant</th>
				<?php
					foreach ($movies_data as $movie) {
						echo "<td>" . $movie["id"] . "</td>\n";
					}
				?>
			</tr>

			<tr>
				<th>Titre</th>
				<?php
					foreach ($movies_data as $movie) {
						echo "<td>" . $movie["title"] . "</td>\n";
					}
				?>
			</tr>

			<tr>
				<th>Titre original</th>
				<?php
					foreach ($movies_data as $movie) {
						echo "<td>" . $movie["original_title"] . "</td>\n";
					}
				?>
			</tr>

			<tr>
				<th>Date de sortie</th>
				<?php
					foreach ($movies_data as $movie) {
						echo "<td>" . format_date($movie["release_date"]) . "</td>\n";
					}
				?>
			</tr>

			<tr>
				<th>Tagline</th>
				<?php
					foreach ($movies_data as $movie) {
						echo "<td>" . $movie["tagline"] . "</td>\n";
					}
				?>
			</tr>

			<tr>
				<th>Description</th>
				<?php
					foreach ($movies_data as $movie) {
						echo "<td>" . $movie["overview"] . "</td>\n";
					}
				?>
			</tr>

			<tr>
				<th>Lien</th>
				<?php
					foreach ($movies_data as $movie) {
						echo "<td><a href=\"https://www.themoviedb.org/movie/" . $movie["id"] . "?language=fr\">TMDB</a></td>\n";
					}
				?>
			</tr>

			<tr>
				<th>Affiche</th>
				<?php
					foreach ($movies_data as $movie) {
						echo "<td><img src=\"https://image.tmdb.org/t/p/w200" . $movie["poster_path"] . "\" alt=\"Affiche : " . $movie["title"] . "\" title=\"" . $movie["title"] . "\" /></td>\n";
					}
				?>
			</tr>
		</table>
		
	</body>

</html>