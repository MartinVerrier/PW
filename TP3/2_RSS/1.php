<?php
	require_once("vendor/dg/rss-php/src/Feed.php");

	$url = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";

	$rss = Feed::loadRss($url);
?>

<!DOCTYPE HTML>

<html lang="fr">
	
	<head>
		<meta charset="utf-8" />
		<title>Tableau des podcasts</title>

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
				<th>Date</th>
				<th>Titre</th>
				<th>Lecture</th>
				<th>Durée</th>
				<th>Média</th>
			</tr>

			<?php
				foreach ($rss->item as $item) {
					echo "<tr>\n";
					echo "<td>" . $item->{'pubDate'} . "</td>\n";
					echo "<td><a href=\"" . $item->{'link'} . "\" title=\"" . $item->{'description'} . "\">" . $item->{'title'} . "</a></td>\n";
					echo "<td><audio controls><source src=\"" . $item->{'enclosure'}["url"] . "\" type=\"audio/mpeg\"></audio></td>\n";
					echo "<td>" . $item->{'itunes:duration'} . "</td>\n";
					echo "<td><a href=\"" . $item->{'enclosure'}["url"] . "\">Lien du MP3</a></td>\n";
					echo "</tr>\n";
				}
			?>
		</table>
	</body>

</html>