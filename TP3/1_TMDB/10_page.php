<?php
	require_once("tp3-helpers.php");

	/* La variable $film_data_va va contenir les données JSON téléchargées depuis l'API TMDB.
	 * Pour ce faire, on récupère le paramètre "film" depuis la requête GET, et on télécharge
	 * le code JSON depuis la page de l'API, et on passe ce contenu dans la fonction json_decode.
	 * Cela nous retourne un tableau associatif rendant exploitable les données JSON.
	 * Notons que cette variable contient les données de l'API en anglais (langue par défaut).
	 */
	$film_data_va = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $_GET["film"] . "?api_key=ebb02613ce5a2ae58fde00f4db95a9c1")[0], true);

	/* La variable $film_data_vf contient les données JSON du même film mais en spécifiant le
	 * paramètre "language=fr" qui demande à l'API les données en langue française
	 */
	$film_data_vf = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $_GET["film"] . "?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&language=fr")[0], true);

	/* La variable $film_data_vo contient les données JSON du film mais dans sa langue
	 * originale.
	 * Pour ce faire, il faut récupérer le code de langue du film depuis la variable $film_data_va
	 * afin d'émettre une requête à l'API afin qu'elle nous envoie les données dans cette langue.
	 */
	$film_data_vo = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $_GET["film"] . "?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&language=" . $film_data_va["original_language"])[0], true);



	# On récupère les liens des trailers dans chacune des langues (en demandant à l'API movie/videos) que l'on met dans les variables $film_key_vx
	$film_videos_va = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $_GET["film"] . "/videos?api_key=ebb02613ce5a2ae58fde00f4db95a9c1")[0], true)["results"];
	$film_key_va = count($film_videos_va) == 0 ? "" : $film_videos_va[0]["key"];

	$film_videos_vf = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $_GET["film"] . "/videos?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&language=fr")[0], true)["results"];
	$film_key_vf = count($film_videos_vf) == 0 ? "" : $film_videos_vf[0]["key"];

	$film_videos_vo = json_decode(smartcurl("https://api.themoviedb.org/3/movie/" . $_GET["film"] . "/videos?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&language=" . $film_data_va["original_language"])[0], true)["results"];
	$film_key_vo = count($film_videos_vo) == 0 ? "" : $film_videos_vo[0]["key"];
?>

<!DOCTYPE HTML>

<html lang="fr">
	
	<head>
		<meta charset="utf-8" />
		<title>Infos sur : <?php echo $film_data_vf["title"]; ?></title>

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

		<!--
			Certaines colonnes du tableau sont regroupées en une seule pour les champs qui
			comportent des données communes (comme l'identifiant du film ou le titre original)
		-->
		<table>
			<tr>
				<td></td>
				<th>Version originale (<?php echo $film_data_va["original_language"]; ?>)</th>
				<th>Version anglaise</th>
				<th>Version française</th>
			</tr>

			<tr>
				<th>Identifiant</th>
				<td colspan="3"><?php echo $film_data_va["id"]; ?></td>
			</tr>

			<tr>
				<th>Titre</th>
				<td><?php echo $film_data_vo["original_title"]; ?></td>
				<td><?php echo $film_data_va["title"]; ?></td>
				<td><?php echo $film_data_vf["title"]; ?></td>
			</tr>

			<tr>
				<th>Titre original</th>
				<td colspan="3"><?php echo $film_data_va["original_title"]; ?></td>
			</tr>

			<tr>
				<th>Tagline</th>
				<td><?php echo $film_data_vo["tagline"]; ?></td>
				<td><?php echo $film_data_va["tagline"]; ?></td>
				<td><?php echo $film_data_vf["tagline"]; ?></td>
			</tr>

			<tr>
				<th>Description</th>
				<td><?php echo $film_data_vo["overview"]; ?></td>
				<td><?php echo $film_data_va["overview"]; ?></td>
				<td><?php echo $film_data_vf["overview"]; ?></td>
			</tr>

			<tr>
				<th>Lien</th>
				<td><?php echo "<a href=\"https://www.themoviedb.org/movie/" . $film_data_va["id"] . "?language=" . $film_data_va["original_language"] . "\">TMDB " . strtoupper($film_data_va["original_language"]) . "</a>"; ?></td>
				<td><?php echo "<a href=\"https://www.themoviedb.org/movie/" . $film_data_va["id"] . "?language=en\">TMDB EN</a>"; ?></td>
				<td><?php echo "<a href=\"https://www.themoviedb.org/movie/" . $film_data_va["id"] . "?language=fr\">TMDB FR</a>"; ?></td>
			</tr>

			<tr>
				<th>Affiche</th>
				<td><?php echo "<img src=\"https://image.tmdb.org/t/p/w200" . $film_data_vo["poster_path"] . "\" alt=\"Image de l'affiche en version originale\" />" ?></td>
				<td><?php echo "<img src=\"https://image.tmdb.org/t/p/w200" . $film_data_va["poster_path"] . "\" alt=\"Image de l'affiche en version anglaise\" />" ?></td>
				<td><?php echo "<img src=\"https://image.tmdb.org/t/p/w200" . $film_data_vf["poster_path"] . "\" alt=\"Image de l'affiche en version française\" />" ?></td>
			</tr>

			<tr>
				<th>Bande d'annonce</th>
				<!-- Il est important de ne pas afficher le <iframe> si le lien n'est pas disponible -->
				<td>
					<?php
						if ($film_key_vo != "") {
							echo "<iframe src=\"https://www.youtube.com/embed/" . $film_key_vo . "\" allowfullscreen=\"allowfullscreen\" mozallowfullscreen=\"mozallowfullscreen\" msallowfullscreen=\"msallowfullscreen\" oallowfullscreen=\"oallowfullscreen\" webkitallowfullscreen=\"webkitallowfullscreen\"></iframe>\n";
						}
					?>
				</td>
				<td>
					<?php
						if ($film_key_va != "") {
							echo "<iframe src=\"https://www.youtube.com/embed/" . $film_key_va . "\" allowfullscreen=\"allowfullscreen\" mozallowfullscreen=\"mozallowfullscreen\" msallowfullscreen=\"msallowfullscreen\" oallowfullscreen=\"oallowfullscreen\" webkitallowfullscreen=\"webkitallowfullscreen\"></iframe>\n";
						}
					?>
				</td>
				<td>
					<?php
						if ($film_key_vf != "") {
							echo "<iframe src=\"https://www.youtube.com/embed/" . $film_key_vf . "\" allowfullscreen=\"allowfullscreen\" mozallowfullscreen=\"mozallowfullscreen\" msallowfullscreen=\"msallowfullscreen\" oallowfullscreen=\"oallowfullscreen\" webkitallowfullscreen=\"webkitallowfullscreen\"></iframe>\n";
						}
					?>
				</td>
			</tr>
		</table>
		
	</body>

</html>